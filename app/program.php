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

generateToken();

checkConnection($_SESSION);

if (isset($_SESSION['form'])) {
    $_SESSION['form']['eventName'] = $name;
    $_SESSION['form']['year'] = $year;
} else {
    $year = '';
    $name = '';
}

$band = getBandInfos($dbCo);
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

            <h1 class="ttl" id="partner-ttl">Programmer <?= $band['name'] ?></h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="backstage-actions.php" method="post" enctype="multipart/form-data">
                <ul class="form__lst">
                    <li class="form__item">
                        <label for="event" class="form__label">Participation à quel évènement ? <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <select class="form__input" name="event" id="event">
                            <option value="">- Sélectionne un évènement -</option>
                            <?php

                            // Créer les options de choix de l'evenement
                            $events = fetchAllFutureEvents($dbCo);
                            foreach ($events as $event) {
                                echo '<option value="' . $event['id_event'] . '">' . $event['name'] . '</option>';
                            }

                            ?>
                        </select>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="date">Date de passage <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="date" name="date" id="date" required>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="time">Heure de passage <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="time" name="time" id="time" required>
                    </li>
                    <input type="hidden" name="band" value="<?= $band['id_band'] ?>">
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Programmer">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="program">
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