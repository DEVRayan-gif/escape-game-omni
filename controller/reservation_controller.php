<?php
include('/var/www/sae202-event/model/reservation_model.php');

function index() {
if (!isset($_SESSION['user_id'])) {
    $_SESSION['erreur'] = "Vous devez vous connecter pour réserver une session.";
    $_SESSION['redirect_after_login'] = '/reservation';
    header('Location: /connexion');
    exit;
}
    $creneaux = getCreneauxDisponibles();
    include('/var/www/sae202-event/view/reservation.php');
}