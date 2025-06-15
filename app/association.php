<?php
session_start();

require_once 'includes/_database.php';
require_once 'includes/_config.php';
require_once 'includes/_security.php';
require_once 'includes/_functions.php';
require_once 'includes/_datas.php';
require_once 'includes/_message.php';
require_once 'includes/templates/_head.php';
require_once 'includes/templates/_header.php';
require_once 'includes/templates/_footer.php';
require_once 'includes/classes/class.band.php';
require_once 'includes/classes/class.sponsor.php';
require_once 'includes/classes/class.merchant.php';

generateToken();

if (isset($_SESSION['form'])) {
    unset($_SESSION['form']);
}

countPageVisit('associationCounter')
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <?= fetchHeader('', '', '', '', 'nav__lnk--current'); ?>

    <main class="main">
        <div class="container">
            <h1 class="ttl" id="association-ttl">L'association</h1>
            <section class="section" aria-labelledby="association-ttl">
                <img class="association__img" src="img/assoTAF2024.webp" alt="Photo des membres de l'association du TAF">
                <p>Derrière le Tilly American Festival, il y a bien plus que de la musique, des voitures américaines et des stands gourmands. Il y a une équipe de passionnés, tous bénévoles, réunis au sein d’une association dynamique et engagée.</p>
                <p>Cette association, née de l’envie de faire vivre la culture américaine en plein cœur de notre région, est le moteur du festival. Ses membres organisent chaque édition avec le cœur, dans une ambiance conviviale et festive, portée par une véritable passion pour les États-Unis, leur musique, leurs véhicules mythiques, leur folklore… et surtout par l’envie de partager tout cela avec le public.</p>
                <p>Tout au long de l’année, les bénévoles de l’association travaillent dans l’ombre : recherche d’artistes, logistique, partenariats, communication, sécurité, gestion des exposants, décoration… rien n’est laissé au hasard. Et quand le festival arrive, ils sont sur tous les fronts, toujours avec le sourire, pour que chaque visiteur reparte avec des étoiles plein les yeux.</p>
            </section>
        </div>

        <section class="section" aria-labelledby="association-ttl">
            <h2 class="ttl ttl--small ttl--red">Retrouvez-nous sur les réseaux sociaux</h2>
            <div class="linktree">
                <a href="https://www.instagram.com/tilly.americanfestival14/" target="_blank">
                    <img class="linktree__icon" src="img/insta.svg" alt="Logo Instagram">
                </a>
                <a href="https://www.facebook.com/tillyamericanfestival/" target="_blank">
                    <img class="linktree__icon" src="img/facebook.svg" alt="Logo Facebook">
                </a>
            </div>
        </section>

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

</html>