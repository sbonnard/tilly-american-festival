<?php

$messages = [
    'message_ok' => 'Message envoyé ! Je vous recontacte dès que possible.'
];

$errors = [
    'csrf' => 'Votre session est invalide.',
    'referer' => 'D\'où venez vous ?',
    'no_action' => 'Aucune action détectée.',
    'fullname_ko' => 'Le nom saisi n\'est pas valide.',
    'email_ko' => 'L\'email saisi n\'est pas valide.',
    'subject_ko' => 'Le sujet saisi n\'est pas valide.',
    'message_content_ko' => 'Merci de saisir un message.',
    'message_ko' => 'Échec lors de l\'envoi du message'
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
