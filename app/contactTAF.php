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

require_once 'secretKey.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptchaToken = $_POST['recaptcha_token'];

    // Envoyer une requête à l'API reCAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaToken");
    $responseData = json_decode($response);

    if ($responseData->success && $responseData->score > 0.5) {
        // Le CAPTCHA est validé (score élevé indique un utilisateur légitime)
        echo "Formulaire validé !";
        // Traiter le reste du formulaire ici
    } else {
        // Échec du CAPTCHA
        echo "Échec du CAPTCHA. Essayez à nouveau.";
    }
}

countPageVisit('contactCounter')
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
            <h2 class="subttl ttl--red">en tant que particulier</h2>
            <p class="txt txt--center">Vous souhaitez nous rejoindre en tant que partenaire ou en tant que commerçant ? C'est par ici !</p>
            <a href="contact-partner.php" class="button button--partner">Vous souhaitez nous rejoindre ?</a>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="actions.php" method="post">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="fullname">Votre nom complet <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="fullname" id="fullname" required autofocus value="<?= $fullname; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="email">Votre email <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="email" name="email" id="email" required value="<?= $email; ?>">
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="subject">Objet <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <select class="form__input" name="subject" id="subject">
                            <option value="">- Objet du contact -</option>
                            <option value="renseignement-fest" <?= checkSelectedOption($_SESSION, 'renseignement-fest'); ?>>Me renseigner sur le festival</option>
                            <option value="renseignement-asso" <?= checkSelectedOption($_SESSION, 'renseignement-asso'); ?>>Me renseigner sur l'association</option>
                            <option value="autre" <?= checkSelectedOption($_SESSION, 'autre'); ?>>Autre</option>
                        </select>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="message">Votre message <span class="form__asterisk" aria-hidden="true">*</span></label>
                        <textarea class="form__textarea" name="message" id="message" cols="30" rows="10" required><?= $message; ?></textarea>
                    </li>
                    <li class="form__item" class="middleName" aria-hidden="true" tab="-1">
                        <label class="form__label middleName" for="middleName">middleName</label>
                        <input type="text" class="middleName" name="middleName">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Envoyer">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="contact">
                <input type="hidden" name="recaptcha_token" id="recaptchaToken">
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

<script src="https://www.google.com/recaptcha/api.js?render=6LfkK8YqAAAAAC-ZIbIsG5WswWE_PEHPhEzfSR9j"></script>
<script>
    // Récupère le jeton reCAPTCHA
    grecaptcha.ready(function() {
        grecaptcha.execute('6LfkK8YqAAAAAC-ZIbIsG5WswWE_PEHPhEzfSR9j', {
            action: 'submit'
        }).then(function(token) {
            document.getElementById('recaptchaToken').value = token;
        });
    });
</script>

<script>
    window.onload = function() {
        window.scrollTo(0, 0); // Scroll vers le tout en haut de la page
    }
</script>

</html>