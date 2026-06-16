<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Ajouter inscrit</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/view/css/sae202_style.css">
</head>
<body>
<div class="bo-wrap">

    <aside class="bo-sidebar">
        <div class="bo-logo">
            <img src="/view/images/OMNI_petit_rouge-blanc.svg" alt="OMNI" height="38">
        </div>
        <p class="bo-breadcrumb">Gestion · Protocole Zéro</p>
        <nav class="bo-nav">
            <a href="/gestion/inscrits" class="bo-nav-item active">
                <span class="bo-nav-icon">&#9707;</span> Inscrits
            </a>
        </nav>
        <div class="bo-sidebar-footer">
            <a href="/accueil" class="bo-nav-link"><span>&#8594;</span> Retour au site</a>
            <a href="/deconnexion" class="bo-nav-link"><span>&#8594;</span> Déconnexion</a>
        </div>
    </aside>

    <main class="bo-main">
        <div class="bo-topbar">
            <div>
                <h1 class="bo-page-title">Ajouter un inscrit</h1>
                <p class="bo-page-sub">// OMNI_SYSTEM · NOUVEL UTILISATEUR</p>
            </div>
        </div>

        <div class="bo-content">
            <form action="/gestion/valider_ajouter_inscrit" method="POST" class="bo-form">

                <div class="bo-form-group">
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" placeholder="pseudo" required>
                </div>

                <div class="bo-form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="email@exemple.fr" required>
                </div>

                <div class="bo-form-group">
                    <label>Téléphone</label>
                    <input type="text" name="telephone" placeholder="0612345678">
                </div>

                <div class="bo-form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="mot_de_passe" placeholder="••••••••" required>
                </div>

                <div class="bo-form-group">
                    <label>Équipe</label>
                    <select name="id_equipe">
                        <option value="">— Aucune équipe —</option>
                        <?php foreach ($equipes as $equipe) : ?>
                            <option value="<?= $equipe['id_equipe'] ?>">
                                <?= htmlspecialchars($equipe['nom_equipe']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="bo-form-group">
                    <label>Créneau</label>
                    <select name="id_reservation">
                        <option value="">— Aucun créneau —</option>
                        <?php foreach ($reservations as $resa) : ?>
                            <option value="<?= $resa['id_reservation'] ?>">
                                <?= date('D d · H\hi', strtotime($resa['date_heure_session'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="admin-login-btn">AJOUTER</button>
                <a href="/gestion/inscrits" class="bo-nav-link" style="margin-top:10px">← Retour à la liste</a>

            </form>
        </div>
    </main>
</div>
</body>
</html>