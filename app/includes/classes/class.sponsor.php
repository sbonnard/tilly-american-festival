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
        WHERE is_active = :is_active;'
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
        FROM sponsor;'
    );

    return $query->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Generate an HTML list of sponsors
 *
 * @param array $sponsors - An array containing all active sponsors
 * @return string - The generated HTML list
 */
function listSponsorsHTML(array $sponsors, string $source = ''): string
{
    $sponsorList = '<ul class="sponsor__list">';

    if (empty($sponsors)) {
        $sponsorList = '<li class="sponsor__empty">Aucun sponsor annoncé. On vous en dit plus bientôt !</li>';
    }

    foreach ($sponsors as $sponsor) {
        $sponsorList .=
            '<li>
                <img class="sponsor__logo" src="' . $source . 'img/' . $sponsor['logo_url'] . '" alt="' . $sponsor['name'] . '">
            </li>';
    }

    $sponsorList .= '</ul>';

    return $sponsorList;
}
