<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil – OMNI</title>
    <link rel="icon" type="image/svg" href="/view/images/OMNI_petit_rouge-blanc.svg">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/sae202_style.css">
</head>
<body>

<?php include '/var/www/sae202-event/view/autres_pages/header.php'; ?>

<div class="profil-page-wrap">

    <!-- BREADCRUMB -->
    <div class="profil-breadcrumb">
        <a href="/">ACCUEIL</a>
        <span>/</span>
        ESPACE PRIVE
    </div>

    <!-- BANNER -->
    <div class="profil-banner">
        <div class="profil-banner-avatar">
            <img src="/view/images/OMNI_petit_rouge-blanc.svg" alt="avatar">
        </div>
        <div class="profil-banner-info">
            <div class="profil-banner-pseudo"><?= htmlspecialchars(strtoupper($user['pseudo'])) ?></div>
            
        </div>
        <div class="profil-banner-badge">• session jouée</div>
    </div>

    <!-- ALERTS -->
    <?php if (isset($_SESSION['erreur'])) : ?>
        <div class="profil-alert-err"><?= htmlspecialchars($_SESSION['erreur']) ?></div>
        <?php unset($_SESSION['erreur']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['succes'])) : ?>
        <div class="profil-alert-ok"><?= htmlspecialchars($_SESSION['succes']) ?></div>
        <?php unset($_SESSION['succes']); ?>
    <?php endif; ?>

    <!-- MAIN GRID -->
    <div class="profil-main-grid">

        <!-- 0.1 MES INFORMATIONS -->
        <div>
            <div class="profil-s-header">
                <div class="profil-s-badge">0.1</div>
                <h2 class="profil-s-title">Mes informations</h2>
                <div class="profil-s-line"></div>
            </div>
            <div class="profil-form-panel">
                <form action="/profil/modifier" method="POST">
                    <label class="profil-field-label">PSEUDO</label>
                    <input class="profil-input" type="text" name="pseudo"
                           value="<?= htmlspecialchars($user['pseudo']) ?>" required>

                    <div class="profil-input-row">
                        <div>
                            <label class="profil-field-label">E-MAIL</label>
                            <input class="profil-input" type="email" name="email"
                                   value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                        <div>
                            <label class="profil-field-label">TELEPHONE</label>
                            <input class="profil-input" type="text" name="telephone"
                                   value="<?= htmlspecialchars($user['telephone'] ?? '') ?>"
                                   placeholder="06 12 34 56 70">
                        </div>
                    </div>

                    <button type="submit" class="profil-btn-enregistrer">ENREGISTRER</button>
                </form>
            </div>
        </div>

        <!-- 0.2 MON SCORE -->
        <div>
            <div class="profil-s-header">
                <div class="profil-s-badge">0.2</div>
                <h2 class="profil-s-title">Mon score</h2>
                <div class="profil-s-line"></div>
            </div>
            <div class="profil-score-panel">
                <?php if ($score) : ?>
                    <div class="profil-score-time"><?= htmlspecialchars($score['temps_evasion']) ?></div>
                    <div class="profil-score-label">TEMPS D'ÉVASION</div>
                    <div class="profil-score-desc">sortie en <?= htmlspecialchars($score['temps_evasion']) ?> de l'escape game</div>
                    <div class="profil-score-rang">RANG : <span class="rang-val"><?= htmlspecialchars($score['rang']) ?></span></div>
                <?php else : ?>
                    <div class="profil-no-score">AUCUNE SESSION JOUÉE</div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- WATERMARK -->
    <div class="profil-watermark">
        <img src="/view/images/OMNI_petit_rouge-blanc.svg" alt="OMNI">
    </div>

    <!-- 0.1 LAISSER UN AVIS -->
    <div class="profil-s-header">
        <div class="profil-s-badge">0.1</div>
        <h2 class="profil-s-title">Laisser un avis</h2>
        <div class="profil-s-line"></div>
    </div>

    <div class="profil-avis-panel">
        <form action="/avis/publier" method="POST">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id_utilisateur']) ?>">
            <input type="hidden" name="note" id="note-hidden" value="0">

            <label class="profil-note-label">VOTRE NOTE</label>
            <div class="profil-stars-wrap">
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <span class="profil-star" data-star="<?= $i ?>" onclick="setNote(<?= $i ?>)">&#9733;</span>
                <?php endfor; ?>
            </div>

            <label class="profil-avis-label">Votre commentaire</label>
            <textarea class="profil-textarea" name="commentaire"
                      placeholder="Raconter votre run face à Omni !..."></textarea>

            <div class="profil-avis-hint">Votre avis sera publié après validation par l'équipe Omni</div>

            <button type="submit" class="profil-btn-publier">PUBLIER MON AVIS</button>
        </form>
    </div>

</div>

<?php include '/var/www/sae202-event/view/autres_pages/footer.php'; ?>

<script>
function setNote(n) {
    document.getElementById('note-hidden').value = n;
    document.querySelectorAll('.profil-star').forEach(function(s, i) {
        s.classList.toggle('active', i < n);
    });
}
</script>

</body>
</html>