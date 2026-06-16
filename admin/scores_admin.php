<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMNI – Scores</title>
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
            <a href="/gestion/commentaires" class="bo-nav-item">
                <span class="bo-nav-icon">&#9744;</span> Commentaires
                <span class="bo-nav-badge"><?= $nbCommentaires ?></span>
            </a>
            <a href="/gestion/scores" class="bo-nav-item active">
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
                <h1 class="bo-page-title">Saisie des scores</h1>
                <p class="bo-page-sub">// RÉSULTATS DES SESSIONS · CLASSEMENT LIVE</p>
            </div>
            <div class="bo-status">
                <span class="bo-dot"></span>
                <?= htmlspecialchars($_SESSION['user_pseudo']) ?> · connecté
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


            <div class="bo-section-head">
                <span class="bo-section-num">03</span>
                <h2 class="bo-section-title">Temps des équipes</h2>
                <div class="bo-section-line"></div>
            </div>

            <table class="bo-table">
                <thead>
                    <tr>
                        <th>Équipe</th>
                        <th>Créneau</th>
                        <th>Joueurs</th>
                        <th>Temps / Score</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scores as $score) : ?>
                    <tr>
                        <td class="team"><?= htmlspecialchars($score['nom_equipe']) ?></td>
                        <td class="slot">
                            <?= $score['date_heure_session'] 
                                ? date('D d · H\hi', strtotime($score['date_heure_session'])) 
                                : '<span style="color:#444">—</span>' ?>
                        </td>
                        <td><?= $score['nb_joueurs'] ?></td>
                        <td>
                            <form action="/gestion/valider_score" method="POST" class="score-form">
                                <input type="hidden" name="id_equipe" value="<?= $score['id_equipe'] ?>">
                                <input type="text" name="valeur_score" 
                                       class="score-input" 
                                       placeholder="00:00"
                                       value="<?= $score['valeur_score'] ? gmdate('i:s', $score['valeur_score']) : '' ?>">
                            </form>
                        </td>
                        <td>
                            <button type="submit" form="form-<?= $score['id_equipe'] ?>" 
                                    class="btn-edit"
                                    onclick="this.closest('tr').querySelector('form').submit()">
                                VALIDER
                            </button>
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