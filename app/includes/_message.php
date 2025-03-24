<?php

$messages = [
    'message_ok' => 'Message envoyé ! Je vous recontacte dès que possible.',
    'message_partner_ok' => 'Message envoyé ! Nous vous recontacterons dans les plus brefs delais.',
    'event_created' => 'Votre evenement a bien ete cree !',
    'band_created' => 'Votre groupe a bien ete créé !',
    'program_created' => 'Votre programmation a bien ete créée !',
    'sponsor_created' => 'Votre sponsor a bien ete créé !',
    'event_deleted' => 'Votre evenement a bien ete déprogrammé !',
    'merchant_created' => 'Votre exposant a bien ete créé !',
    'band_updated' => 'Votre groupe a bien ete mis à jour !',
    'gallery_updated' => 'Votre galerie a bien ete mise à jour !',
];

$errors = [
    'csrf' => 'Votre session est invalide.',
    'referer' => 'D\'où venez vous ?',
    'no_action' => 'Aucune action détectée.',
    'fullname_ko' => 'Le nom saisi n\'est pas valide.',
    'enterprise_ko' => 'Le nom d\'entreprise saisi n\'est pas valide.',
    'email_ko' => 'L\'email saisi n\'est pas valide.',
    'subject_ko' => 'Le sujet saisi n\'est pas valide.',
    'message_content_ko' => 'Merci de saisir un message.',
    'message_ko' => 'Échec lors de l\'envoi du message',
    'message_partner_ko' => 'Échec lors de l\'envoi du message',
    'login_fail' => 'Identifiant ou mot de passe incorrect.',
    'eventName_ko' => 'Le nom de l\'evenement saisi n\'est pas valide.',
    'year_ko' => 'L\'année saisi n\'est pas valide.',
    'is_taf_ko' => 'Je n\'ai pas  u déterminer si l\'évènement était ou non un TAF.',
    'attachment_ko' => 'Le fichier saisi n\'est pas valide.',
    'event_not_created' => 'L\'evenement n\'a pas pu etre créé.',
    'band_name_ko' => 'Le nom du groupe saisi n\'est pas valide.',
    'band_description_ko' => 'La description du groupe saisi n\'est pas valide.',
    'band_links_error' => 'Un des liens saisi n\'est pas valide.',
    'band_not_created' => 'Le groupe n\'a pas pu etre créé.',
    'event_not_selected' => 'Merci de choisir un evenement.',
    'band_not_selected' => 'Merci de choisir un groupe.',
    'date_not_selected' => 'Merci de choisir une date.',
    'time_not_selected' => 'Merci de choisir une heure.',
    'program_not_created' => 'La programmation n\'a pas pu etre cree.',
    'sponsorName_ko' => 'Le nom du sponsor saisi n\'est pas valide.',
    'sponsorLogo_ko' => 'Le logo du sponsor saisi n\'est pas valide.',
    'sponsor_not_created' => 'Le sponsor n\'a pas pu etre créé.',
    'event_not_selected' => 'Merci de choisir un evenement.',
    'band_not_selected' => 'Merci de choisir un groupe.',
    'event_not_deleted' => 'L\'evenement n\'a pas pu etre supprimé.',
    'merchant_image_ko' => 'Le fichier saisi n\'est pas valide en illustration de l\'exposant.',
    'merchant_not_created' => 'L\'exposant n\'a pas pu etre cree.',
    'band_update_error' => 'Le groupe n\'a pas pu être mis à jour.',
    'event_select_error' => 'Merci de choisir un evenement.'
];


/**
 * Triggers if an error occurs and exits script.
 *
 * @param string $error The name of the error from errors array.
 * @return void
 */
function triggerError(string $error): void
{
    global $errors;
    $response = [
        'isOk' => false,
        'errorMessage' => $errors[$error]
    ];
    echo json_encode($response);
    exit;
}

/**
 * Add a new error message to display on next page. 
 *
 * @param string $errorMsg - Error message to display
 * @return void
 */
function addError(string $errors): void
{
    $_SESSION['error'] = $errors;
}


/**
 * Add a new message to display on next page. 
 *
 * @param string $message - Message to display
 * @return void
 */
function addMessage(string $message): void
{
    $_SESSION['msg'] = $message;
}

/**
 * Get error messages if the user fails to add a task.
 *
 * @return string The error message.
 */
function getErrorMessage(array $errors): string
{
    if (isset($_SESSION['error'])) {
        $e = ($_SESSION['error']);
        unset($_SESSION['error']);
        return '<p class="notif notif--error" id="error-message">' . $errors[$e] . '</p>';
    }
    return '';
}

/**
 * Get success messages if the user succeeds to add a task.
 *
 * @return string The success message.
 */
function getSuccessMessage(array $messages): string
{
    if (isset($_SESSION['msg'])) {
        $m = ($_SESSION['msg']);
        unset($_SESSION['msg']);
        return '<p class="notif notif--success" id="success-message">' . $messages[$m] . '</p>';
    }
    return '';
}
