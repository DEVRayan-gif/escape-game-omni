<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Réservation</title>
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
        RÉSERVATION
    </div>

    <h1 class="page-title accent" style="color:var(--rouge);">RÉSERVATION</h1>
    <p class="page-intro">Choisissez votre date, verrouillez un créneau et constituez votre cellule. OMNI vous attend dans la salle Protocole Zéro.</p>

    <div class="resa-layout">

        <!-- COLONNE GAUCHE -->
        <div class="resa-left">

            <!-- BLOC 0.1 DATE & CRÉNEAU -->
            <div class="resa-bloc">
                <div class="resa-bloc-header">
                    <span class="section-badge">0.1</span>
                    <h2>Date &amp; créneau</h2>
                    <div class="section-line"></div>
                    <span class="resa-icon"><img src="/view/images/image_calendrier.svg" alt="picto1" style="width:40px; height:40px; object-fit:cover;"></span>
                </div>

                <div class="resa-bloc-body">
                    <p class="resa-label">Sélectionnez un jour</p>

                    <div class="resa-dates-wrap">
                        <button class="resa-nav" id="prev-week">&#8249;</button>
                        <div class="resa-dates" id="dates-container"></div>
                        <button class="resa-nav" id="next-week">&#8250;</button>
                    </div>

                    <p class="resa-label" style="margin-top:2rem;">Créneaux disponibles</p>
                    <div class="resa-creneaux" id="creneaux-container">
                        <?php foreach ($creneaux as $c) : ?>
                        <button class="resa-creneau" 
                            data-id="<?= $c['id_reservation'] ?>"
                            data-date="<?= date('Y-m-d', strtotime($c['date_heure_session'])) ?>"
                            data-heure="<?= date('H:i', strtotime($c['date_heure_session'])) ?>"
                            data-statut="<?= $c['statut_reservation'] ?>">
                            <span class="cr-heure"><?= date('H:i', strtotime($c['date_heure_session'])) ?></span>
                            <span class="cr-statut <?= $c['statut_reservation'] === 'confirmee' ? 'complet' : 'libre' ?>">
                                <?= $c['statut_reservation'] === 'confirmee' ? 'COMPLET' : 'Libre' ?>
                            </span>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- BLOC 0.2 NOMBRE DE JOUEURS -->
            <div class="resa-bloc" style="margin-top:2rem;">
                <div class="resa-bloc-header">
                    <span class="section-badge">0.2</span>
                    <h2>Nombre de joueurs</h2>
                    <div class="section-line"></div>
                </div>
                <div class="resa-bloc-body">
                    <div class="resa-joueurs-wrap">
                        <div class="resa-counter">
                            <button class="resa-counter-btn" id="btn-minus">−</button>
                            <span class="resa-counter-val" id="nb-joueurs">4</span>
                            <button class="resa-counter-btn" id="btn-plus">+</button>
                        </div>
                        <p class="resa-counter-info">De 2 à 6 agents par session.<br>Tarif unique <strong>109,99 €</strong> / joueur.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- COLONNE DROITE : RÉCAP -->
        <div class="resa-right">
            <div class="resa-recap">
                <p class="resa-recap-eyebrow">// MISSION SÉLECTIONNÉE</p>
                <h3 class="resa-recap-title">PROTOCOLE ZÉRO</h3>
                <div class="resa-recap-tags">
                    <span class="resa-tag">60 min</span>
                    <span class="resa-tag">2-6 joueurs</span>
                    <span class="resa-tag">Difficulté : 4/5</span>
                </div>

                <div class="resa-recap-lines">
                    <div class="resa-recap-line">
                        <span class="rcl-label">DATE</span>
                        <span class="rcl-val" id="recap-date">–</span>
                    </div>
                    <div class="resa-recap-line">
                        <span class="rcl-label">CRÉNEAU</span>
                        <span class="rcl-val" id="recap-heure">–</span>
                    </div>
                    <div class="resa-recap-line">
                        <span class="rcl-label">JOUEURS</span>
                        <span class="rcl-val" id="recap-joueurs">4 agents</span>
                    </div>
                    <div class="resa-recap-line">
                        <span class="rcl-label">TARIF</span>
                        <span class="rcl-val">109,99 € / joueur</span>
                    </div>
                </div>

                <div class="resa-recap-total">
                    <span>TOTAL ESTIMÉ</span>
                    <span class="resa-total-val" id="recap-total">439,96 €</span>
                </div>

                <form action="/paiement/simuler" method="POST">
                    <input type="hidden" name="id_reservation" id="input-reservation">
                    <input type="hidden" name="nb_joueurs" id="input-joueurs">
                    <input type="hidden" name="total" id="input-total">
                    <button type="submit" class="resa-pay-btn">PROCÉDER AU PAIEMENT</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include '/var/www/sae202-event/view/autres_pages/footer.php'; ?>

<script>
const TARIF = 109.99;
let nbJoueurs = 4;
let selectedCreneau = null;

// ===== COUNTER =====
document.getElementById('btn-minus').addEventListener('click', () => {
    if (nbJoueurs > 2) { nbJoueurs--; updateRecap(); }
});
document.getElementById('btn-plus').addEventListener('click', () => {
    if (nbJoueurs < 6) { nbJoueurs++; updateRecap(); }
});

// ===== CRÉNEAUX =====
document.querySelectorAll('.resa-creneau').forEach(btn => {
    btn.style.display = 'none'; // Cache tous au départ
    if (btn.dataset.statut === 'confirmee') {
        btn.disabled = true;
        return;
    }
    btn.addEventListener('click', () => {
        document.querySelectorAll('.resa-creneau').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        selectedCreneau = btn;
        updateRecap();
    });
});

// ===== FILTRE CRÉNEAUX PAR DATE =====
function filterCreneaux(dateSelectionnee) {
    document.querySelectorAll('.resa-creneau').forEach(btn => {
        if (btn.dataset.date === dateSelectionnee) {
            btn.style.display = 'flex';
        } else {
            btn.style.display = 'none';
            btn.classList.remove('selected');
        }
    });
    selectedCreneau = null;
    updateRecap();
}

// ===== CALENDRIER =====
let weekOffset = 0;

function renderDates() {
    const container = document.getElementById('dates-container');
    container.innerHTML = '';
    const today = new Date();
    let count = 0;
    let dayOffset = 0;

    while (count < 7) {
        const d = new Date(today);
        d.setDate(today.getDate() + weekOffset * 7 + dayOffset);
        dayOffset++;

        // Skip dimanche (0)
        if (d.getDay() === 0) continue;

        const jours = ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'];
        const mois = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];

        const yyyy = d.getFullYear();
        const mm = String(d.getMonth() + 1).padStart(2, '0');
        const dd = String(d.getDate()).padStart(2, '0');
        const dateStr = `${yyyy}-${mm}-${dd}`;

        const div = document.createElement('div');
        div.className = 'resa-date-card';
        div.dataset.date = dateStr;
        div.innerHTML = `
            <span class="rd-jour">${jours[d.getDay()]}</span>
            <span class="rd-num">${d.getDate()}</span>
            <span class="rd-mois">${mois[d.getMonth()]}</span>
        `;

        div.addEventListener('click', () => {
            document.querySelectorAll('.resa-date-card').forEach(c => c.classList.remove('selected'));
            div.classList.add('selected');
            filterCreneaux(dateStr);
        });

        container.appendChild(div);
        count++;
    }
}

document.getElementById('prev-week').addEventListener('click', () => {
    if (weekOffset > 0) { weekOffset--; renderDates(); }
});
document.getElementById('next-week').addEventListener('click', () => {
    weekOffset++;
    renderDates();
});

renderDates();

// ===== RECAP =====
function updateRecap() {
    document.getElementById('nb-joueurs').textContent = nbJoueurs;
    document.getElementById('recap-joueurs').textContent = nbJoueurs + ' agents';
    const total = (nbJoueurs * TARIF).toFixed(2);
    document.getElementById('recap-total').textContent = total + ' €';
    document.getElementById('input-joueurs').value = nbJoueurs;
    document.getElementById('input-total').value = total;

    if (selectedCreneau) {
        const date = new Date(selectedCreneau.dataset.date + 'T00:00:00');
        const jours = ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'];
        const mois = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];
        document.getElementById('recap-date').textContent = jours[date.getDay()] + ' ' + date.getDate() + ' ' + mois[date.getMonth()];
        document.getElementById('recap-heure').textContent = selectedCreneau.dataset.heure;
        document.getElementById('input-reservation').value = selectedCreneau.dataset.id;
    } else {
        document.getElementById('recap-date').textContent = '–';
        document.getElementById('recap-heure').textContent = '–';
        document.getElementById('input-reservation').value = '';
    }
}

updateRecap();
</script>

</body>
</html>