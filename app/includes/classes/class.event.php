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
 * Fetch all future events from the database.
 *
 * @param PDO $dbCo - Connection to the database.
 *
 * @return array - An array containing all future events.
 */
function fetchAllFutureEvents(PDO $dbCo): array
{
    try {
        // Prepare and execute the query
        $queryEvent = $dbCo->query(
            'SELECT 
                event.id_event, 
                event.name, 
                YEAR(event.year) AS year
             FROM event
             WHERE event.year >= YEAR(CURDATE())
             ORDER BY event.id_event DESC;'
        );

        // Fetch results
        $events = $queryEvent->fetchAll(PDO::FETCH_ASSOC);

        // Return an empty array if no results found
        return $events ?: [];

    } catch (PDOException $e) {
        // Log or handle the exception if necessary
        error_log('Database error: ' . $e->getMessage());
        return [];
    }
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


/**
 * Generates HTML select options for a list of events.
 *
 * @param array $allEvents - The array containing all events.
 *
 * @return string - The generated HTML select options.
 */
function getAllEventsAsSelectOptions(array $allEvents):string {
    $options = '';

    foreach ($allEvents as $event) {
        $options .= '<option value="' . $event['id_event'] . '">' . $event['name'] . '</option>';
    }

    return $options;
}

/**
 * Fetches information for a specific event from the database.
 *
 * @param PDO $dbCo - Connection to the database.
 * @param array $get - The $_GET array containing the event ID.
 *
 * @return array - An associative array containing event information.
 */
function getOneEvent(PDO $dbCo, array $get): array {
    $queryEvent = $dbCo->prepare(
        'SELECT *
        FROM event
        WHERE id_event = :id_event;'
    );

    $bindValues = [
        'id_event' => intval($get['event'])
    ];

    $queryEvent->execute($bindValues);

    return $queryEvent->fetch(PDO::FETCH_ASSOC);
}