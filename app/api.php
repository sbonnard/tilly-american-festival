<?php

require_once './includes/_database.php';
require_once './includes/_functions.php';
require_once './includes/_message.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id_sponsor'], $data['is_active'])) {
    $sponsorId = intval($data['id_sponsor']);
    $newStatus = intval($data['is_active']); // 1 = actif, 0 = inactif

    $query = $dbCo->prepare(
        'UPDATE sponsor
        SET is_active = :is_active
        WHERE id_sponsor = :sponsor_id;'
    );

    $query->execute([
        'is_active' => $newStatus,
        'sponsor_id' => $sponsorId
    ]);

    if ($query->rowCount() === 0) {
        echo json_encode(["success" => false, "error" => "Sponsor introuvable"]);
        exit();
    }

    echo json_encode(["success" => true, "new_status" => $newStatus]);
    exit();
}

// Traitement de la suppression d'un marchand
if (isset($data['id_merchant'])) {
    $merchantId = intval($data['id_merchant']);

    $query = $dbCo->prepare(
        'DELETE FROM merchant WHERE id_merchant = :merchant_id;'
    );

    $query->execute(['merchant_id' => $merchantId]);

    if ($query->rowCount() > 0) {
    } 
    
    if ($query->rowCount() === 0) {
        echo json_encode(["success" => false, "error" => "Marchand introuvable"]);
        exit();
    }
    
        echo json_encode(["success" => true]);
        exit();
}

// Si aucune action n'est détectée
echo json_encode(["success" => false, "error" => "Données invalides"]);
exit();
