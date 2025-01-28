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

    <?= fetchHeader('nav__lnk--current'); ?>

    <main>
        <div class="herobanner" data-aos="zoom-in">
            <div class="herobanner__container">
                <img class="herobanner__ttl" src="img/taf.webp" alt="Titre du Tilly American Festival" data-aos="zoom-out" data-aos-delay="1000">
            </div>
        </div>

        <div class="container">
            <section class="section" aria-labelledby="intro">
                <h1 class="ttl" id="intro">Le festival</h1>
                <h2 class="ttl ttl--big">Les <span class="ttl--red">12</span>, <span class="ttl--red">13</span> & <span class="ttl--red">14</span> Septembre <span class="ttl--red">2025</span></h2>
                <img class="logo" src="img/logo.svg" alt="Logo du Tilly American Festival">
                <p>Venez vivre un voyage dans le temps au cœur de la Normandie lors de notre festival unique célébrant la culture américaine des années 50 à 70 ! Plongez dans une ambiance vibrante où rockabilly, bluegrass et rock'n'roll se mêlent pour faire revivre les sons légendaires de cette époque dorée. Entouré de voitures anciennes étincelantes, de vêtements vintage et de déco rétro, vous serez transporté dans un univers où chaque détail rend hommage à l’esprit rebelle et dynamique des années passées. Un week-end à ne pas manquer pour les amateurs de musique, de culture et de nostalgie américaine !</p>
            </section>

            <section class="section" aria-labelledby="program">
                <img src="img/horns.webp" alt="Cornes de boeuf">
                <h2 class="ttl" id="program">La Programmation</h2>

                <!-- // Programmation du vendredi -->
                <?php if (!empty($bandsFriday)) { ?>
                    <div class="section">
                        <h3 class="ttl ttl--small">Le vendredi</h3>

                        <div class="section">
                            <?= getBandAsHTML($dbCo, $bandsFriday); ?>
                        </div>

                    </div>
                <?php } ?>

                <!-- // Programmation du samedi -->
                <div class="section">
                    <h3 class="ttl ttl--small">Le samedi</h3>

                    <div class="<?php if (empty($bandsSaturday)) {
                                    echo 'section';
                                } else { ?>artist__section <?php } ?>">
                        <?= getBandAsHTML($dbCo, $bandsSaturday); ?>
                    </div>

                </div>

                <!-- <img src="img/car.webp" alt="Voiture ancienne"> -->
                <div class="separator--car"></div>

                <!-- // Programmation du dimanche -->
                <div class="section">
                    <h3 class="ttl ttl--small">Le dimanche</h3>

                    <div class="<?php if (empty($bandsSunday)) {
                                    echo 'section';
                                } else { ?>artist__section <?php } ?>">
                        <?= getBandAsHTML($dbCo, $bandsSunday); ?>
                    </div>
                </div>

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