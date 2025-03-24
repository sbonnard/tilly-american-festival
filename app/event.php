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
require_once 'includes/classes/class.event.php';

generateToken();

checkConnection($_SESSION);

// Programmation d'un groupe
if (isset($_GET['band']) && intval($_GET['band']) && $_GET['band'] > 0) {
    $bandEvents = getBandEvents($dbCo, $_GET);
    $myBand = getOneBand($dbCo, $_GET);
} else {
    redirectTo('errors/404.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <?= fetchHeader('', '', '', '', '', '', '', 'nav__lnk--current'); ?>

    <main class="main">
        <div class="container">

            <a href="backstage.php" class="button button--backstage">Retour aux backstages</a>

            <div class="container--flex">
                <div class="section" aria-labelledby="band-ttl">
                    <h3 class="ttl ttl--small" id="band-ttl">Fiche de l'Évènement</h3>

                    <div class="section">
                       
                    </div>

                </div>

                <div class="section" aria-labelledby="program-ttl">
                    <h3 class="ttl ttl--small" id="program-ttl">Programmation</h3>

                    <div class="section">
                        <?= getBandEventsAsHTML($bandEvents, $myBand[0]) ?>
                    </div>
                </div>


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
<script type="module" src="js/notifs.js"></script>
<script>
    window.onload = function() {
        window.scrollTo(0, 0); // Scroll vers le tout en haut de la page
    }
</script>

</html>