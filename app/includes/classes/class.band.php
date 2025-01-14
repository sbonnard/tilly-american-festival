<?php

/**
 * Get bands from last taf event only on saturday. When a new event is created, bands will be updated.
 *
 * @param PDO $dbCo - Connection to database.
 * @return array - An array containing all bands from most recent event that is taf.
 */
function getBandPerYearPerDay(PDO $dbCo, INT $theDay): array
{
    $queryBandPerYear = $dbCo->prepare(
        'SELECT id_band, band.name, date, hour, img_url, description, id_event, DAYOFWEEK(date) AS day_of_week
        FROM band
            JOIN event USING (id_event)
        WHERE id_event = (SELECT MAX(id_event) FROM event) 
          AND is_taf = :is_taf
          AND DAYOFWEEK(date) = :dayOfWeek
          ORDER BY hour;'
    );

    $bindValues = [
        'is_taf' => 1,
        'dayOfWeek' => $theDay
    ];

    $queryBandPerYear->execute($bindValues);

    return $queryBandPerYear->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Generates an HTML string from a band array.
 *
 * @param PDO $dbCo - Connection to database.
 * @param array $bands - The band array.
 * @return string - The generated HTML string.
 */
function getBandAsHTML(PDO $dbCo, array $bands): string
{
    $htmlBands = '';

    foreach ($bands as $key => $band) {
        $htmlBands .= '<div class="artist">
            <h4 class="ttl">' . $band['name'] . '</h4>
            <img class="artist__img" src="img/' . $band['img_url'] . '" alt="Photo de ' . $band['name'] . '">
            <p>' . $band['description'] . '</p>
            <div class="linktree">';

        foreach (fetchBandLinks($dbCo, $band) as $link) {
            $htmlBands .= '
                <a href="' . $link['url'] . '" target="_blank">
                    <img class="linktree__icon" src="img/' . $link['logo_url'] . '" alt="Logo ' . $link['name'] . '">
                </a>';
        }

        $htmlBands .= '</div>
        </div>';
    }

    return $htmlBands;
}


/**
 * Fetch all links for a band.
 *
 * @param PDO $dbCo - Connection to database.
 * @param array $bands - The band array.
 * @return array - An array containing all links for a band.
 */
function fetchBandLinks(PDO $dbCo, array $band): array
{
    $queryBandLinks = $dbCo->prepare(
        'SELECT url, id_band, logo_url, name
        FROM band_links
            JOIN website USING (id_website)
        WHERE id_band = :id_band
        ORDER BY id_website;'
    );

    $bindValues = [
        'id_band' => $band['id_band']
    ];

    $queryBandLinks->execute($bindValues);

    return $queryBandLinks->fetchAll(PDO::FETCH_ASSOC);
}
