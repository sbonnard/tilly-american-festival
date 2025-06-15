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
function fetchHeader(string $home = '', string $where = '', string $partners = '', string $gallery = '', string $association = '', string $contact = '', string $source = '', string $backstage = '', string $logout = ''): string
{
    $header =
        '<header class="header" data-aos="fade-down" data-aos-duration="500" data-aos-delay="500">
        <a href="index.php">
            <img class="header__logo" src="' . $source . 'img/logold.svg" alt="Logo du Tilly American Festival">
        </a>
        <div class="hamburger">
            <a href="#menu" id="hamburger-menu-icon" aria-label="Ouvrir le hamburger">
                <img id="burgerSvg" src="' . $source . 'img/burger.svg" alt="Menu Hamburger">
            </a>
        </div>
        <nav class="nav hamburger__menu" id="menu" aria-label="Navigation principale du site">
            <ul class="nav__lst" id="nav-list">
                <li class="nav__itm">
                    <a class="nav__lnk ' . $home . '" href="' . $source . 'index.php">Accueil</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $where . '" href="' . $source . 'wheretaf.php">Où sommes-nous ?</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $partners . '" href="' . $source . 'partners.php">Nos partenaires</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $gallery . '" href="' . $source . 'gallery.php">Galerie</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $association . '" href="' . $source . 'association.php">L\'association</a>
                </li>
                <li class="nav__itm">
                    <a class="nav__lnk ' . $contact . '" href="' . $source . 'contactTAF.php">Nous contacter</a>
                </li>
                ' . showLinkIfConnected($backstage, $logout, $source) . '
            </ul>
        </nav>
    </header>
        ';

    return $header;
}


/**
 * Generates two links in the navigation bar if the user is an admin.
 *
 * The two links are "Backstage" and "Déconnexion".
 *
 * @param string $backstage - A class name to apply to the "Backstage" link.
 * @param string $logout - A class name to apply to the "Déconnexion" link.
 * @param string $source - The source of the images (either "" for local development or "/tilly-american-festival/" for production).
 *
 * @return string - The HTML code for the two links.
 */
function showLinkIfConnected(string $backstage, string $logout, string $source): string
{
    $specialLinks = '';

    if (isset($_SESSION['username']) && isset($_SESSION['id_roady']) && isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
        $specialLinks .= '<li class="red-separator" aria-hidden="true">|</li>
            <li class="nav__itm"><a class="nav__lnk ' . $backstage . '" href="' . $source . 'backstage.php">Backstage</a></li>' .
            '<li class="nav__itm"><a class="nav__lnk ' . $logout . '" href="' . $source . 'logout.php">Déconnexion</a></li>';
    }

    return $specialLinks;
}
