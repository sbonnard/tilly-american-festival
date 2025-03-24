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
require_once 'includes/classes/class.event.php';
require_once 'includes/classes/class.gallery.php';

if (isset($_SESSION['form'])) {
    unset($_SESSION['form']);
}

if (isset($_GET['event']) && intval($_GET['event']) && $_GET['event'] > 0) {
    $myEvent = getOneEvent($dbCo, $_GET);
}

$allBandEvent = getAllBandsFromEvent($dbCo, $_GET);

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

                
                <h1 class="ttl"><?= $myEvent['name'] ?></h1>
                
                <a href="gallery.php" class="button button--backstage">Retour galerie</a>
                
                <section class="section" aria-labelledby="events-ttl">
                    <h2 class="ttl ttl--red" id="events-ttl">Galerie <?= $myEvent['year'] ?></h2>
                    <div class="gallery">
                        <?= getPhotosAsHTML(getOneEventGalleryPhotos($dbCo, $_GET)); ?>
                    </div>
                </section>

                <section class="section" aria-labelledby="prog-ttl">
                    <h2 class="ttl ttl--red" id="prog-ttl">Programmation <?= $myEvent['year'] ?></h2>
                    <div class="gallery__artist-section">
                        <?= GetHTMLWallOfFame($allBandEvent); ?>

                    </div>
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