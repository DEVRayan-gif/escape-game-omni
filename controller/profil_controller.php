<?php
include('/var/www/sae202-event/model/profil_model.php');

function index() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit;
    }
    $user = getUserById($_SESSION['user_id']);
    $score = getScoreByUserId($_SESSION['user_id']); 
    include('/var/www/sae202-event/view/profil.php');
}

function modifier() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit;
    }

    $pseudo    = trim($_POST['pseudo'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $mdp       = $_POST['mot_de_passe'] ?? '';
    $mdp2      = $_POST['mot_de_passe2'] ?? '';

    if (empty($pseudo) || empty($email)) {
        $_SESSION['erreur'] = "Pseudo et email obligatoires.";
        header('Location: /profil');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erreur'] = "Email invalide.";
        header('Location: /profil');
        exit;
    }

    try {
        updateUser($_SESSION['user_id'], $pseudo, $email, $telephone);
        $_SESSION['user_pseudo'] = $pseudo;

        if (!empty($mdp)) {
            if ($mdp !== $mdp2) {
                $_SESSION['erreur'] = "Les mots de passe ne correspondent pas.";
                header('Location: /profil');
                exit;
            }
            if (strlen($mdp) < 6) {
                $_SESSION['erreur'] = "Le mot de passe doit faire au moins 6 caractères.";
                header('Location: /profil');
                exit;
            }
            $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
            updatePassword($_SESSION['user_id'], $mdp_hash);
        }

        $_SESSION['succes'] = "Profil mis à jour avec succès !";
        header('Location: /profil');
        exit;

    } catch (PDOException $e) {
        $_SESSION['erreur'] = $e->getMessage();
        header('Location: /profil');
        exit;
    }
}