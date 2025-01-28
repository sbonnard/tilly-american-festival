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

if (isset($_SESSION['form'])) {

    if (isset($_SESSION['form']['bandName'])) {
        $_SESSION['form']['bandName'] = $name;
    }

    if (isset($_SESSION['form']['description'])) {
        $_SESSION['form']['description'] = $description;
    }

    if (isset($_SESSION['form']['youtubeLnk'])) {
        $_SESSION['form']['youtubeLnk'] = $youtubeLnk;
    }

    if (isset($_SESSION['form']['facebookLnk'])) {
        $_SESSION['form']['facebookLnk'] = $facebookLnk;
    }

    if (isset($_SESSION['form']['instaLnk'])) {
        $_SESSION['form']['instaLnk'] = $instaLnk;
    }

    if (isset($_SESSION['form']['webLnk'])) {
        $_SESSION['form']['webLnk'] = $webLnk;
    }
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
                    <li class="form__item">
                        <label class="form__label" for="attachment">Photo du groupe <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input type="file" name="attachment" id="attachment" accept=".png, .jpeg, .jpg, .webp" capture="environment">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Valider">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="new-band">
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