<?php
function getUserById($id) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("SELECT id_utilisateur, pseudo, email, telephone, role, date_modification FROM UTILISATEUR WHERE id_utilisateur = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser($id, $pseudo, $email, $telephone) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("UPDATE UTILISATEUR SET pseudo = ?, email = ?, telephone = ?, date_modification = NOW() WHERE id_utilisateur = ?");
    $stmt->execute([$pseudo, $email, $telephone, $id]);
}

function updatePassword($id, $mdp_hash) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("UPDATE UTILISATEUR SET mot_de_passe = ?, date_modification = NOW() WHERE id_utilisateur = ?");
    $stmt->execute([$mdp_hash, $id]);
}
function getScoreByUserId($id) {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->prepare("
     SELECT s.valeur_score
FROM SCORE s
WHERE s.id_equipe = ?
ORDER BY s.valeur_score ASC
LIMIT 1
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}