<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Mon Équipe</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/svg" href="/view/images/OMNI_petit_rouge-blanc.svg">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/sae202_style.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/nasalization">
</head>
<body>

<?php include '/var/www/sae202-event/view/autres_pages/header.php'; ?>

<section class="equipe-section">

    <!-- BREADCRUMB -->
    <div class="equipe-breadcrumb">
        <a href="/accueil">ACCUEIL</a> / INSCRIPTION ÉQUIPE
    </div>

    <!-- TITRE -->
    <h1 class="equipe-title">INSCRIPTION <span class="accent">ÉQUIPE</span></h1>
    <p class="equipe-desc">Constituez votre cellule d'intervention. Donnez un nom à votre équipe, choisissez un créneau, et ajoutez vos coéquipiers  2 à 6 joueurs pour affronter OMNI.</p>

    <?php if (isset($_SESSION['erreur'])) : ?>
        <div class="alert-erreur"><?= htmlspecialchars($_SESSION['erreur']) ?></div>
        <?php unset($_SESSION['erreur']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['succes'])) : ?>
        <div class="alert-succes"><?= htmlspecialchars($_SESSION['succes']) ?></div>
        <?php unset($_SESSION['succes']); ?>
    <?php endif; ?>

    <form action="/equipe/creer" method="POST" class="equipe-form">

        <!-- BLOC 0.1 -->
        <div class="equipe-bloc">
            <div class="equipe-bloc-header">
                <span class="equipe-num">0.1</span>
                <h2>Votre équipe</h2>
            </div>
            <div class="equipe-bloc-body">
                <div class="equipe-row">
                    <div class="form-group">
                        <label>NOM DE L'ÉQUIPE <span class="required">*</span></label>
                        <input type="text" name="nom_equipe" placeholder="ex: Les briseurs de Protocole" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOC 0.2 -->
        <div class="equipe-bloc">
            <div class="equipe-bloc-header">
                <span class="equipe-num">0.2</span>
                <h2>Les membres</h2>
            </div>
            <div class="equipe-bloc-body">
                <label class="membres-label">NOM DE L'ÉQUIPE <span class="required">*</span></label>
                <div id="membres-list">
                    <div class="membre-row">
                        <span class="membre-num">0.1</span>
                        <input type="text" placeholder="Prénom..." class="membre-prenom">
                        <input type="text" placeholder="Nom..." class="membre-nom">
                        <input type="email" name="membres[]" placeholder="email@exemple.fr" required>
                    </div>
                    <div class="membre-row">
                        <span class="membre-num">0.2</span>
                        <input type="text" placeholder="Prénom..." class="membre-prenom">
                        <input type="text" placeholder="Nom..." class="membre-nom">
                        <input type="email" name="membres[]" placeholder="email@exemple.fr">
                    </div>
                </div>
                <button type="button" class="add-membre-btn" onclick="ajouterMembre()">+ AJOUTER UN MEMBRE</button>
                <p class="membres-hint">// 2 à 6 joueurs · chaque membre reçoit son brief par email (+ 16 ans requis)</p>
            </div>
</div>

<div class="form-group">
    <label>CODE DE RÉSERVATION <span class="required">*</span></label>
    <input type="text" name="code_reservation" placeholder="ex: OMNI-E4441C" required>
</div>

        <button type="submit" class="equipe-submit-btn">S'INSCRIRE</button>

    </form>
</section>

<?php include '/var/www/sae202-event/view/autres_pages/footer.php'; ?>

<script>
let membreCount = 2;

function ajouterMembre() {
    if (membreCount >= 5) return;
    membreCount++;
    const div = document.createElement('div');
    div.className = 'membre-row';
    div.innerHTML = `
        <span class="membre-num">0.${membreCount}</span>
        <input type="text" placeholder="Prénom..." class="membre-prenom">
        <input type="text" placeholder="Nom..." class="membre-nom">
        <input type="email" name="membres[]" placeholder="email@exemple.fr">
    `;
    document.getElementById('membres-list').appendChild(div);
}
</script>

</body>
</html>