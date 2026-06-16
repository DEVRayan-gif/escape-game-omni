<?php

function connexionBDD() {
    return new PDO(
        'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8mb4',
        USER,
        PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}

function getUserByEmail($email) {
    $pdo = connexionBDD();
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function emailExiste($email) {
    $pdo = connexionBDD();
    $stmt = $pdo->prepare("SELECT id_utilisateur FROM UTILISATEUR WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function creerUtilisateur($pseudo, $email, $mdp_hash, $telephone) {
    $pdo = connexionBDD();
    $stmt = $pdo->prepare("INSERT INTO UTILISATEUR (pseudo, email, mot_de_passe, telephone, role) VALUES (?, ?, ?, ?, 'joueur')");
    $stmt->execute([$pseudo, $email, $mdp_hash, $telephone]);
}

function getInscrits() {
    $pdo = connexionBDD();
    $stmt = $pdo->query("
        SELECT 
            u.id_utilisateur,
            u.pseudo,
            u.email,
            e.nom_equipe,
            r.date_heure_session
        FROM UTILISATEUR u
        LEFT JOIN EQUIPE e ON u.id_equipe = e.id_equipe
        LEFT JOIN RESERVATION r ON e.id_equipe = r.id_equipe
        WHERE u.role = 'joueur'
        ORDER BY u.id_utilisateur
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getNbEquipes() {
    $pdo = connexionBDD();
    return $pdo->query("SELECT COUNT(*) FROM EQUIPE")->fetchColumn();
}

function getNbCommentaires() {
    $pdo = connexionBDD();
    return $pdo->query("SELECT COUNT(*) FROM COMMENTAIRE")->fetchColumn();
}

function supprimerInscrit($id) {
    $pdo = connexionBDD();
    $stmt = $pdo->prepare("DELETE FROM UTILISATEUR WHERE id_utilisateur = ?");
    $stmt->execute([intval($id)]);
}

function getInscritById($id) {
    $pdo = connexionBDD();
    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE id_utilisateur = ?");
    $stmt->execute([intval($id)]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function modifierInscrit($id, $pseudo, $email, $telephone) {
    $pdo = connexionBDD();
    $stmt = $pdo->prepare("UPDATE UTILISATEUR SET pseudo=?, email=?, telephone=? WHERE id_utilisateur=?");
    $stmt->execute([$pseudo, $email, $telephone, intval($id)]);
}

function ajouterInscrit($pseudo, $email, $telephone, $mdp, $id_equipe) {
    $pdo = connexionBDD();
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO UTILISATEUR (pseudo, email, telephone, mot_de_passe, role, id_equipe) VALUES (?, ?, ?, ?, 'joueur', ?)");
    $stmt->execute([$pseudo, $email, $telephone, $mdp_hash, $id_equipe]);
}

function getEquipes() {
    $pdo = connexionBDD();
    $stmt = $pdo->query("SELECT * FROM EQUIPE");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getReservations() {
    $pdo = connexionBDD();
    $stmt = $pdo->query("SELECT * FROM RESERVATION");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getCommentaires() {
    $pdo = connexionBDD();
    $stmt = $pdo->query("
        SELECT c.id_commentaire, c.contenu, c.statut_commentaire, c.date_soumission, u.pseudo
        FROM COMMENTAIRE c
        JOIN UTILISATEUR u ON c.id_utilisateur = u.id_utilisateur
        ORDER BY c.date_soumission DESC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function changerStatutCommentaire($id, $statut) {
    $pdo = connexionBDD();
    $stmt = $pdo->prepare("UPDATE COMMENTAIRE SET statut_commentaire=? WHERE id_commentaire=?");
    $stmt->execute([$statut, intval($id)]);
}
function getScores() {
    $pdo = connexionBDD();
    $stmt = $pdo->query("
        SELECT 
            e.id_equipe,
            e.nom_equipe,
            r.date_heure_session,
            COUNT(u.id_utilisateur) as nb_joueurs,
            s.valeur_score,
            s.id_score
        FROM EQUIPE e
        LEFT JOIN RESERVATION r ON e.id_equipe = r.id_equipe
        LEFT JOIN UTILISATEUR u ON e.id_equipe = u.id_equipe
        LEFT JOIN SCORE s ON e.id_equipe = s.id_equipe
        GROUP BY e.id_equipe, e.nom_equipe, r.date_heure_session, s.valeur_score, s.id_score
        ORDER BY e.id_equipe
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function saisirScore($id_equipe) {
    $pdo = connexionBDD();
    $stmt = $pdo->prepare("SELECT id_score FROM SCORE WHERE id_equipe = ?");
    $stmt->execute([intval($id_equipe)]);
    $exist = $stmt->fetch();

    if ($exist) {
        $stmt = $pdo->prepare("UPDATE SCORE SET statut_score = 'valide' WHERE id_equipe = ?");
        $stmt->execute([intval($id_equipe)]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO SCORE (id_equipe, statut_score) VALUES (?, 'valide')");
        $stmt->execute([intval($id_equipe)]);
    }
}
function getMeilleurTemps() {
    $pdo = connexionBDD();
    $result = $pdo->query("SELECT MIN(valeur_score) as meilleur FROM SCORE WHERE statut_score = 'valide' AND valeur_score > 0")->fetch();
    return $result['meilleur'] ? gmdate('i:s', $result['meilleur']) : '—';
}