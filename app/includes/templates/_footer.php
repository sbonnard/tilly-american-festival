<?php

/**
 * Generates the footer of the website, including the list of sponsors, the copyright and a link to the developer's website.
 *
 * @param array $activeSponsors - An array containing all active sponsors.
 * @return string - The generated HTML content for the footer.
 */
function fetchFooter(array $activeSponsors) {
    return 
        listSponsorsHTML($activeSponsors) .
        '<p class="footer__credit">Site intégralement réalisé par <br><a class="footer__dev-link" href="https://sebastien-bonnard-hero.dontrollsingle.fr/" target="_blank">Sébastien Bonnard | Développeur</a></p>
        <p>©Tilly American Festival 2025</p>
    ';
}