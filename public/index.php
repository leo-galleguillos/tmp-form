<?php
session_start();
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Page</title>
    <link rel="stylesheet" href="/css/style.css?v=0.0.0">
</head>
<body>
    <h1>Form Example</h1>

    <form action="post.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="email">Email Address</label><br>
            <input type="email" name="email" id="email" required>
        </p>
        <p>
            <label for="image">Image Upload</label><br>
            <input type="file" name="image" id="image" accept="image/*" required>
        </p>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <input type="submit" value="Submit">
    </form>

    <?php if (
        isset($_SESSION['flash']['errors'])
        && is_array($_SESSION['flash']['errors'])
    ): ?>
        <ul class="errors">
            <?php foreach ($_SESSION['flash']['errors'] as $error): ?>
                <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
</body>
</html>
<?php
unset($_SESSION['flash']);
