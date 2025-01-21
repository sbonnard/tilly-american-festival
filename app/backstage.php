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

require_once 'includes/classes/class.event.php';
require_once 'includes/classes/class.band.php';
require_once 'includes/classes/class.merchant.php';
require_once 'includes/classes/class.sponsor.php';


generateToken();

if (!isset($_SESSION['username']) || !isset($_SESSION['id_roady']) || !isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    redirectTo('errors/403.php');
}

$allBands = fetchAllBands($dbCo);
$allEvents = fetchAllEvents($dbCo);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <header class="header">
        <?= fetchHeader(); ?>
    </header>

    <main class="main">
        <div class="container">
            <h1 class="ttl" id="partner-ttl">Les backstages</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <section class="section--buttons">
                <a href="new-event.php" class="button button--contact">Nouvel Évènement</a>
                <a href="new-band.php" class="button button--contact">Nouveau Groupe</a>
                <a href="new-sponsor.php" class="button button--contact">Nouveau Sponsor</a>
                <a href="new-merchant.php" class="button button--contact">Nouvel Exposant</a>
            </section>
            <p>Assure-toi d'avoir créer un évènement avant d'ajouter un groupe !</p>

            <div class="dropdown__container">
                <section class="section" aria-labelledby="event-ttl">
                    <button id="event-dropdown" class="dropdown-banner" aria-label="Afficher ou masquer la liste des groupes" aria-expanded="false">
                        <h2 class="ttl ttl--red" id="event-ttl">Les Évènements</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="event-dropdown-content">
                        <ul class="band__list">
                            <?= getAllEventsAsList($allEvents) ?>
                        </ul>
                    </div>
                </section>

                <section class="section" aria-labelledby="band-ttl">
                    <button id="band-dropdown" class="dropdown-banner" aria-label="Afficher ou masquer la liste des groupes" aria-expanded="false">
                        <h2 class="ttl ttl--red" id="band-ttl">Les Groupes</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="band-dropdown-content">
                        <ul class="band__list">
                            <?= getAllBandsAsList($allBands) ?>
                        </ul>
                    </div>
                </section>

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
                        <h2 class="ttl ttl--red">Les exposants</h2>
                        <img src="img/arrow-down.svg" alt="Flèche descendante">
                    </button>

                    <div class="sponsor__container hidden" id="merchant-dropdown-content">
                        <?= listMerchantsHTML($activeMerchants); ?>
                    </div>
                </section>

            </div>
        </div>

        </div>

    </main>

    <footer class="footer">
        <p>Les sponsors actifs :</p>
        <?= fetchFooter($activeSponsors); ?>
    </footer>
</body>

<script>
    AOS.init();
</script>
<script type="module" src="js/burger.js"></script>
<script type="module" src="js/dropdown.js"></script>
<script type="module" src="js/notifs.js"></script>

</html>