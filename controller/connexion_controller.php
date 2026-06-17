<?php
include('/var/www/sae202-event/model/connexion_model.php');

function index() {
    include('/var/www/sae202-event/view/connexion.php');
}

function inscription() {
    include('/var/www/sae202-event/view/inscription.php');
}

function validation_inscription() {
    $pseudo    = trim($_POST['client_nom'] ?? '');
    $email     = trim($_POST['client_mail'] ?? '');
    $mdp       = $_POST['mot_de_passe'] ?? '';
    $mdp2      = $_POST['mot_de_passe2'] ?? '';
    $telephone = trim($_POST['client_telephone'] ?? '');

    if (empty($pseudo) || empty($email) || empty($mdp) || empty($mdp2)) {
        $_SESSION['erreur'] = "Veuillez remplir tous les champs.";
        header('Location: /connexion/inscription');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erreur'] = "Email invalide.";
        header('Location: /connexion/inscription');
        exit;
    }

    if ($mdp !== $mdp2) {
        $_SESSION['erreur'] = "Les mots de passe ne correspondent pas.";
        header('Location: /connexion/inscription');
        exit;
    }

    if (strlen($mdp) < 6) {
        $_SESSION['erreur'] = "Le mot de passe doit faire au moins 6 caractères.";
        header('Location: /connexion/inscription');
        exit;
    }

    try {
        if (emailExiste($email)) {
            $_SESSION['erreur'] = "Cet email est déjà utilisé.";
            header('Location: /connexion/inscription');
            exit;
        }

        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
        creerUtilisateur($pseudo, $email, $mdp_hash, $telephone);

        $_SESSION['succes'] = "Compte créé ! Vous pouvez vous connecter.";
        header('Location: /connexion');
        exit;

    } catch (PDOException $e) {
        $_SESSION['erreur'] = $e->getMessage();
        header('Location: /connexion/inscription');
        exit;
    }
}

function validation_connexion() {
    $email = trim($_POST['client_mail'] ?? '');
    $mdp   = $_POST['mot_de_passe'] ?? '';

    if (empty($email) || empty($mdp)) {
        $_SESSION['erreur'] = "Veuillez remplir tous les champs.";
        header('Location: /connexion');
        exit;
    }

    try {
        $user = getUserByEmail($email);

        if ($user && password_verify($mdp, $user['mot_de_passe'])) {
            $_SESSION['user_id']     = $user['id_utilisateur'];
            $_SESSION['user_pseudo'] = $user['pseudo'];
            $_SESSION['user_role']   = $user['role'];

          if ($user['role'] === 'admin') {
    header('Location: /gestion');
} else {
    $_SESSION['succes'] = "Bienvenue " . $user['pseudo'] . " !";
    if (isset($_SESSION['redirect_after_login'])) {
        $redirect = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
        header('Location: ' . $redirect);
    } else {
        header('Location: /accueil');
    }
}
exit;
        } else {
            $_SESSION['erreur'] = "Email ou mot de passe incorrect.";
            header('Location: /connexion');
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['erreur'] = "Erreur de connexion à la base de données.";
        header('Location: /connexion');
        exit;
    }
}
