<?php

/**
 * Fetch all active merchants
 *
 * @param PDO $dbCo Database connection
 * @return array An array containing all active merchants
 */
function fetchActiveMerchants(PDO $dbCo): array
{
    $queryMerchant = $dbCo->prepare(
        'SELECT * FROM merchant WHERE is_active = :is_active;'
    );

    $bindValues = [
        'is_active' => 1
    ];

    $queryMerchant->execute($bindValues);

    return $queryMerchant->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Generates an HTML string from a merchant array.
 *
 * @param array $merchants - The merchant array.
 * @return string - The generated HTML string.
 */
function listMerchantsHTML(array $activeMerchants): string
{
    $htmlMerchants = '<ul class="merchant__list">';

    if (empty($activeMerchants)) {
        $htmlMerchants = '<li class="merchant__empty">Aucun commerçant annoncé. On vous en dit plus bientôt !</li>';
    }

    foreach ($activeMerchants as $merchant) {
        $htmlMerchants .= '
            <li class="merchant" data-aos="flip-up" data-aos-delay="300" data-aos-duration="1500">
                <h4 class="merchant__name">' . $merchant['name'] . '</h4>
                <img class="merchant__img" src="img/' . $merchant['img_url'] . '" alt="Photo de ' . $merchant['name'] . '">
                <p class="merchant__description">' . $merchant['description'] . '</p>
            </li>';
    }

    $htmlMerchants .= '</ul>';

    return $htmlMerchants;
}
