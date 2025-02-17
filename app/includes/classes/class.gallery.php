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
            <a class="gallery__link" href="gallery.php?event=' . $event['id_event'] . '">
                <h3 class="gallery__ttl">' . $event['name'] . '</h3>
            </a>
        </li>
        ';
    }

    return $eventHTML;
}
