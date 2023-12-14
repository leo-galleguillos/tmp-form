<?php

/*
 * Validate form.
 */

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

/*
 * Store form in MySQL.
 */

require_once(__DIR__ . '/../includes/PostTable.php');
$postTable    = new PostTable();
$lastInsertId = $postTable->insert('1', '2');

$fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
$fileName      = $lastInsertId . '.' . strtolower($fileExtension);
$postTable->updateSetImageWherePostId(
    '/images/posts/' . $fileName,
    $lastInsertId,
);

/*
 * Scale and save image.
 */

$imagickImage = new Imagick($_FILES['image']['tmp_name']);
if ($imagickImage->getImageWidth() > 300) {
    $imagickImage->resizeImage(300, 0, Imagick::FILTER_LANCZOS, 1);
}
if ($imagickImage->getImageHeight() > 300) {
    $imagickImage->resizeImage(0, 300, Imagick::FILTER_LANCZOS, 1);
}
$imagickImage->writeImage(__DIR__ . '/images/posts/' . $fileName);

header('Location: success.php', true, 303);
exit();
