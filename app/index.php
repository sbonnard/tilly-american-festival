<?php
session_start();

require_once 'includes/_database.php';
require_once 'includes/_config.php';
require_once 'includes/_security.php';
require_once 'includes/_functions.php';
require_once 'includes/_datas.php';
require_once 'includes/templates/_head.php';
require_once 'includes/templates/_header.php';
require_once 'includes/classes/class.band.php';
require_once 'includes/classes/class.sponsor.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?= fetchHead(); ?>
</head>

<body>
    <header class="header">
<?= fetchHeader('nav__lnk--current'); ?>
    </header>
    <main>
        <div class="herobanner" data-aos="zoom-in">
            <div class="herobanner__container">
                <img class="herobanner__ttl" src="img/taf.webp" alt="Titre du Tilly American Festival" data-aos="zoom-out" data-aos-delay="1000">
            </div>
        </div>

        <div class="container">
            <section class="section" aria-labelledby="intro">
                <h1 class="ttl" id="intro">Le festival</h1>
                <img class="logo" src="img/logo.svg" alt="Logo du Tilly American Festival">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in urna luctus tortor porta tincidunt. Curabitur mollis, ante et pretium ultrices, odio magna tempor lacus, nec finibus felis dui eget dolor. Vivamus ac est faucibus, tincidunt risus vel, varius libero. Quisque placerat dui et pharetra pulvinar. Aenean euismod, dolor eu vestibulum mattis, leo elit elementum enim, ut lacinia felis lacus nec ligula. Etiam eu placerat orci.</p>
            </section>

            <section class="section" aria-labelledby="program">
                <img src="img/horns.webp" alt="Cornes de boeuf">
                <h2 class="ttl" id="program">La Programmation</h2>

                <!-- // Programmation du samedi -->
                <div class="section">
                    <h3 class="ttl ttl--small">Le samedi</h3>

                    <div class="artist__section">
                        <?= getBandAsHTML($dbCo, $bandsSaturday); ?>
                    </div>

                </div>

                <!-- <img src="img/car.webp" alt="Voiture ancienne"> -->
                <div class="separator--car"></div>

                <!-- // Programmation du dimanche -->
                <div class="section">
                    <h3 class="ttl ttl--small">Le dimanche</h3>

                    <div class="artist__section">
                        <?= getBandAsHTML($dbCo, $bandsSunday); ?>
                    </div>
                </div>

            </section>

        </div>

        <div class="cowquitaf__container">
            <img class="cowquitaf" src="img/cowquitaf.webp" alt="La vache qui TAF">
        </div>
    </main>

    <footer class="footer">
        <?= listSponsorsHTML($activeSponsors); ?>
        <p class="footer__credit">Site réalisé par <br><a class="footer__dev-link" href="https://sebastien-bonnard-hero.dontrollsingle.fr/" target="_blank">Sébastien Bonnard | Développeur</a></p>
        <p>©Tilly American Festival 2025</p>
    </footer>
</body>

<script>
    AOS.init();
</script>
<script type="module" src="js/burger.js"></script>

</html>