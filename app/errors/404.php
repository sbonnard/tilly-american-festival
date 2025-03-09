<?php
session_start();

require_once '../includes/_database.php';
require_once '../includes/_config.php';
require_once '../includes/_security.php';
require_once '../includes/_functions.php';
require_once '../includes/_datas.php';
require_once '../includes/_message.php';
require_once '../includes/templates/_head.php';
require_once '../includes/templates/_header.php';
require_once '../includes/templates/_footer.php';
require_once '../includes/classes/class.band.php';
require_once '../includes/classes/class.sponsor.php';
require_once '../includes/classes/class.merchant.php';

generateToken();

if (isset($_SESSION['form'])) {
    unset($_SESSION['form']);
}

$source = '../';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead(); ?>
</head>

<body>

    <?= fetchHeader('', '', '', '', '', '', $source); ?>

    <main class="main">
        <div class="container container--error">
            <h1 class="ttl ttl--red ttl--big" id="association-ttl">Erreur 404</h1>
            <p class="subttl">Tu es perdu ? Clique sur la vache ! Elle te ramènera en lieu sûr</p>
        </div>
        <a href="../index.php"><?= displayCowquitaf($source); ?></a>
    </main>

    <footer class="footer">
        <?= fetchFooter($activeSponsors, $source); ?>
    </footer>
</body>

<script>
    AOS.init();
</script>
<script type="module" src="../js/burger-error.js"></script>

</html>