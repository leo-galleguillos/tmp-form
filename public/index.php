<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Page</title>
</head>
<body>
    <h1>Form Example</h1>

    <form action="post.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="email">Email Address:</label><br>
            <input type="email" name="email" id="email" required>
        </p>
        <p>
            <label for="image">Image Upload:</label><br>
            <input type="file" name="image" id="image" accept="image/*" required>
        </p>
        <button type="submit">Submit</button>
    </form>
</body>
</html>