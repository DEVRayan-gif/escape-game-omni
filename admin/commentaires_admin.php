<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Commentaires</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/nasalization">
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
            <a href="/gestion/inscrits" class="bo-nav-item">
                <span class="bo-nav-icon">&#9707;</span> Inscrits
            </a>
            <a href="/gestion/commentaires" class="bo-nav-item active">
                <span class="bo-nav-icon">&#9744;</span> Commentaires
                <span class="bo-nav-badge">1</span>
            </a>
            <a href="/gestion/scores" class="bo-nav-item">
                <span class="bo-nav-icon">&#9641;</span> Saisie des scores
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
                <h1 class="bo-page-title">Gestion des commentaires</h1>
                <p class="bo-page-sub">// MODÉRATION · 3 AVIS EN ATTENTE DE VALIDATION</p>
            </div>
            <div class="bo-status">
                <span class="bo-dot"></span>
                admin@omnilab · connecté
            </div>
        </div>

        <div class="bo-content">

           <div class="bo-stats">
                <div class="bo-stat">
                    <div class="bo-stat-num"><?= count($inscrits) ?></div>
                    <div class="bo-stat-label">Inscrits</div>
                </div>
                <div class="bo-stat">
                    <div class="bo-stat-num"><?= $nbEquipes ?></div>
                    <div class="bo-stat-label">Équipes</div>
                </div>
                <div class="bo-stat">
                    <div class="bo-stat-num red"><?= $nbCommentaires ?></div>
                    <div class="bo-stat-label">Avis en attente</div>
                </div>
                <div class="bo-stat last">
                    <div class="bo-stat-num cyan"><?= $meilleurTemps ?></div>
                    <div class="bo-stat-label">Meilleur temps</div>
                </div>
            </div>


            <!-- Section titre -->
            <div class="bo-section-head">
                <span class="bo-section-num">02</span>
                <h2 class="bo-section-title">Avis en attente</h2>
                <div class="bo-section-line"></div>
            </div>

            <!-- Tableau commentaires -->
            <table class="bo-table">
                <thead>
                    <tr>
                        <th>Auteur</th>
                        <th>Avis</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
               <tbody>
    <?php foreach ($commentaires as $com) : ?>
    <tr>
        <td>
            <div class="com-auteur"><?= htmlspecialchars($com['pseudo']) ?></div>
            <div class="com-equipe"><?= date('d/m/Y', strtotime($com['date_soumission'])) ?></div>
        </td>
        <td>
            <div class="com-texte">« <?= htmlspecialchars($com['contenu']) ?> »</div>
        </td>
        <td>
            <span class="com-statut <?= $com['statut_commentaire'] ?>">
                <?= strtoupper($com['statut_commentaire']) ?>
            </span>
        </td>
        <td class="actions">
            <a href="/gestion/accepter_commentaire?id=<?= $com['id_commentaire'] ?>" class="btn-accept">ACCEPTER</a>
            <a href="/gestion/refuser_commentaire?id=<?= $com['id_commentaire'] ?>" class="btn-refuse">REFUSER</a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
            </table>

        </div>
    </main>
</div>
</body>
</html>