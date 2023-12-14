<?php
include(__DIR__ . '/../../includes/Config.php');
include(__DIR__ . '/../../includes/PostTable.php');

$postTable = new PostTable();

/*
 * Prepare data.
 */

$data = [
    ['post_id', 'username', 'email', 'image'],
];
$row          = $postTable->selectWherePostId($_GET['post-id']);
$row['image'] = $config['app']['domain'] . $row['image'];
$data[]       = $row;

/*
 * Set headers to download file.
 */

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv"');

/*
 * Write csv file.
 */

$output = fopen('php://output', 'w');
foreach ($data as $row) {
    fputcsv($output, $row);
}
fclose($output);
