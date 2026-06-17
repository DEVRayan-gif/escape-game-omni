<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Paiement</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/svg" href="/view/images/OMNI_petit_rouge-blanc.svg">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/sae202_style.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/nasalization">
</head>
<body>

<?php include '/var/www/sae202-event/view/autres_pages/header.php'; ?>

<div class="page-wrap">

    <div class="breadcrumb">
        <a href="/accueil">ACCUEIL</a>
        <span>/</span>
        <a href="/reservation">RÉSERVATION</a>
        <span>/</span>
        PAIEMENT
    </div>

    <h1 class="page-title" style="color:var(--rouge);">PAIEMENT</h1>
    <p class="page-intro">Vérifiez votre commande et confirmez le paiement.</p>

    <div class="paiement-layout">

        <!-- RECAP COMMANDE -->
        <div class="paiement-recap">
            <div class="resa-recap-eyebrow">// RÉCAPITULATIF</div>
            <h3 class="resa-recap-title">PROTOCOLE ZÉRO</h3>

            <div class="resa-recap-lines">
                <div class="resa-recap-line">
                    <span class="rcl-label">JOUEURS</span>
                    <span class="rcl-val"><?= $_SESSION['resa_joueurs'] ?> agents</span>
                </div>
                <div class="resa-recap-line">
                    <span class="rcl-label">TARIF</span>
                    <span class="rcl-val">109,99 € / joueur</span>
                </div>
            </div>

            <div class="resa-recap-total">
                <span>TOTAL</span>
                <span class="resa-total-val"><?= $_SESSION['resa_total'] ?> €</span>
            </div>
        </div>

        <!-- FORMULAIRE PAIEMENT SIMULÉ -->
        <div class="paiement-form-wrap">
            <div class="resa-recap-eyebrow">// INFORMATIONS DE PAIEMENT</div>

            <div class="paiement-card-mock">
                <div class="pcm-label">NUMÉRO DE CARTE</div>
                <input type="text" placeholder="4242 4242 4242 4242" maxlength="19" class="pcm-input" id="card-number">

                <div class="pcm-row">
                    <div>
                        <div class="pcm-label">EXPIRATION</div>
                        <input type="text" placeholder="MM/AA" maxlength="5" class="pcm-input">
                    </div>
                    <div>
                        <div class="pcm-label">CVV</div>
                        <input type="text" placeholder="123" maxlength="3" class="pcm-input">
                    </div>
                </div>

                <div class="pcm-label">NOM SUR LA CARTE</div>
                <input type="text" placeholder="AGENT OMNI" class="pcm-input">
            </div>

            <form action="/paiement/confirmer" method="POST">
                <input type="hidden" name="id_reservation" value="<?= $_SESSION['resa_id'] ?>">
                <input type="hidden" name="nb_joueurs" value="<?= $_SESSION['resa_joueurs'] ?>">
                <input type="hidden" name="total" value="<?= $_SESSION['resa_total'] ?>">
                <button type="submit" class="resa-pay-btn" style="margin-top:1.5rem;">
                    CONFIRMER LE PAIEMENT — <?= $_SESSION['resa_total'] ?> €
                </button>
            </form>

            <p class="paiement-mention">// Simulation — aucun paiement réel ne sera effectué</p>
        </div>

    </div>
</div>

<?php include '/var/www/sae202-event/view/autres_pages/footer.php'; ?>

</body>
</html>