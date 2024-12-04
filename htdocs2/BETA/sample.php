<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: home.php"); // Redirect to home page if logged in
    exit();
}
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";

    // Sanitize and escape user input
    $email = $mysqli->real_escape_string($_POST["email"]);

    // Prepare the SQL query
    $sql = "SELECT * FROM user WHERE email = '$email'";

    // Execute the query
    $result = $mysqli->query($sql);

    // Fetch the user details
    $user = $result->fetch_assoc();

    // Check if the user exists and password is correct
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: home.php");
            exit;
        } else {
            $is_invalid = true; // Invalid password
        }
    } else {
        $is_invalid = true; // No such user found
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In :: HGBaquiran College</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="center">
        <form action="prologin.php" method="post">
            <div class="login-header">
                <img src="https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/images/logo.png" alt="Logo" class="login-logo">
                <h1>Log In</h1>
            </div>

            <!-- Display error message when login fails -->
            <?php if ($is_invalid): ?>
                <div class="error-message" style="color: red; text-align: center; margin-bottom: 10px;">
                    Invalid email or password.
                </div>
            <?php endif; ?>

            <div class="txt_field">
                <input type="email" name="email" id="email" required placeholder=" "
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                <label for="email">Email</label>
            </div>

            <div class="txt_field">
                <input type="password" name="password" id="password" required placeholder=" ">
                <label for="password">Password</label>
                <span class="eye-icon" onclick="togglePasswordVisibility()">
                    <i id="toggleIcon" class="fa fa-eye"></i>
                </span>
            </div>

            <div class="pass"><a href="https://jesusdiazjess.github.io/hgbc.edu.ph/">Forgot Password?</a></div>

            <input type="submit" value="Log In">

            <h3>Don't have an account?<br><a href="signup.html" style="text-decoration: underline;">Create Account</a></h3>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <div>&copy; 2024 HGBaquiran College, Inc.</div>
        <div class="footer-links">
            <a href="termsofuse.html">Terms of Use</a>
            <a href="privacypolicy.html">Privacy Policy</a>
        </div>
    </footer>

    <script src="login.js"></script>
</body>
</html>
