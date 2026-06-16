<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>OMNI – Modifier inscrit</title>
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
                <h1 class="bo-page-title">Modifier un inscrit</h1>
                <p class="bo-page-sub">// OMNI_SYSTEM · ID <?= $inscrit['id_utilisateur'] ?></p>
            </div>
        </div>

        <div class="bo-content">
            <form action="/gestion/valider_modifier_inscrit" method="POST" class="bo-form">
                <input type="hidden" name="id" value="<?= $inscrit['id_utilisateur'] ?>">

                <div class="bo-form-group">
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" value="<?= htmlspecialchars($inscrit['pseudo']) ?>">
                </div>
                <div class="bo-form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($inscrit['email']) ?>">
                </div>
                <div class="bo-form-group">
                    <label>Téléphone</label>
                    <input type="text" name="telephone" value="<?= htmlspecialchars($inscrit['telephone'] ?? '') ?>">
                </div>

                <button type="submit" class="admin-login-btn">ENREGISTRER</button>
                <a href="/gestion/inscrits" class="bo-nav-link" style="margin-top:10px">← Retour à la liste</a>
            </form>
        </div>
    </main>
</div>
</body>
</html>