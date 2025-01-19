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
    unset($_SESSION['form']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <header class="header">
        <?= fetchHeader('', '', '', '', 'nav__lnk--current'); ?>
    </header>

    <main class="main">
        <div class="container">
            <h1 class="ttl" id="association-ttl">L'association</h1>
            <section class="section" aria-labelledby="association-ttl">
                <img class="association__img" src="img/association.webp" alt="Photo des membres de l'association du TAF">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in urna luctus tortor porta tincidunt. Curabitur mollis, ante et pretium ultrices, odio magna tempor lacus, nec finibus felis dui eget dolor. Vivamus ac est faucibus, tincidunt risus vel, varius libero. Quisque placerat dui et pharetra pulvinar. Aenean euismod, dolor eu vestibulum mattis, leo elit elementum enim, ut lacinia felis lacus nec ligula. Etiam eu placerat orci.</p>
            </section>
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

</html>