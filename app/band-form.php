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

$name = '';
$description = '';
$youtubeLnk = '';
$facebookLnk = '';
$instaLnk = '';
$webLnk = '';
$formerAttachment = '';
$band = [];
$idBand = 0;

if (isset($_SESSION['form'])) {

    if (isset($_SESSION['form']['bandName'])) {
        $name = $_SESSION['form']['bandName'];
    }

    if (isset($_SESSION['form']['description'])) {
        $description = $_SESSION['form']['description'];
    }

    if (isset($_SESSION['form']['youtubeLnk'])) {
        $youtubeLnk = $_SESSION['form']['youtubeLnk'];
    }

    if (isset($_SESSION['form']['facebookLnk'])) {
        $facebookLnk = $_SESSION['form']['facebookLnk'];
    }

    if (isset($_SESSION['form']['instaLnk'])) {
        $instaLnk = $_SESSION['form']['instaLnk'];
    }

    if (isset($_SESSION['form']['webLnk'])) {
        $webLnk = $_SESSION['form']['webLnk'];
    }

    // Empty session after that
    unset($_SESSION['form']);
}

if (isset($_GET['band'])) {
    $band = getOneBand($dbCo, $_GET);
    $name = $band[0]['name'];
    $description = $band[0]['description'];
    $idBand = $band[0]['id_band'];
    $youtubeLnk = fetchBandLinkByWebsite($dbCo, $_GET, $youtube);
    $webLnk     = fetchBandLinkByWebsite($dbCo, $_GET, $website);
    $instaLnk   = fetchBandLinkByWebsite($dbCo, $_GET, $instagram);
    $facebookLnk = fetchBandLinkByWebsite($dbCo, $_GET, $facebook);
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

            <h1 class="ttl" id="partner-ttl">Ajouter un groupe</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="backstage-actions.php" method="post" enctype="multipart/form-data">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="bandName">Nom du groupe <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="bandName" id="bandName" required autofocus placeholder="Nom du groupe" value="<?= $name; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="description">Description brêve du groupe <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <textarea class="form__textarea" name="description" id="description" cols="30" rows="10" required><?= $description; ?></textarea>
                    </li>

                    <li class="form__item">
                        <label class="form__label" for="youtubeLnk">Lien Youtube :</label>
                        <input class="form__input" type="text" name="youtubeLnk" id="youtubeLnk" value="<?= $youtubeLnk; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="facebookLnk">Lien Facebook :</label>
                        <input class="form__input" type="text" name="facebookLnk" id="facebookLnk" value="<?= $facebookLnk; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="instaLnk">Lien Instagram :</label>
                        <input class="form__input" type="text" name="instaLnk" id="instaLnk" value="<?= $instaLnk; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="webLnk">Lien Site Officiel :</label>
                        <input class="form__input" type="text" name="webLnk" id="webLnk" value="<?= $webLnk; ?>">
                    </li>
                    <!-- We want to see this one only at creation. It will be another treatment for this special one because you can change infos from band without changing photo. -->
                    <?php if ($idBand === 0) {
                        echo '<li class="form__item">
                            <label class="form__label" for="attachment">Photo du groupe <span class="form__asterisk" aria-hidden="true">*</span></label>
                            <input type="file" name="attachment" id="attachment" accept=".png, .jpeg, .jpg, .webp">
                            <input type="hidden" name="formerAttachment" value="<?= $formerAttachment; ?>">
                        </li>';
                    } ?>
                    <li class="form__item" class="middleName" aria-hidden="true" tab="-1">
                        <label class="form__label middleName" for="middleName">middleName</label>
                        <input type="text" class="middleName" name="middleName">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Valider">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="idBand" value="<?= $idBand ?>">
                <?php if ($idBand > 0) {
                    // Modify a band 
                    echo '<input type="hidden" name="action" value="modify-band">';
                } else {
                    // Create a band -->
                    echo '<input type="hidden" name="action" value="new-band">';
                } ?>
            </form>

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