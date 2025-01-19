<?php
session_start();

require_once 'includes/_database.php';
require_once 'includes/_config.php';
require_once 'includes/_security.php';
require_once 'includes/_functions.php';
require_once 'includes/_datas.php';
require_once 'includes/templates/_head.php';
require_once 'includes/templates/_header.php';
require_once 'includes/templates/_footer.php';
require_once 'includes/classes/class.band.php';
require_once 'includes/classes/class.sponsor.php';
require_once 'includes/classes/class.merchant.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <header class="header">
        <?= fetchHeader('', '', 'nav__lnk--current'); ?>
    </header>

    <main class="main">
        <div class="container">
            <h1 class="ttl" id="partner-ttl">Nos Partenaires</h1>
            <section class="section" aria-labelledby="parner-ttl">
                <p>En tant que partenaire, rejoignez un événement unique qui célèbre l'âge d'or de la culture américaine des années 50 et 60 ! En devenant partenaire du festival, vous associez votre image à une expérience immersive mêlant voitures vintage, musique rock'n'roll, concours de pin-up, gastronomie américaine et friperies rétro. Profitez d'une visibilité exceptionnelle auprès d'un public passionné et varié, tout en valorisant votre soutien à la culture et à l'authenticité. Faites partie de cette célébration iconique et marquez les esprits avec votre engagement !</p>
                <a href="contact-partner.php" class="button button--partner">Vous souhaitez nous rejoindre ?</a>
            </section>

            <div class="dropdown__container">
                <section class="section" aria-labelledby="sponsor-ttl">
                    <button id="sponsor-dropdown" class="dropdown-banner" aria-label="Afficher ou masquer la liste des sponsors" aria-expanded="false">
                        <h2 class="ttl ttl--red">Nos Sponsors</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="sponsor-dropdown-content">
                        <?= listSponsorsHTML($activeSponsors); ?>
                    </div>
                </section>

                <section class="section" aria-labelledby="merchant-ttl">
                    <button id="merchant-dropdown" class="dropdown-banner" aria-label="Afficher ou masquer la liste des commerçants" aria-expanded="false">
                        <h2 class="ttl ttl--red">Les commerçants</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="merchant-dropdown-content">
                        <?= listMerchantsHTML($activeMerchants); ?>
                    </div>
                </section>
            </div>

        </div>

        <?= displayCowquitaf(); ?>
    </main>

    <footer class="footer">
        <?= fetchFooter($activeSponsors); ?>
    </footer>
</body>

<script>
    AOS.init();
</script>
<script type="module" src="js/burger.js"></script>
<script type="module" src="js/dropdown.js"></script>

</html>