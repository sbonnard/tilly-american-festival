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

generateToken();

checkConnection($_SESSION);

if (isset($_SESSION['form'])) {
    $_SESSION['form']['eventName'] = $name;
    $_SESSION['form']['year'] = $year;
} else {
    $year = '';
    $name = '';
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

            <h1 class="ttl" id="partner-ttl">Créer un événement</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="backstage-actions.php" method="post" enctype="multipart/form-data">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="eventName">Nom de l'évènement <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="eventName" id="eventName" required autofocus placeholder="Nom de l'évènement" value="<?= $name; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="year">Année de l'évènement <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="year" id="year" required placeholder="2022" value="<?= $year; ?>">
                    </li>
                    <li class="form__item">
                        <label for="is_taf" class="form__label">L'evènement est-il un TAF ?</label>
                        <select class="form__input" name="is_taf" id="is_taf">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="attachment">Bannière de l'évènement <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input type="file" name="attachment" id="attachment" accept=".png, .jpeg, .jpg, .webp">
                    </li>
                    <li class="form__item" class="middleName" aria-hidden="true" tab="-1">
                        <label class="form__label middleName" for="middleName">middleName</label>
                        <input type="text" class="middleName" name="middleName">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Valider">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="new-event">
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