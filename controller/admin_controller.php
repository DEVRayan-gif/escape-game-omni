<?php
require_once('/var/www/sae202-event/model/connexion_model.php');

function index() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    header('Location: /gestion/inscrits');
    exit;
}

function inscrits() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: admin/connexion_admin.php');
        exit;
    }
    $inscrits       = getInscrits();
    $nbEquipes      = getNbEquipes();
    $nbCommentaires = getNbCommentaires();
    $meilleurTemps  = getMeilleurTemps();
    include('/var/www/sae202-event/admin/inscrits_admin.php');
}

function supprimer_inscrit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $id = $_GET['id'] ?? null;
    if ($id) {
        supprimerInscrit($id);
    }
    header('Location: /gestion/inscrits');
    exit;
}

function modifier_inscrit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: /gestion/inscrits');
        exit;
    }
    $inscrit = getInscritById($id);
    include('/var/www/sae202-event/admin/modifier_inscrit.php');
}

function valider_modifier_inscrit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $id        = $_POST['id'];
    $pseudo    = $_POST['pseudo'];
    $email     = $_POST['email'];
    $telephone = $_POST['telephone'];
    modifierInscrit($id, $pseudo, $email, $telephone);
    header('Location: /gestion/inscrits');
    exit;
}

function ajouter_inscrit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $equipes      = getEquipes();
    $reservations = getReservations();
    include('/var/www/sae202-event/admin/ajouter_inscrit.php');
}

function valider_ajouter_inscrit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $pseudo    = $_POST['pseudo'];
    $email     = $_POST['email'];
    $telephone = $_POST['telephone'];
    $mdp       = $_POST['mot_de_passe'];
    $id_equipe = $_POST['id_equipe'] ?: null;
    ajouterInscrit($pseudo, $email, $telephone, $mdp, $id_equipe);
    header('Location: /gestion/inscrits');
    exit;
}
function commentaires() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $commentaires   = getCommentaires();
    $inscrits       = getInscrits();
    $nbEquipes      = getNbEquipes();
    $nbCommentaires = getNbCommentaires();
    $meilleurTemps  = getMeilleurTemps();
    include('/var/www/sae202-event/admin/commentaires_admin.php');
}

function accepter_commentaire() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $id = $_GET['id'] ?? null;
    if ($id) changerStatutCommentaire($id, 'approuve');
    header('Location: /gestion/commentaires');
    exit;
}

function refuser_commentaire() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $id = $_GET['id'] ?? null;
    if ($id) changerStatutCommentaire($id, 'refuse');
    header('Location: /gestion/commentaires');
    exit;
}
function scores() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $scores         = getScores();
    $nbEquipes      = getNbEquipes();
    $nbCommentaires = getNbCommentaires();
    $inscrits       = getInscrits();
    $meilleurTemps  = getMeilleurTemps();
    include('/var/www/sae202-event/admin/scores_admin.php');
}

function valider_score() {
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
        header('Location: /connexion/admin');
        exit;
    }
    $id_equipe = $_POST['id_equipe'];
    saisirScore($id_equipe);
    header('Location: /gestion/scores');
    exit;
}