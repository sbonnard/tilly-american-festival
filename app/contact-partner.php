<?php
session_start();

require_once 'includes/_database.php';
require_once 'includes/_config.php';
require_once 'includes/_security.php';
require_once 'includes/_functions.php';
require_once 'includes/_datas.php';
require_once 'includes/templates/_head.php';
require_once 'includes/templates/_header.php';
require_once 'includes/templates/_footer.php';
require_once 'includes/classes/class.band.php';
require_once 'includes/classes/class.sponsor.php';
require_once 'includes/classes/class.merchant.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <header class="header">
        <?= fetchHeader('', '', 'nav__lnk--current'); ?>
    </header>

    <main class="main">
        <div class="container">
            <h1 class="ttl" id="partner-ttl">Nous contacter</h1>
            <p class="txt txt--center">Vous souhaitez nous rejoindre en tant que partenaire ou en tant que commerçant ? Prenez contact !</p>

            <form class="form" action="actions.php" method="post">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="name">Votre nom <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="name" id="name" required autofocus>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="name">Votre entreprise</label>
                        <input class="form__input" type="text" name="name" id="name" required autofocus>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="email">Votre email <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="email" name="email" id="email" required>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="subject">Objet <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <select class="form__input" name="subject" id="subject">
                            <option value="">- Objet du contact -</option>
                            <option value="partenaire">Devenir partenaire</option>
                            <option value="marchand">Exposer en tant que commerçant</option>
                            <option value="renseignement">Me renseigner</option>
                        </select>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="message">Votre message <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <textarea class="form__textarea" name="message" id="message" cols="30" rows="10" required></textarea>
                    </li>
                </ul>

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
<script type="module" src="js/dropdown.js"></script>

</html>