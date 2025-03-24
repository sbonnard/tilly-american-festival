<?php

/**
 * Fetch all events from the database.
 *
 * @param PDO $dbCo - Connection to the database.
 *
 * @return array - An array containing all events.
 */
function fetchAllGalleryEvents(PDO $dbCo)
{
    $query = $dbCo->query(
        'SELECT id_event, event.name, banner_url, event.year
        FROM event
        ORDER BY year DESC;'
    );

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Generates an HTML string for the gallery section from an array of events.
 *
 * @param array $allEvents - The array containing all events.
 *
 * @return string - The generated HTML string.
 */
function getEventsAsGalleryHTML(array $allEvents)
{
    $eventHTML = '';

    foreach ($allEvents as $event) {
        $eventHTML .= '
        <li class="gallery__item" data-id-gallery="' . $event['id_event'] . '" style="background-image: url(img/' . $event['banner_url'] . ');">
            <a class="gallery__link" href="event-gallery.php?event=' . $event['id_event'] . '">
                <h3 class="gallery__ttl">' . $event['name'] . '</h3>
            </a>
        </li>
        ';
    }

    return $eventHTML;
}

/**
 * Fetches all gallery photos for a specific event.
 *
 * @param PDO $dbCo - Connection to the database.
 * @param array $get - The $_GET array containing event information.
 *
 * @return array - An array containing file URLs of the gallery photos for the specified event.
 */

function getOneEventGalleryPhotos(PDO $dbCo, array $get)
{
    $query = $dbCo->prepare(
        'SELECT file_url
        FROM gallery
        WHERE id_event = :id_event;'
    );

    $bindValues = [
        'id_event' => intval($get['event'])
    ];

    $query->execute($bindValues);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Generates an HTML string for the gallery photos from an array of photo URLs.
 *
 * @param array $allPhotos - The array containing all gallery photo URLs.
 *
 * @return string - The generated HTML string.
 */
function getPhotosAsHTML(array $allPhotos)
{
    $photoHTML = '<ul class="gallery__photos__lst">';

    foreach ($allPhotos as $photo) {
        $photoHTML .= '<li class="gallery__photo" style="background-image: url(gallery/' . $photo['file_url'] . ');"></li>';
    }

    return $photoHTML . '</ul>';
}

/**
 * Fetches all bands associated with a specific event from the database.
 *
 * @param PDO $dbCo - Connection to the database.
 * @param array $get - The $_GET array containing the event ID.
 *
 * @return array - An array of associative arrays, each containing a band's name.
 */

function getAllBandsFromEvent(PDO $dbCo, array $get)
{
    $query = $dbCo->prepare(
        'SELECT band.name
        FROM band
        JOIN band_event
        ON band.id_band = band_event.id_band
        WHERE band_event.id_event = :id_event;'
    );

    $bindValues = [ 
        'id_event' => intval($get['event'])
    ];

    $query->execute($bindValues);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}