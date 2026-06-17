<?php
function getCreneauxDisponibles() {
    $pdo = new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER, PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->query("SELECT * FROM RESERVATION WHERE id_equipe IS NULL ORDER BY date_heure_session ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}