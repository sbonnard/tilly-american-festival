<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_security.php';
require_once 'includes/_functions.php';
require_once 'includes/templates/_head.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= fetchHead(); ?>
</head>

<body>
    <header class="header">
        <a href="index.php">
            <img class="header__logo" src="img/logo.svg" alt="Logo du Tilly American Festival">
        </a>
        <div class="hamburger">
            <a href="#menu" id="hamburger-menu-icon" aria-label="Ouvrir le hamburger">
                <img src="img/burger.svg" alt="Menu Hamburger">
            </a>
        </div>
        <nav class="nav hamburger__menu" id="menu" aria-label="Navigation principale du site">
            <ul class="nav__lst" id="nav-list">
                <li class="nav__itm nav__lnk--current">
                    <a href=""></a>
                </li>
            </ul>
        </nav>
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

                <div class="section">
                    <h3 class="ttl ttl--small">Le samedi</h3>

                    <div class="artist">
                        <h4 class="ttl">Johnny Trouble</h4>
                        <img src="img/trouble.png" alt="Photo de Johnny Trouble">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent in urna luctus tortor porta tincidunt.</p>
                        <div class="linktree">
                            <a href="https://johnny-trouble.com" target="_blank">
                                <img class="linktree__icon" src="img/web.svg" alt="Symbole du web">
                            </a>
                            <a href="https://www.instagram.com/johnnytrouble_official/" target="_blank">
                                <img class="linktree__icon" src="img/insta.svg" alt="Logo d'instagram">
                            </a>
                            <a href="https://www.youtube.com/@JohnnyTroubleOfficial" target="_blank">
                                <img class="linktree__icon" src="img/youtube.svg" alt="Logo Youtube">
                            </a>
                        </div>
                    </div>

                </div>
            </section>
        </div>

    </main>
</body>

<script>
    AOS.init();
</script>

</html>