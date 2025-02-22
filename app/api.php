<?php

require_once './includes/_database.php';
require_once './includes/_functions.php';
require_once './includes/_message.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['sponsor_id'], $data['active'])) {
    $sponsorId = intval($data['sponsor_id']);
    $newStatus = intval($data['active']); // 1 = actif, 0 = inactif

    $query = $dbCo->prepare(
        'UPDATE sponsor
        SET is_active = :is_active
        WHERE id_sponsor = :sponsor_id;'
    );

    $bindValues = [
        'is_active' => $newStatus,
        'sponsor_id' => $sponsorId
    ];

    $query->execute($bindValues);

    if ($query->rowCount() === 0) {
        echo json_encode(["success" => false, "error" => "Sponsor introuvable"]);
        exit();
    }

    echo json_encode(["success" => true, "new_status" => $newStatus]);
} else {
    echo json_encode(["success" => false, "error" => "Données manquantes"]);
}


if (isset($data['merchant_id'])) {
    $merchantId = intval($data['merchant_id']);

    $query = $dbCo->prepare(
        'DELETE FROM merchant WHERE id_merchant = :merchant_id;'
    );

    $bindValues = [
        'merchant_id' => $merchantId
    ];

    $query->execute($bindValues);

    if ($query->rowCount() > 0) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Marchand introuvable"]);
    }
} else {
    echo json_encode(["success" => false, "error" => "ID du marchand manquant"]);
}