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
require_once 'includes/classes/class.sponsor.php';
require_once 'includes/classes/class.merchant.php';

generateToken();

if (isset($_SESSION['form'])) {
    $fullname = $_SESSION['form']['fullname'];
    $enterprise = $_SESSION['form']['enterprise'];
    $email = $_SESSION['form']['email'];
    $subject = $_SESSION['form']['subject'];
    $message = $_SESSION['form']['message'];
} else {
    $fullname = '';
    $enterprise = '';
    $email = '';
    $subject = '';
    $message = '';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <?= fetchHeader('', '', '', '', '', 'nav__lnk--current'); ?>

    <main class="main">
        <div class="container">
            <h1 class="ttl" id="partner-ttl">Nous contacter</h1>
            <h2 class="subttl ttl--red">En tant que partenaire</h2>
            <p class="txt txt--center">Vous souhaitez nous rejoindre en tant que partenaire ou en tant que commerçant ? Prenez contact !</p>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="actions.php" method="post">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="fullname">Votre nom complet <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="fullname" id="fullname" required autofocus value="<?= $fullname; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="enterprise">Votre entreprise</label>
                        <input class="form__input" type="text" name="enterprise" id="enterprise" required value="<?= $enterprise; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="email">Votre email <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="email" name="email" id="email" required value="<?= $email; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="subject">Objet <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <select class="form__input" name="subject" id="subject" required>
                            <option value="">- Objet du contact -</option>
                            <option value="partenaire" <?= checkSelectedOption($_SESSION, 'partenaire'); ?>>Devenir partenaire</option>
                            <option value="marchand" <?= checkSelectedOption($_SESSION, 'marchand'); ?>>Exposer en tant que commerçant</option>
                            <option value="renseignement" <?= checkSelectedOption($_SESSION, 'renseignement'); ?>>Me renseigner</option>
                            <option value="autre" <?= checkSelectedOption($_SESSION, 'autre'); ?>>Autre</option>
                        </select>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="message">Votre message <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <textarea class="form__textarea" name="message" id="message" cols="30" rows="10" required><?= $message; ?></textarea>
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Envoyer">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="contact-partner">
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
<script type="module" src="js/notifs.js"></script>

</html>