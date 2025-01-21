<?php

/**
 * Fetch all events from database.
 *
 * @param PDO $dbCo - Connection to database.
 *
 * @return array - An array containing all events.
 */
function fetchAllEvents($dbCo): array
{
    $queryEvent = $dbCo->prepare(
        'SELECT *
    FROM event
    ORDER BY id_event DESC;'
    );

    $queryEvent->execute();

    return $queryEvent->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Generates an HTML list of events from an array of events.
 *
 * @param array $allevents - The array containing all events.
 * @return string - The generated HTML list.
 */
function getAlleventsAsList(array $allEvents): string
{
    $listEvents = '';

    foreach ($allEvents as $event) {
        $listEvents .= '<li class="band__itm ttl" data-id-band="' . $event['id_event'] . '">' . $event['name'] . '</li>';
    }

    return $listEvents;
}
