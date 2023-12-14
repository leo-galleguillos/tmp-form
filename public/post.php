<?php

require_once(__DIR__ . '/../includes/Validator.php');

$validator = new Validator();
$validator->validateForm();

if (!$validator->isFormValid()) {
    session_start();
    $_SESSION['flash'] = [];
    $_SESSION['flash']['errors'] = $validator->getErrors();

    header('Location: index.php', true, 303);
    exit();
}

header('Location: success.php', true, 303);
exit();
