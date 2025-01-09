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
            <img src="img/logo.svg" alt="Logo du Tilly American Festival">
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
        <div class="herobanner">
            <div class="herobanner__container">
                <img class="herobanner__ttl" src="img/taf.webp" alt="Titre du Tilly American Festival">
            </div>
        </div>

    </main>
</body>

</html>