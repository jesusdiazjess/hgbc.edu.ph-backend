<?php
session_start();
//THIS IS TO PREVENT CACHING
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - HGBaquiran College</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    <link rel="icon" href="https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/favicon.ico" type="image/x-icon">
</head>
<body>
    <h1>Home</h1>
    <?php if (isset($user)): ?>
        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>
        <p><a href="prosignout.php">Log Out</a></p>
    <?php else: ?>
        <p><a href="login.html">Log In</a> or <a href="signup.html">Sign Up</a></p>
    <?php endif; ?>
</body>
</html>