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
    $_SESSION['form']['merchantName'] = $name;
    $_SESSION['form']['description'] = $description;
} else {
    $description = '';
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

            <h1 class="ttl" id="partner-ttl">Nouvel Exposant</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="backstage-actions.php" method="post" enctype="multipart/form-data">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="merchantName">Nom de l'exposant <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="merchantName" id="merchantName" required autofocus placeholder="Nom de l'exposant" value="<?= $name; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="year">Description de l'exposant <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <textarea name="description" class="form__textarea" id="description" cols="30" rows="10" required><?= $description; ?></textarea>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="attachment">Photo de l'exposant <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input type="file" name="attachment" id="attachment" accept=".png, .jpeg, .jpg, .webp">
                    </li>
                    <li class="form__item" class="middleName" aria-hidden="true" tab="-1">
                        <label class="form__label middleName" for="middleName">middleName</label>
                        <input type="text" class="middleName" name="middleName">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Valider">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="new-merchant">
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