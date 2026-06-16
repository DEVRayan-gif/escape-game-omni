<?php
include('/var/www/sae202-event/model/equipe_model.php');

function index() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit;
    }
    $membres = getEquipeByUser($_SESSION['user_id']);
    $creneaux = getCreneaux();
    include('/var/www/sae202-event/view/equipe.php');
}

function creer() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit;
    }

    $nom_equipe  = trim($_POST['nom_equipe'] ?? '');
    $emails      = $_POST['membres'] ?? [];
    $id_creneau  = $_POST['creneau'] ?? null; // ajoute ça

    if (empty($nom_equipe)) {
        $_SESSION['erreur'] = "Le nom de l'équipe est obligatoire.";
        header('Location: /equipe');
        exit;
    }

    try {
        $id_equipe = creerEquipe($nom_equipe);
        rejoindreEquipe($_SESSION['user_id'], $id_equipe);

        // Lie le créneau à l'équipe
        if ($id_creneau) {
            lierCreneauEquipe($id_creneau, $id_equipe);
        }

        foreach ($emails as $email) {
            $email = trim($email);
            if (!empty($email)) {
                $membre = getUserByEmailForEquipe($email);
                if ($membre) {
                    addMembreEquipe($membre['id_utilisateur'], $id_equipe);
                }
            }
        }

        $_SESSION['succes'] = "Équipe créée avec succès !";
        header('Location: /equipe');
        exit;

    } catch (PDOException $e) {
        $_SESSION['erreur'] = $e->getMessage();
        header('Location: /equipe');
        exit;
    }
}