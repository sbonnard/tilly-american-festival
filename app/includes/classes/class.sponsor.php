<?php

/**
 * Fetch all active sponsors
 *
 * @param PDO $dbCo Database connection
 * @return array An array containing all active sponsors
 */
function fetchActiveSponsors(PDO $dbCo): array
{
    $query = $dbCo->prepare(
        'SELECT *
        FROM sponsor
        WHERE is_active = :is_active
        ORDER BY name;'
    );

    $bindValues = [
        'is_active' => 1
    ];

    $query->execute($bindValues);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Fetch all active sponsors
 *
 * @param PDO $dbCo Database connection
 * @return array An array containing all active sponsors
 */
function fetchAllSponsors(PDO $dbCo): array
{
    $query = $dbCo->query(
        'SELECT *
        FROM sponsor
        ORDER BY name ASC;'
    );

    return $query->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Generate an HTML list of sponsors
 *
 * @param array $sponsors - An array containing all active sponsors
 * @return string - The generated HTML list
 */
function listSponsorsHTML(array $sponsors, string $source = '', array $session = []): string
{
    $sponsorList = '<ul class="sponsor__list">';

    if (empty($sponsors)) {
        $sponsorList = '<li class="sponsor__empty">Aucun sponsor annoncé. On vous en dit plus bientôt !</li>';
    }

    foreach ($sponsors as $sponsor) {
        $sponsorList .=
            '<li class="sponsor__container">';
        if (isset($session['admin']) && $session['admin'] === 1) {
            $sponsorList .= '<button data-sponsor-id="' . $sponsor['id_sponsor'] . '" data-active="' . $sponsor['is_active'] . '" class="sponsor__button ';
            if ($sponsor['is_active'] === 1) {
                $sponsorList .= 'sponsor__button--active';
            } else {
                $sponsorList .= 'sponsor__button--inactive';
            }
            $sponsorList .= ' "></button>';
        }

        $sponsorList .= '<img class="sponsor__logo ';

        if ($sponsor['is_active'] === 0) {
            $sponsorList .= 'sponsor__logo--inactive';
        }

        $sponsorList .= '" src="' . $source . 'img/' . $sponsor['logo_url'] . '" alt="' . $sponsor['name'] . '">
                <p class="sponsor__name">' . $sponsor['name'] . '</p>
            </li>';
    }

    $sponsorList .= '</ul>';

    return $sponsorList;
}
