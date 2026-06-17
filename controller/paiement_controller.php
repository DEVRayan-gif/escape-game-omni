<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '/var/www/sae202-event/vendor/autoload.php';
function simuler() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit;
    }

    $id_reservation = $_POST['id_reservation'] ?? '';
    $nb_joueurs     = $_POST['nb_joueurs'] ?? 4;
    $total          = $_POST['total'] ?? 0;

    $_SESSION['resa_id']      = $id_reservation;
    $_SESSION['resa_joueurs'] = $nb_joueurs;
    $_SESSION['resa_total']   = $total;

    include('/var/www/sae202-event/view/paiement.php');
}
function confirmer() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /connexion');
        exit;
    }

    $id_reservation = $_POST['id_reservation'] ?? '';
    $nb_joueurs     = $_POST['nb_joueurs'] ?? 4;
    $total          = $_POST['total'] ?? 0;

    // Génère un code unique
    $code = 'OMNI-' . strtoupper(substr(md5(uniqid()), 0, 6));

    // Sauvegarde le code en BDD
    try {
        $pdo = new PDO(
            'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
            USER, PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        $stmt = $pdo->prepare("UPDATE RESERVATION SET code_reservation = ?, statut_reservation = 'confirmee' WHERE id_reservation = ?");
        $stmt->execute([$code, $id_reservation]);
    } catch (PDOException $e) {
        $_SESSION['erreur'] = "Erreur BDD : " . $e->getMessage();
        header('Location: /reservation');
        exit;
    }

    // Envoie le code par mail
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'chraibirayan6@gmail.com';
        $mail->Password   = 'qjoh rwvf ziuh lvwt';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('chraibirayan6@gmail.com', 'OMNI');
        $mail->addAddress($_SESSION['user_pseudo']);
        $mail->Subject = "[OMNI] Votre code de réservation : $code";
        $mail->Body    = "Bonjour " . $_SESSION['user_pseudo'] . ",\n\nVotre paiement a été confirmé !\n\nVotre code de réservation : $code\n\nUtilisez ce code lors de l'inscription de votre équipe.\n\n// OMNI SYSTEM";

        $mail->send();
    } catch (Exception $e) {
        // Le code est quand même généré même si le mail échoue
    }

    $_SESSION['code_resa'] = $code;
    header('Location: /paiement/confirmation');
    exit;
}

function confirmation() {
    include('/var/www/sae202-event/view/confirmation_paiement.php');
}