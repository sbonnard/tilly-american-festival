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

    if (!empty($_POST['middleName'])) {
        exit;
    }

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
    } else if ($_POST['action'] === 'new-band') {

        // Gestion du formulaire
        $name = $_POST['bandName'];
        $description = $_POST['description'];
        $youtubeLnk = $_POST['youtubeLnk'];
        $facebookLnk = $_POST['facebookLnk'];
        $instaLnk = $_POST['instaLnk'];
        $webLnk = $_POST['webLnk'];

        if (!isset($name) || $name === '') {
            addError('bandName_ko');
            redirectTo();
            exit;
        }

        if (!isset($description) || $description === '') {
            addError('band_description_ko');
            redirectTo();
            exit;
        }

        try {
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

            // Insertion de l'évènement dans la table `band`
            $query = 'INSERT INTO band (name, description, img_url) VALUES (:name, :description, :attachment);';
            $bindValues = [
                'name' => htmlspecialchars($name),
                'description' => htmlspecialchars($description),
                'attachment' => htmlspecialchars($attachmentFileName)
            ];

            $isInsertOk = $dbCo->prepare($query)->execute($bindValues);

            if ($isInsertOk) {
                $idBand = $dbCo->lastInsertId();

                // Préparer les données pour `band_links`
                $links = [
                    ['url' => $youtubeLnk, 'id_website' => 1],
                    ['url' => $facebookLnk, 'id_website' => 4],
                    ['url' => $instaLnk, 'id_website' => 3],
                    ['url' => $webLnk, 'id_website' => 2],
                ];

                $linkInsertOk = true; // Pour suivre les erreurs
                $query = $dbCo->prepare(
                    'INSERT INTO band_links (url, id_band, id_website) VALUES (:url, :id_band, :id_website);'
                );

                foreach ($links as $link) {
                    if (!empty($link['url'])) {
                        $bindValues = [
                            'url' => htmlspecialchars($link['url']),
                            'id_band' => intval($idBand),
                            'id_website' => intval($link['id_website'])
                        ];
                        if (!$query->execute($bindValues)) {
                            $linkInsertOk = false;
                            break; // Arrêter en cas d'erreur
                        }
                    }
                }

                if ($linkInsertOk) {
                    addMessage('band_created');
                    redirectTo('backstage.php');
                } else {
                    addError('band_links_error');
                    redirectTo();
                    $_SESSION['form']['bandName'] = $name;
                    $_SESSION['form']['description'] = $description;
                    $_SESSION['form']['youtubeLnk'] = $youtubeLnk;
                    $_SESSION['form']['facebookLnk'] = $facebookLnk;
                    $_SESSION['form']['instaLnk'] = $instaLnk;
                    $_SESSION['form']['webLnk'] = $webLnk;
                }
            }
        } catch (Exception $e) {
            addError('band_not_created');

            // Gestion du formulaire
            $_SESSION['form']['bandName'] = $_POST['bandName'];
            $_SESSION['form']['description'] = $_POST['description'];
            $_SESSION['form']['youtubeLnk'] = $_POST['youtubeLnk'];
            $_SESSION['form']['facebookLnk'] = $_POST['facebookLnk'];
            $_SESSION['form']['instaLnk'] = $_POST['instaLnk'];
            $_SESSION['form']['webLnk'] = $_POST['webLnk'];

            $error = $e->getMessage();
            var_dump($error);
            exit;

            redirectTo();
        }
    } else if ($_REQUEST['action'] === 'program') {

        if (!isset($_POST['event']) || !intval($_POST['event'])) {
            addError('event_not_selected');
            redirectTo();
            exit;
        }

        if (!isset($_POST['band']) || !intval($_POST['band'])) {
            addError('band_not_selected');
            redirectTo();
            exit;
        }

        if (!isset($_POST['date'])) {
            addError('date_not_selected');
            redirectTo();
            exit;
        }

        if (!isset($_POST['time'])) {
            addError('time_not_selected');
            redirectTo();
            exit;
        }

        $query = $dbCo->prepare(
            'INSERT INTO band_event (id_event, id_band, date, hour) VALUES (:id_event, :id_band, :date, :hour);'
        );

        $bindValues = [
            'id_event' => intval($_POST['event']),
            'id_band' => intval($_POST['band']),
            'date' => $_POST['date'],
            'hour' => $_POST['time']
        ];

        if ($query->execute($bindValues)) {
            addMessage('program_created');
            redirectTo('backstage.php');
            exit;
        } else {
            addError('program_not_created');
            redirectTo();
            exit;
        }
    } else if ($_POST['action'] === 'new-sponsor') {
        if (!isset($_POST['sponsorName']) || $_POST['sponsorName'] === '') {
            addError('sponsorName_ko');
            redirectTo();
            exit;
        }

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

        if ($attachmentFileName === 'default.webp' || $attachmentFileName === '') {
            addError('sponsorLogo_ko');
            redirectTo();
            exit;
        }

        $sponsorName = htmlspecialchars($_POST['sponsorName']);

        $query = $dbCo->prepare(
            'INSERT INTO sponsor (name, logo_url) VALUES (:name, :logo);'
        );

        $bindValues = [
            'name' => $sponsorName,
            'logo' => htmlspecialchars($attachmentFileName)
        ];

        if ($query->execute($bindValues)) {
            addMessage('sponsor_created');
            redirectTo('backstage.php');
            exit;
        } else {
            addError('sponsor_not_created');
            redirectTo();
            exit;
        }
    } else if ($_POST['action'] === 'delete-event') {
        if (!isset($_POST['id_event']) || !intval($_POST['id_event'])) {
            addError('event_not_selected');
            redirectTo();
            exit;
        }

        if (!isset($_POST['id_band']) || !intval($_POST['id_band'])) {
            addError('band_not_selected');
            redirectTo();
            exit;
        }

        $query = $dbCo->prepare(
            'DELETE FROM band_event WHERE id_event = :id_event AND id_band = :id_band;'
        );

        $bindValues = [
            'id_event' => intval($_POST['id_event']),
            'id_band' => intval($_POST['id_band'])
        ];

        if ($query->execute($bindValues)) {
            addMessage('event_deleted');
            redirectTo();
            exit;
        } else {
            addError('event_not_deleted');
            redirectTo();
            exit;
        }
    } else if ($_POST['action'] === 'new-merchant') {
        if (!isset($_POST['merchantName']) || $_POST['merchantName'] === '') {
            addError('merchantName_ko');
            redirectTo();
            exit;
        }

        if (!isset($_POST['description']) || $_POST['description'] === '') {
            addError('description_ko');
            redirectTo();
            exit;
        }

        $merchantName = htmlspecialchars($_POST['merchantName']);
        $description = htmlspecialchars($_POST['description']);

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

        if ($attachmentFileName === 'default.webp' || $attachmentFileName === '') {
            addError('merchant_image_ko');
            redirectTo();
            exit;
        }

        $query = $dbCo->prepare(
            'INSERT INTO merchant (name, description, img_url) VALUES (:name, :description, :img);'
        );

        $bindValues = [
            'name' => $merchantName,
            'description' => $description,
            'img' => $attachmentFileName
        ];

        if ($query->execute($bindValues)) {
            addMessage('merchant_created');
            redirectTo('backstage.php');
            exit;
        } else {
            $_SESSION['form']['merchantName'] = $merchantName;
            $_SESSION['form']['description'] = $description;

            addError('merchant_not_created');
            redirectTo();
            exit;
        }
    } else if ($_POST['action'] === 'update-band') {
        if (!isset($_POST['id_band']) || !intval($_POST['id_band'])) {
            addError('band_not_selected');
            redirectTo();
            exit;
        }

        if (empty($_POST['bandName'])) {
            addError('bandName_ko');
            redirectTo();
            exit;
        }

        if (empty($_POST['description'])) {
            addError('description_ko');
            redirectTo();
            exit;
        }

        try {
            // Gestion du fichier attaché
            $attachmentFileName = 'default.webp'; // Valeur par défaut
            if (!empty($_FILES['attachment']['name'])) {
                $uploadDir = __DIR__ . '/img/'; // Dossier de destination

                // Vérification que le dossier existe, sinon le créer
                if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true) && !is_dir($uploadDir)) {
                    throw new Exception("Impossible de créer le dossier d'upload.");
                }

                // Récupérer les informations du fichier
                $fileName = pathinfo($_FILES['attachment']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);

                // time() pour assurer un nom de fichier unique.
                $attachmentFileName = $fileName . '_' . time() . '.' . $fileExtension;
                $uploadFile = $uploadDir . $attachmentFileName;

                // Vérification de l'erreur de téléchargement
                if ($_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
                    // Vérification des types de fichiers autorisés
                    $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
                    $fileType = mime_content_type($_FILES['attachment']['tmp_name']);

                    if (in_array($fileType, $allowedTypes)) {
                        // Déplacer le fichier vers le dossier de destination
                        if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadFile)) {
                            throw new Exception("Erreur lors du téléchargement de l'image.");
                        }
                        $attachmentFileName = htmlspecialchars($attachmentFileName);
                    } else {
                        throw new Exception("Type de fichier non autorisé.");
                    }
                } else {
                    throw new Exception("Erreur de téléchargement.");
                }
            }

            $query = $dbCo->prepare(
                'UPDATE band SET name = :name, description = :description, img_url = :attachment WHERE id_band = :id_band;'
            );

            $isUpdateOk = $query->execute([
                'name' => htmlspecialchars($_POST['bandName']),
                'description' => htmlspecialchars($_POST['description']),
                'attachment' => htmlspecialchars($attachmentFileName),
                'id_band' => intval($_POST['id_band'])
            ]);

            if ($isUpdateOk) {
                // Préparer les données pour `band_links`
                $links = [
                    ['url' => $_POST['youtubeLnk'] ?? '', 'id_website' => 1],
                    ['url' => $_POST['facebookLnk'] ?? '', 'id_website' => 4],
                    ['url' => $_POST['instaLnk'] ?? '', 'id_website' => 3],
                    ['url' => $_POST['webLnk'] ?? '', 'id_website' => 2],
                ];

                $query = $dbCo->prepare(
                    'UPDATE band_links SET url = :url WHERE id_band = :id_band AND id_website = :id_website;'
                );

                foreach ($links as $link) {
                    if (!empty($link['url'])) {
                        $query->execute([
                            'url' => htmlspecialchars($link['url']),
                            'id_band' => intval($_POST['id_band']),
                            'id_website' => $link['id_website']
                        ]);
                    }
                }

                addMessage('band_updated');
                redirectTo('backstage.php');
            } else {
                throw new Exception('Erreur lors de la mise à jour du groupe.');
            }
        } catch (Exception $e) {
            addError('band_update_error');

            // Stockage des valeurs en session pour éviter la perte des données en cas d'erreur
            $_SESSION['form'] = [
                'bandName' => $_POST['bandName'] ?? '',
                'description' => $_POST['description'] ?? '',
                'youtubeLnk' => $_POST['youtubeLnk'] ?? '',
                'facebookLnk' => $_POST['facebookLnk'] ?? '',
                'instaLnk' => $_POST['instaLnk'] ?? '',
                'webLnk' => $_POST['webLnk'] ?? ''
            ];

            redirectTo();
            exit;
        }
    } else if ($_POST['action'] === 'add-to-gallery') {
        if (!isset($_POST['event-select']) || $_POST['event-select'] <= 0) {
            addError('event_select_error');
            redirectTo();
            exit;
        }

        $uploadDir = __DIR__ . '/gallery/'; // Dossier de destination

        // Vérifier et créer le dossier si nécessaire
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true) && !is_dir($uploadDir)) {
            throw new Exception("Impossible de créer le dossier d'upload.");
        }

        $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
        $uploadedFiles = [];

        foreach ($_FILES['attachments']['name'] as $key => $name) {
            if ($_FILES['attachments']['error'][$key] === UPLOAD_ERR_OK) {
                $fileType = mime_content_type($_FILES['attachments']['tmp_name'][$key]);

                if (in_array($fileType, $allowedTypes)) {
                    $fileName = pathinfo($name, PATHINFO_FILENAME);
                    $fileExtension = pathinfo($name, PATHINFO_EXTENSION);

                    // Générer un nom unique
                    $uniqueFileName = $fileName . '_' . time() . '_' . uniqid() . '.' . $fileExtension;
                    $uploadFile = $uploadDir . $uniqueFileName;

                    if (move_uploaded_file($_FILES['attachments']['tmp_name'][$key], $uploadFile)) {
                        $uploadedFiles[] = htmlspecialchars($uniqueFileName);
                    } else {
                        addError("Erreur lors du téléchargement de l'image : " . $name);
                        continue;  // Passe au fichier suivant
                    }
                } else {
                    addError("Type de fichier non autorisé : " . $name);
                    continue;
                }
            } else {
                addError("Erreur de téléchargement pour : " . $name);
                continue;
            }
        }

        if (!empty($uploadedFiles)) {
            try {
                $dbCo->beginTransaction();

                $stmt = $dbCo->prepare("INSERT INTO gallery (id_event, file_url) VALUES (:event_id, :file_url)");

                foreach ($uploadedFiles as $file) {
                    $stmt->execute([
                        ':event_id' => intval($_POST['event-select']),
                        ':file_url' => $file
                    ]);
                }

                $dbCo->commit();
                addMessage('gallery_updated');
            } catch (Exception $e) {
                $dbCo->rollBack();
                throw new Exception("Erreur lors de l'insertion en base : " . $e->getMessage());
            }
        }

        redirectTo('backstage.php');
        exit;
    }
}

redirectTo();
