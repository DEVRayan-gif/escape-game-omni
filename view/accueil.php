<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Protocole Zéro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/svg" href="/view/images/OMNI_petit_rouge-blanc.svg">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/sae202_style.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/nasalization">
</head>
<body>
 
<?php include '/var/www/sae202-event/view/autres_pages/header.php'; ?>
 
<main>
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-corner-tr"></div>
    <div class="hero-corner-bl"></div>
 
    <div class="hero-content">
        <p class="hero-eyebrow">Escape Game Nocturne / 14h d'Immersion</p>
        <span class="hero-title-line1">PROTOCOLE</span>
        <span class="hero-title-line2">ZÉRO</span>
        <p class="hero-tagline">OMNI A DÉCIDÉ. <strong>LES PORTES SONT FERMÉES</strong></p>
        <p class="hero-system-line">system shutdown in <span id="hero-countdown-inline"></span> &nbsp;– Toutes les issues sont scellées</p>
        <div class="countdown-wrap">
            <div class="countdown-display" id="countdown">00:00:00</div>
        </div>
        <a href="/reservation" class="hero-btn">Réservez votre place ici</a>
    </div>
 
   <div class="hero-logo-wrap">
    <svg class="glitch-logo" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <radialGradient id="rg" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#e01a1a" stop-opacity="0.8"/>
                <stop offset="100%" stop-color="#e01a1a" stop-opacity="0"/>
            </radialGradient>
        </defs>
        <g fill="none">
            <?php
            $cx = 100; $cy = 100; $r = 10; $gap = 2;
            $cols = 7; $rows = 7;
            $dx = $r * 2 + $gap;
            $dy = $r * sqrt(3) + $gap;
            for($row = 0; $row < $rows; $row++) {
                for($col = 0; $col < $cols; $col++) {
                    $x = ($col - $cols/2) * $dx + ($row % 2 == 0 ? 0 : $dx/2) + $cx;
                    $y = ($row - $rows/2) * $dy + $cy;
                    $dist = sqrt(($x-$cx)**2 + ($y-$cy)**2);
                    if($dist < 75) {
                        $opacity = max(0.2, 1 - $dist/75);
                        echo "<circle cx=\"$x\" cy=\"$y\" r=\"{$r}\" fill=\"#e01a1a\" opacity=\"$opacity\"/>\n";
                    }
                }
            }
            ?>
        </g>
        <circle cx="100" cy="100" r="70" stroke="#e01a1a" stroke-width="2" stroke-dasharray="8 4" fill="none" opacity="0.3"/>
    </svg>

    <!-- Logo binaire qui apparait après le glitch -->
    <img src="/view/images/pictogramme_LOGO_OMNI_CODE_BINAIRE_1.svg" class="binary-logo" alt="binary">
</div>
</section>
 
<!-- PRÉSENTATION -->
<section class="presentation">
    <p class="section-eyebrow">Présentation</p>
    <div class="section-divider"></div>
    <h2 class="section-title style-h2">BIENVENUE DANS <span class="accent">LE COMPLEXE</span></h2>
 
    <div class="presentation-grid">
        <div class="presentation-text">
            <p>Un décor de <strong>1200 m²</strong> entièrement conçu pour vous plonger dans le siège de Tech'In Co : salles serveurs, couloirs sous tension, salle de conférence en alerte rouge. Chaque pièce est plantée en temps réel par OMNI.</p>
            <ul class="check-list">
                <li><strong>Décors immersifs</strong> à 360°, son spatialisé et lumière dynamique.</li>
                <li><strong>Comédiens en direct</strong> et interactions avec l'IA tout au long du jeu.</li>
                <li><strong>Espace détente</strong> et bar à thème ouvert avant et après la mission.</li>
            </ul>
        </div>
        <div class="presentation-images">
            <img src="/view/images/photo-batimentagence.webp" alt="image 1" class="img-big" style="width:100%; object-fit:cover;">
            <div class="img-row">
                <div class="img-placeholder img-small"> <img src="/view/images/photo2.webp" alt="image 2" class="img-small" style="width:100%; object-fit:cover;"></div>
                <div class="img-placeholder img-small"><img src="/view/images/photo3.webp" alt="image 3" class="img-small" style="width:100%; object-fit:cover;"></div>
            </div>
        </div>
    </div>
</section>
 
<!-- STATS -->
<section class="stats">
    <p class="section-eyebrow">OMNI</p>
    <div class="section-divider"></div>
    <h3 class="section-title style-h2">UNE NUIT POUR <span class="accent">REPRENDRE LE<br>CONTRÔLE</span></h3>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value"><span class="digital">12:00</span> <span class="unit">heures</span></div>
            <div class="stat-label">durée du jeu</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-card">
            <div class="stat-value">6 <span class="unit">joueurs</span></div>
            <div class="stat-label">maximum</div>
        </div>
    </div>

    <div class="stat-difficulty">
        <div class="difficulty-dots">
            <div class="dot filled"></div>
            <div class="dot filled"></div>
            <div class="dot filled"></div>
            <div class="dot filled"></div>
            <div class="dot"></div>
        </div>
        <div class="diff-label">Difficulté élevée</div>
    </div>
</section>
 
<!-- RÈGLES -->
<section class="regles">
    <p class="section-eyebrow">Protocole de survie</p>
    <div class="section-divider"></div>
    <h4 class="section-title style-h2">LES <span class="accent">RÈGLES</span></h4>
 
    <div class="regles-grid">
        <div class="regle-card">
            <div class="regle-icon"><img src="/view/images/pictogramme1.svg" alt="picto1" style="width:40px; height:40px; object-fit:contain;"></div>
            <div class="regle-text">téléphone interdit</div>
        </div>
        <div class="regle-card">
            <div class="regle-icon"><img src="/view/images/pictogramme_2.svg" alt="picto1" style="width:40px; height:40px; object-fit:contain;"></div>
            <div class="regle-text">Ne forcez rien</div>
        </div>
        <div class="regle-card">
            <div class="regle-icon"><img src="/view/images/pictogramme_3.svg" alt="picto2" style="width:40px; height:40px; object-fit:contain;"></div>
            <div class="regle-text">3 indices maximum</div>
        </div>
        <div class="regle-card">
            <div class="regle-icon"><img src="/view/images/pictogramme_4.svg" alt="picto3" style="width:40px; height:40px; object-fit:contain;"></div>
            <div class="regle-text">Restez en équipe</div>
        </div>
    </div>
</section>
 
<!-- TÉMOIGNAGES -->
<section class="temoignages">
    <p class="section-eyebrow">Rapport des survivants</p>
    <div class="section-divider"></div>
    <h5 class="section-title style-h2">ILS ONT <span class="accent">AFFRONTÉS OMNI</span></h5>
 
    <div class="temoignages-grid">
        <div class="temoignage-card">
            <div class="stars">★★★★★</div>
            <div class="temoignage-tag">SURVIVANT</div>
            <p class="temoignage-text">Immersion totale. À un moment OMNI a prononcé mon prénom dans le haut-parleur, on a tous crié. Le décor, le son, le scénario, du très haut niveau.</p>
            <div class="temoignage-author">
                <div class="author-avatar">LM</div>
                <span class="author-name">LÉA M.</span>
            </div>
        </div>
        <div class="temoignage-card">
            <div class="stars">★★★★★</div>
            <div class="temoignage-tag">SURVIVANT</div>
            <p class="temoignage-text">Une expérience hors du commun. L'IA interagit vraiment avec vous, c'est bluffant. On a failli ne pas s'en sortir mais on a réussi in extremis !</p>
            <div class="temoignage-author">
                <div class="author-avatar">TR</div>
                <span class="author-name">THOMAS R.</span>
            </div>
        </div>
        <div class="temoignage-card">
            <div class="stars">★★★★</div>
            <div class="temoignage-tag">ÉLIMINÉ</div>
            <p class="temoignage-text">Même en échouant c'était incroyable. La mise en scène est parfaite, les comédiens sont top. On revient l'année prochaine pour se venger !</p>
            <div class="temoignage-author">
                <div class="author-avatar">NB</div>
                <span class="author-name">NAOR B.</span>
            </div>
        </div>
    </div>
 
    <div class="rating-global">4.9<span>/5</span></div>
</section>



<?php if (isset($_SESSION['succes'])) : ?>
<div id="toast" class="toast">
    <?= htmlspecialchars($_SESSION['succes']) ?>
</div>
<?php unset($_SESSION['succes']); ?>
<?php endif; ?>

</main>

<script>
    const toast = document.getElementById('toast');
    // apparait
    setTimeout(() => toast.classList.add('show'), 100);
    // disparait vers la gauche
    setTimeout(() => toast.classList.remove('show'), 3000);
</script>
 
<?php include '/var/www/sae202-event/view/autres_pages/footer.php'; ?>

<script>
function updateCountdown() {
    const now = new Date();
    const target = new Date();
    target.setHours(20, 0, 0, 0);
    if (now >= target) target.setDate(target.getDate() + 1);
    const diff = target - now;
    const h = Math.floor(diff / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);
    const pad = n => String(n).padStart(2,'0');
    const str = `${pad(h)}:${pad(m)}:${pad(s)}`;
    document.getElementById('countdown').textContent = str;
    const il = document.getElementById('hero-countdown-inline');
    if(il) il.textContent = str;
}
updateCountdown();
setInterval(updateCountdown, 1000);
</script>
 
</body>
</html>