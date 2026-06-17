<nav>

   <button class="burger" id="burger-btn" aria-label="menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <a href="/accueil" class="nav-logo"> <img src="/view/images/OMNI_moyen_rouge-blanc.svg" alt="OMNI" height="40"> </a>

  <ul class="nav-links" id="nav-links">
        <li><a href="/accueil">Accueil</a></li>
        <li><a href="/concept">Concept</a></li>
        <li><a href="/info_pratique">Infos pratiques</a></li>
        <li><a href="/connexion">Connexion</a></li>
    </ul>
 <div class="nav-right">
    <a href="/reservation" class="nav-cta">Réservez</a>
    
    <?php if (isset($_SESSION['user_id'])) : ?>
        <!-- Connecté → menu déroulant -->
        <div class="nav-profil-wrapper">
            <img src="/view/images/profil_2.svg" alt="Profil" height="40" id="profil-btn">
            <div class="profil-menu" id="profil-menu">
                <a href="/profil">Mon profil</a>
                <a href="/equipe">Mon équipe</a>
                <a href="/deconnexion">Déconnexion</a>
            </div>
        </div>
    <?php else : ?>
        <!-- Non connecté → icône de base -->
        <a href="/connexion" class="nav-profil">
            <img src="/view/images/svg_profil.svg" alt="Profil" height="40">
        </a>
    <?php endif; ?>
</div>
</nav>
<script>
// Burger
const burgerBtn = document.getElementById('burger-btn');
const navLinks = document.getElementById('nav-links');

burgerBtn.addEventListener('click', () => {
    burgerBtn.classList.toggle('open');
    navLinks.classList.toggle('open');
});

// Profil menu
const profilBtn = document.getElementById('profil-btn');
const profilMenu = document.getElementById('profil-menu');

if (profilBtn) {
    profilBtn.addEventListener('click', () => {
        profilMenu.classList.toggle('open');
    });

    document.addEventListener('click', (e) => {
        if (!profilBtn.contains(e.target) && !profilMenu.contains(e.target)) {
            profilMenu.classList.remove('open');
        }
    });
}
</script>