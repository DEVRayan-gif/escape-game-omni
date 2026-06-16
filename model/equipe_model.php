<?php
function getEquipeByUser($id_utilisateur) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("
        SELECT e.*, u2.pseudo, u2.email, u2.telephone, u2.id_utilisateur
        FROM EQUIPE e
        JOIN UTILISATEUR u ON u.id_equipe = e.id_equipe
        JOIN UTILISATEUR u2 ON u2.id_equipe = e.id_equipe
        WHERE u.id_utilisateur = ?
    ");
    $stmt->execute([$id_utilisateur]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function creerEquipe($nom_equipe) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("INSERT INTO EQUIPE (nom_equipe, date_creation) VALUES (?, NOW())");
    $stmt->execute([$nom_equipe]);
    return $pdo->lastInsertId();
}

function rejoindreEquipe($id_utilisateur, $id_equipe) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("UPDATE UTILISATEUR SET id_equipe = ? WHERE id_utilisateur = ?");
    $stmt->execute([$id_equipe, $id_utilisateur]);
}

function getCreneaux() {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->query("SELECT * FROM RESERVATION ORDER BY date_heure_session ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addMembreEquipe($id_utilisateur, $id_equipe) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("UPDATE UTILISATEUR SET id_equipe = ? WHERE id_utilisateur = ?");
    $stmt->execute([$id_equipe, $id_utilisateur]);
}

function getUserByEmailForEquipe($email) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("SELECT id_utilisateur, pseudo, email FROM UTILISATEUR WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function lierCreneauEquipe($id_reservation, $id_equipe) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("UPDATE RESERVATION SET id_equipe = ? WHERE id_reservation = ?");
    $stmt->execute([$id_equipe, $id_reservation]);
}