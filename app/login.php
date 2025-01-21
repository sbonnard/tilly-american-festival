<?php
session_start();

//CONFIG AND CONNECTION
require_once "includes/_config.php";
require_once "includes/_database.php";

// DATAS
// require_once "includes/_datas.php";

// FUNCTIONS
require_once "includes/_functions.php";
require_once "includes/_security.php";
require_once "includes/_message.php";


// header('Content-type:application/json');


if (!isset($_POST['action'])) {
    addError('no_action');
    exit;
}

// Check CSRF
preventFromCSRF('index.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'login') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    
    $query = $dbCo->prepare('SELECT * FROM roady WHERE username = :username');
    $query->execute(['username' => $username]);
    $user = $query->fetch();
    
    if ($user && password_verify($password, $user['password']) && $user['active'] === 1 && $user['admin'] === 1) {

        $_SESSION['username'] = $user['username'];
        $_SESSION['id_roady'] = $user['id_roady'];
        $_SESSION['admin'] = $user['admin'];
        $_SESSION['overlord'] = $user['overlord'];
    } else {
        addError('login_fail');
        redirectTo();
        exit;
    }
}

redirectTo('backstage.php');
