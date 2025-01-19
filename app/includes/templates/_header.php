<?php

/**
 * Generates the header of the website, including the logo, navigation bar, and hamburger menu.
 *
 * @param string $home - The class name for the home link.
 * @param string $where - The class name for the where link.
 * @param string $partners - The class name for the partners link.
 * @param string $gallery - The class name for the gallery link.
 * @param string $association - The class name for the association link.
 * @param string $contact - The class name for the contact link.
 * @return string - The HTML content for the header.
 */
function fetchHeader(string $home = '', string $where = '', string $partners = '', string $gallery = '', string $association = '', string $contact = ''): string
{
    $header =
        '<a href="index.php">
            <img class="header__logo" src="img/logo.svg" alt="Logo du Tilly American Festival">
        </a>
        <div class="hamburger">
            <a href="#menu" id="hamburger-menu-icon" aria-label="Ouvrir le hamburger">
                <img id="burgerSvg" src="img/burger.svg" alt="Menu Hamburger">
            </a>
        </div>
        <nav class="nav hamburger__menu" id="menu" aria-label="Navigation principale du site">
            <ul class="nav__lst" id="nav-list">
                <li class="nav__itm">
                    <a class="nav__lnk ' . $home . '" href="index.php">Accueil</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $where . '" href="wheretaf.php">Où sommes-nous ?</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $partners . '" href="partners.php">Nos partenaires</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $gallery . '" href="gallery.php">Galerie</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $association . '" href="association.php">L\'association</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $contact . '" href="contact.php">Nous contacter</a>
                </li>
            </ul>
        </nav>';

    return $header;
}
