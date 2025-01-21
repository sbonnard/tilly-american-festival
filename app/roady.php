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

if (isset($_SESSION['username']) && isset($_SESSION['id_roady']) && isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
    redirectTo('backstage.php');
}
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
            <h1 class="ttl" id="partner-ttl">Connexion</h1>
            <?= getErrorMessage($errors); ?>
            <?= getSuccessMessage($messages); ?>

            <form class="form" action="login.php" method="post">
                <ul class="form__lst">
                    <li class="form__item">
                        <label class="form__label" for="username">Nom d'utilisateur <span class="form_asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="text" name="username" id="username" required autofocus>
                    </li>
                    <li class="form__item">
                        <label class="form__label" for="password">Mot de passe <span class="form_asterisk" aria-hidden="true">*</span></label>
                        <input class="form__input" type="password" name="password" id="password" required placeholder="⦿⦿⦿⦿⦿⦿⦿⦿⦿⦿">
                    </li>
                </ul>
                <input class="button button--contact slide-right" type="submit" value="Connexion">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="login">
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