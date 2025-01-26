<?php

/**
 * Get bands from the most recent TAF event only on a specific day.
 *
 * @param PDO $dbCo - Connection to the database.
 * @param int $theDay - The day of the week (1 = Sunday, ..., 7 = Saturday).
 * @return array - An array containing all bands from the most recent TAF event on the specified day.
 */
function getBandPerYearPerDay(PDO $dbCo, int $theDay): array
{
    // Retrieve the ID of the most recent TAF event
    $lastTAFQuery = $dbCo->query(
        'SELECT MAX(id_event) AS lastTAF FROM event WHERE is_taf = 1;'
    );

    $lastTAF = $lastTAFQuery->fetch(PDO::FETCH_ASSOC)['lastTAF'];

    // If no TAF event is found, return an empty array
    if (!$lastTAF) {
        return [];
    }

    // Prepare the query to get bands for the specified day
    $queryBandPerYear = $dbCo->prepare(
        'SELECT 
            band.id_band, 
            band.name, 
            band_event.date, 
            band_event.hour, 
            band.img_url, 
            band.description, 
            band_event.id_event, 
            DAYOFWEEK(band_event.date) AS day_of_week
        FROM band_event
        JOIN event ON band_event.id_event = event.id_event
        JOIN band ON band_event.id_band = band.id_band
        WHERE band_event.id_event = :lastTAF
          AND event.is_taf = :is_taf
          AND DAYOFWEEK(band_event.date) = :dayOfWeek
        ORDER BY band_event.hour;'
    );

    // Bind values
    $queryBandPerYear->execute([
        'lastTAF' => $lastTAF,
        'is_taf' => 1,
        'dayOfWeek' => $theDay,
    ]);

    // Return the results
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
        $htmlBands .= '<div class="artist" data-aos="flip-up" data-aos-delay="300" data-aos-duration="1500">
            <h4 class="artist__name">' . $band['name'] . '</h4>
            <img class="artist__img" src="img/' . $band['img_url'] . '" alt="Photo de ' . $band['name'] . '">
            <p class="artist__description">' . $band['description'] . '</p>
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


/**
 * Fetch all bands from database.
 *
 * @param PDO $dbCo - Connection to database.
 *
 * @return array - An array containing all bands.
 */
function fetchAllBands(PDO $dbCo): array
{
    $queryBand = $dbCo->prepare(
        'SELECT *
        FROM band
        ORDER BY name ASC;'
    );

    $queryBand->execute();

    return $queryBand->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Generates an HTML list of bands from an array of bands.
 *
 * @param array $allbands - The array containing all bands.
 * @return string - The generated HTML list.
 */
function getAllBandsAsList(array $allbands): string
{
    $listBands = '';

    foreach ($allbands as $band) {
        $listBands .= '<li class="band__itm ttl" data-id-band="' . $band['id_band'] . '">' . $band['name'] . '</li>';
    }

    return $listBands;
}
