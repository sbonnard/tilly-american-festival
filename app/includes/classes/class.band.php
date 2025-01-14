<?php

/**
 * Get bands from last taf event only. When a new event is created, bands will be updated.
 *
 * @param PDO $dbCo - Connection to database.
 * @return array - An array containing all bands from most recent event that is taf.
 */
function getBandPerYear(PDO $dbCo):array
{
    $queryBandPerYear = $dbCo->prepare(
        'SELECT id_band, band.name, date, hour, img_url, description, id_event, DAYOFWEEK(date) AS day_of_week
        FROM band
            JOIN event USING (id_event)
        WHERE id_event = (SELECT MAX(id_event) FROM event) AND is_taf = :is_taf
        GROUP BY date, day_of_week, id_band, id_event;'
    );

    $bindValues = [
        'is_taf' => 1
    ];

    $queryBandPerYear->execute($bindValues);

    return $queryBandPerYear->fetchAll(PDO::FETCH_ASSOC);
}
