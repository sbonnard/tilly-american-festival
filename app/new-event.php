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
            <h1 class="ttl" id="partner-ttl">Créer un événement</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="backstage-actions.php" method="post" enctype="multipart/form-data">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="eventName">Nom de l'évènement <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="eventName" id="eventName" required autofocus placeholder="Nom de l'évènement">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="year">Année de l'évènement <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="year" name="year" id="year" required placeholder="2022">
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
                        <input type="file" name="attachment" id="attachment" accept=".png, .jpeg, .jpg, .webp" capture="environment">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Connexion">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="new-event">
            </form>

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

</html>