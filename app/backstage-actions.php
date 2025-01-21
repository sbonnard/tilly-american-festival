<?php
session_start();

require_once 'includes/_database.php';
require_once 'includes/_security.php';
require_once 'includes/_config.php';
require_once 'includes/_functions.php';
require_once 'includes/_datas.php';
require_once 'includes/_message.php';

if (!isset($_REQUEST['action'])) {
    redirectTo();
    exit;
}

preventFromCSRF();

if (isset($_POST['action'])) {

    if ($_POST['action'] === 'new-event') {

        // Gestion du fichier attaché
        $attachmentFileName = 'default.webp'; // Valeur par défaut
        if (isset($_FILES['attachment']) && !empty($_FILES['attachment']['name'])) {

            $uploadDir = __DIR__ . '/img/'; // Dossier de destination

            // Vérification que le dossier existe, sinon le créer
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }

            // Récupérer les informations du fichier
            $fileName = pathinfo($_FILES['attachment']['name'], PATHINFO_FILENAME);
            $fileExtension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);

            // time() pour assurer un nom de fichier unique.
            $attachmentFileName = $fileName . '_' . time() . '.' . $fileExtension;
            $uploadFile = $uploadDir . $attachmentFileName;
            $relativePath = 'logo/' . $attachmentFileName;

            // Vérification de l'erreur de téléchargement
            if ($_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                // Vérification des types de fichiers autorisés
                $allowedTypes = [
                    'image/png',
                    'image/jpeg',
                    'image/jpg',
                    'image/webp'
                ];
                $fileType = mime_content_type($_FILES['attachment']['tmp_name']);

                if (in_array($fileType, $allowedTypes)) {
                    // Déplacer le fichier vers le dossier de destination
                    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadFile)) {
                        $attachmentFileName = htmlspecialchars($attachmentFileName); // Nom du fichier téléchargé
                    } else {
                        echo "Erreur lors du téléchargement de $attachmentFileName.<br>";
                    }
                } else {
                    echo "Type de fichier non autorisé pour $attachmentFileName.<br>";
                }
            } else {
                echo "Erreur de téléchargement pour le fichier $attachmentFileName.<br>";
            }
        }

        // Gestion du formulaire
        $name = $_POST['eventName'];
        $year = $_POST['year'];
        $is_taf = $_POST['is_taf'];

        if (!isset($name) || $name === '') {
            addError('eventName_ko');
            exit;
        }

        if (!isset($year) || $year === '') {
            addError('year_ko');
            exit;
        }

        if ($is_taf !== '1' && $is_taf !== '0') {
            addError('is_taf_ko');
            exit;
        }

        if (!isset($attachmentFileName) || $attachmentFileName === 'default.webp' || $attachmentFileName === '') {
            addError('attachment_ko');
            exit;
        }

        // Insertion de l'évènement dans la base de données
        $query = $dbCo->prepare(
            'INSERT INTO event (name, year, is_taf, banner_url) VALUES (:name, :year, :is_taf, :attachment);'
        );

        $bindValues = [
            'name' => htmlspecialchars($name),
            'year' => intval($year),
            'is_taf' => intval($is_taf),
            'attachment' => htmlspecialchars($attachmentFileName)
        ];

        $isInsertOk = $query->execute($bindValues);

        if ($isInsertOk) {
            addMessage('event_created');
            redirectTo('backstage.php');
        } else {
            $_SESSION['form']['eventName'] = $name;
            $_SESSION['form']['year'] = $year;
            $_SESSION['form']['is_taf'] = $is_taf;

            addError('event_not_created');
            redirectTo();
        }
    }
}

redirectTo();
