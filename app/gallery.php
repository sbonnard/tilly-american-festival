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
require_once 'includes/classes/class.gallery.php';

if (isset($_SESSION['form'])) {
    unset($_SESSION['form']);
}

countPageVisit('galleryCounter')
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <?= fetchHeader('', '', '', 'nav__lnk--current'); ?>

    <div class="work-in-progress-filter">
        <main class="main work-in-progress-page">
            <div class="container">

                <h1 class="ttl">Galerie</h1>
                <h2 class="subttl ttl--red" id="events-ttl">Tous nos évènements</h2>

                <section class="section" aria-labelledby="events-ttl">
                    <ul class="gallery">
                        <?= getEventsAsGalleryHTML($allEvents); ?>
                    </ul>
                </section>

                <section class="section" aria-labelledby="walloffame-ttl">
                    <h2 class="ttl ttl--red walloffame__ttl" id="walloffame-ttl">Le Wall Of Fame</h2>
                    <?= GetHTMLWallOfFame($wallOfFame); ?>
                </section>

            </div>


            <?= displayCowquitaf(); ?>
        </main>
    </div>

    <footer class="footer">
        <?= fetchFooter($activeSponsors); ?>
    </footer>
</body>

<script>
    AOS.init();
</script>
<script type="module" src="js/burger.js"></script>

</html>