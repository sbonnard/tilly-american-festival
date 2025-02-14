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

    ///////////////////////////////////////////////////////// CONTACT PARTNER /////////////////////////////////////////////////////////
    if ($_POST['action'] === 'contact-partner') {

        $_SESSION['form']['fullname'] = htmlspecialchars(trim($_POST['fullname'] ?? ''));
        $_SESSION['form']['enterprise'] = htmlspecialchars(trim($_POST['enterprise'] ?? ''));
        $_SESSION['form']['email'] = htmlspecialchars(trim($_POST['email'] ?? ''));
        $_SESSION['form']['subject'] = htmlspecialchars(trim($_POST['subject'] ?? ''));
        $_SESSION['form']['message'] = htmlspecialchars(trim($_POST['message'] ?? ''));

        // Sanitize inputs (eviter les doublons)
        $fields = ['fullname', 'enterprise', 'email', 'subject', 'message'];
        foreach ($fields as $field) {
            $_SESSION['form'][$field] = htmlspecialchars(trim($_POST[$field] ?? ''));
        }

        // Validation des champs
        $errors = [];
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = $field . '_ko';
            }
        }

        // Si des erreurs existent, redirige
        if (!empty($errors)) {
            foreach ($errors as $error) {
                addError($error); // Enregistre chaque erreur
            }
            redirectTo();
            exit;
        }

        // Protection contre les en-têtes malveillants
        $subject = str_replace(array("\r", "\n"), '', $_SESSION['form']['subject']);
        $subject = 'Contact Partenaire : ' . $subject;
        $body = "Nom: {$_SESSION['form']['fullname']}\nEntreprise: {$_SESSION['form']['enterprise']}\nEmail: {$_SESSION['form']['email']}\nMessage: {$_SESSION['form']['message']}";

        // Envoi de l'email avec gestion des erreurs
        if (mail($contactMail, $subject, $body)) {
            addMessage('message_partner_ok');
            unset($_SESSION['form']);
        } else {
            addError('message_partner_ko');
        }

        // Redirection après traitement
        redirectTo();
    }

    if ($_POST['action'] === 'contact') {

        $_SESSION['form']['fullname'] = htmlspecialchars(trim($_POST['fullname'] ?? ''));
        $_SESSION['form']['email'] = htmlspecialchars(trim($_POST['email'] ?? ''));
        $_SESSION['form']['subject'] = htmlspecialchars(trim($_POST['subject'] ?? ''));
        $_SESSION['form']['message'] = htmlspecialchars(trim($_POST['message'] ?? ''));

        // Sanitize inputs (eviter les doublons)
        $fields = ['fullname', 'email', 'subject', 'message'];
        foreach ($fields as $field) {
            $_SESSION['form'][$field] = htmlspecialchars(trim($_POST[$field] ?? ''));
        }

        // Validation des champs
        $errors = [];
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = $field . '_ko';
            }
        }

        // Si des erreurs existent, redirige
        if (!empty($errors)) {
            foreach ($errors as $error) {
                addError($error); // Enregistre chaque erreur
            }
            redirectTo();
            exit;
        }

        // Protection contre les en-têtes malveillants
        $subject = str_replace(array("\r", "\n"), '', $_SESSION['form']['subject']);
        $subject = 'Contact Particulier : ' . $subject;
        $body = "Nom: {$_SESSION['form']['fullname']}\nEmail: {$_SESSION['form']['email']}\nMessage: {$_SESSION['form']['message']}";

        // Envoi de l'email avec gestion des erreurs
        if (mail($contactMail, $subject, $body)) {
            addMessage('message_partner_ok');
            unset($_SESSION['form']);
        } else {
            addError('message_partner_ko');
        }

        // Redirection après traitement
        redirectTo();
    }
}

redirectTo();
