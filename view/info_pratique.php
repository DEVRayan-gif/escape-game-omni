<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Infos Pratiques</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/svg" href="/view/images/OMNI_petit_rouge-blanc.svg">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/sae202_style.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/nasalization">
<head>
    <body>

  <?php include '/var/www/sae202-event/view/autres_pages/header.php'; ?>

<div class="page-wrap">
 
    <!-- fil d'ariane -->
    <div class="breadcrumb">
        <a href="/">Accueil</a>
        <span>/</span>
        Infos pratiques
    </div>
 
    <!-- titre -->
    <h1 class="page-title">INFOS <span class="accent">PRATIQUES</span></h1>
    <p class="page-intro">Horaires, accès et contact. Une question sur une session, un groupe ou un événement privatisé ? Le terminal OMNI réceptionne votre message.</p>
 
    <!-- grille principale -->
    <div class="main-grid">
 
        <!-- COLONNE GAUCHE : contact + carte -->
        <div>
            <div class="section-header">
                <span class="section-badge">0.1</span>
                <h2>Contact &amp; accès</h2>
                <div class="section-line"></div>
            </div>
 
            <ul class="contact-list">
                <li class="contact-item">
                    <div class="contact-icon"><img src="/view/images/telephone 1.svg" alt="pictoTEL" style="width:30px; height:30px; object-fit:contain;"></div>
                    <div>
                        <div class="contact-label">Téléphone</div>
                        <div class="contact-value"><a href="tel:0473000000">04 73 00 00 00</a></div>
                    </div>
                </li>
                <li class="contact-item">
                    <div class="contact-icon"><img src="/view/images/horloge 1.svg" alt="picto horloge" style="width:30px; height:30px; object-fit:contain;"></div>
                    <div>
                        <div class="contact-label">Horaire d'ouverture</div>
                        <div class="contact-value">Mer – Dim / 20h</div>
                    </div>
                </li>
                <li class="contact-item">
                    <div class="contact-icon"><img src="/view/images/email 1.svg" alt="picto horloge" style="width:30px; height:30px; object-fit:contain;"></div>
                    <div>
                        <div class="contact-label">Contact</div>
                        <div class="contact-value"><a href="mailto:contact@gmail.com">contact@gmail.com</a></div>
                    </div>
                </li>
                <li class="contact-item">
                    <div class="contact-icon"><img src="/view/images/localisation 1.svg" alt="picto horloge" style="width:30px; height:30px; object-fit:contain;"></div>
                    <div>
                        <div class="contact-label">Adresse</div>
                        <div class="contact-value">Complexe Daemon 14 rue des Serveurs</div>
                    </div>
                </li>
            </ul>
 
            <!-- ICI TU COLLES TON IFRAME GOOGLE MAPS -->
            <div class="map-placeholder">
                 <div class="map">
    <span class="pin">● COMPLEXE DAEMON · CLERMONT-FD</span>
    <iframe
      title="Carte — Complexe Daemon, Clermont-Ferrand"
      loading="lazy"
      allowfullscreen
      src="https://www.openstreetmap.org/export/embed.html?bbox=3.0700%2C45.7700%2C3.1100%2C45.7850&layer=mapnik&marker=45.7775%2C3.0900">
    </iframe>
  </div>
            </div>
        </div>
 
  
<div>
    <div class="section-header form-section-header">
        <span class="section-badge">0.2</span>
        <h2>Écrire au terminal</h2>
    </div>

    <div class="form-wrap">
        <form action="/contact/envoyer" method="POST">

            <div class="form-group">
                <label>Nom <span class="required">*</span></label>
                <input type="text" name="nom" placeholder="Votre Nom / Nom du groupe" required>
            </div>

            <div class="form-row">
                <div>
                    <label>Email <span class="required">*</span></label>
                    <input type="email" name="email" placeholder="Vous@exemple.fr" required>
                </div>
                <div>
                    <label>Objet <span class="required">*</span></label>
                    <select name="objet">
                        <option>Réservation d'une session</option>
                        <option>Groupe privatisé</option>
                        <option>Événement entreprise</option>
                        <option>Autre</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Message <span class="required">*</span></label>
                <textarea name="message" placeholder="Date souhaitée, nombre de joueurs en question..."></textarea>
            </div>

            <?php if (isset($_SESSION['erreur'])) : ?>
                <div class="alert-erreur"><?= htmlspecialchars($_SESSION['erreur']) ?></div>
                <?php unset($_SESSION['erreur']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['succes'])) : ?>
                <div class="alert-succes"><?= htmlspecialchars($_SESSION['succes']) ?></div>
                <?php unset($_SESSION['succes']); ?>
            <?php endif; ?>

            <button type="submit" class="btn-submit">Transmettre à OMNI</button>

        </form>
    </div>
</div>

    </div>
</div>


<?php include '/var/www/sae202-event/view/autres_pages/footer.php'; ?>
 
</body>
</html>
  