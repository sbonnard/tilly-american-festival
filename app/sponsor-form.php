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
            <h1 class="ttl" id="partner-ttl">Ajouter un sponsor</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="backstage-actions.php" method="post" enctype="multipart/form-data">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="sponsorName">Nom du sponsor <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="sponsorName" id="sponsorName" required autofocus>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="attachment">Logo du sponsor <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input type="file" name="attachment" id="attachment" accept=".png, .jpeg, .jpg, .webp" capture="environment">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Valider">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="new-sponsor">
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

</html>