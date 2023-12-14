<?php
require_once(__DIR__ . '/../../includes/PostTable.php');
$postTable = new PostTable();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section</title>
    <link rel="stylesheet" href="/css/style.css?v=0.0.0">
</head>
<body>
    <h1>Admin Section</h1>

    <table>
        <thead>
            <tr>
                <th>Post ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Image</th>
                <th>Export</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($postTable->select() as $post): ?>
                <tr>
                    <td><?= intval($post['post_id']) ?></td>
                    <td><?= htmlspecialchars($post['username']) ?></td>
                    <td><?= htmlspecialchars($post['email']) ?></td>
                    <td><img src="<?= htmlspecialchars($post['image']) ?>"></td>
                    <td><a href="/admin/csv.php?post-id=<?= intval($post['post_id']) ?>">CSV</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
