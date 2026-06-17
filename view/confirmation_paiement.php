<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Confirmation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/svg" href="/view/images/OMNI_petit_rouge-blanc.svg">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/sae202_style.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/nasalization">
</head>
<body>

<?php include '/var/www/sae202-event/view/autres_pages/header.php'; ?>

<div class="page-wrap" style="text-align:center; max-width:600px; margin:0 auto; padding:5rem 2rem;">

    <div class="confirm-icon">✓</div>

    <h1 class="page-title" style="color:#3ecf6a; margin-top:1rem;">PAIEMENT CONFIRMÉ</h1>

    <p style="color:var(--blanc-dim); font-size:0.95rem; line-height:1.7; margin:1.5rem 0;">
        Votre réservation a bien été enregistrée.<br>
        Un code de confirmation a été envoyé à votre adresse email.
    </p>

    <?php if (isset($_SESSION['code_resa'])) : ?>
    <div class="confirm-code">
        <p class="resa-recap-eyebrow" style="margin-bottom:0.5rem;">// VOTRE CODE</p>
        <div class="confirm-code-val"><?= $_SESSION['code_resa'] ?></div>
        <p style="color:#444; font-family:'Share Tech Mono',monospace; font-size:0.65rem; margin-top:0.8rem; letter-spacing:.1em;">
            UTILISEZ CE CODE LORS DE L'INSCRIPTION DE VOTRE ÉQUIPE
        </p>
    </div>
    <?php unset($_SESSION['code_resa']); ?>
    <?php endif; ?>

    <div style="margin-top:2.5rem; display:flex; gap:1rem; justify-content:center;">
        <a href="/equipe" class="btn-cta">INSCRIRE MON ÉQUIPE</a>
        <a href="/accueil" class="cta-link">Retour à l'accueil</a>
    </div>

</div>

<?php include '/var/www/sae202-event/view/autres_pages/footer.php'; ?>

</body>
</html>