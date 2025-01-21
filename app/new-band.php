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
            <h1 class="ttl" id="partner-ttl">Ajouter un groupe</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="backstage-actions.php" method="post" enctype="multipart/form-data">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="bandName">Nom du groupe <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="bandName" id="bandName" required autofocus placeholder="Nom du groupe">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="description">Description brêve du groupe <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <textarea class="form__textarea" name="description" id="description" cols="30" rows="10" required></textarea>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="date">Date de passage <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="date" name="date" id="date" required>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="time">Heure de passage <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="time" name="time" id="time" required>
                    </li>
                    <li class="form__item">
                        <label for="event" class="form__label">Participation à quel évènement ? <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <select class="form__input" name="event" id="event">
                            <option value="">- Sélectionne un évènement -</option>
                            <?php

                            // Créer les options de choix de l'evenement
                            $events = fetchAllEvents($dbCo);
                            foreach ($events as $event) {
                                echo '<option value="' . $event['id'] . '">' . $event['name'] . '</option>';
                            }

                            ?>
                        </select>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="youtubeLnk">Lien Youtube :</label>
                        <input class="form__input" type="text" name="youtubeLnk" id="youtubeLnk">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="facebookLnk">Lien Facebook :</label>
                        <input class="form__input" type="text" name="facebookLnk" id="facebookLnk">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="instaLnk">Lien Instagram :</label>
                        <input class="form__input" type="text" name="instaLnk" id="instaLnk">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="webLnk">Lien Site Officiel :</label>
                        <input class="form__input" type="text" name="webLnk" id="webLnk">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="attachment">Photo du groupe <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input type="file" name="attachment" id="attachment" accept=".png, .jpeg, .jpg, .webp" capture="environment">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Connexion">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="new-band">
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