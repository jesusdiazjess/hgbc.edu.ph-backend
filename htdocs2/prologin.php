<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: home.php");
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
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: home.php");
            exit;
        } else {
            // Invalid password
            $is_invalid = true;
        }
    } else {
        // No such user found
        $is_invalid = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invalid Log In :: HGBaquiran College</title>
    <link rel="stylesheet" href="prologin.css">
    <link rel="icon" href="https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="prologin.js" defer></script>

    <style>
        .pass {
            margin-bottom: 1em;
            text-align: right;
            font-size: 14px;
            color: #888888;
        }
        .pass a {
            text-decoration: none;
            color: #007bff;
        }
        .pass a:hover {
            color: #0056b3;
        }



        /* Reset some basic margins and paddings */
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Ubuntu', sans-serif;
    overflow: hidden;
}

/* Background gradient */
body::before {
    content: '';
    position: fixed; /* Change to fixed to stay in place */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('image1.jpg') no-repeat center center;
    background-size: cover;
    opacity: 1;
    animation: fadeInOut 24s infinite;
}

@keyframes fadeInOut {
0% {
    opacity: 1;
    background-image: url('imaHEN/background/invalid.webp');
}
25% {
    opacity: 1;
    background-image: url('imaHEN/background/invalid.webp');
}
50% {
    opacity: 1;
    background-image: url('imaHEN/background/invalid.webp');
}
75% {
    opacity: 1;
    background-image: url('imaHEN/background/invalid.webp');
}
100% {
    opacity: 1;
    background-image: url('imaHEN/background/invalid.webp');
}
}




    </style>
</head>

<body>
    <div class="center">
        <form action="prologin.php" method="post">

            <div class="login-header">
                <img src="https://raw.githubusercontent.com/jesusdiazjess/hgbc.edu.ph/main/images/logo.png" alt="Logo" class="login-logo">
                <h1 class="error-heading">Invalid Log In</h1>
            </div>
            
            <!-- Display the invalid login message if credentials are wrong -->
            <?php if ($is_invalid): ?>
                <em style="color: red;"><!--Invalid Login--></em>
            <?php endif; ?>

            <div class="txt_field">
                <input type="email" name="email" id="email" required value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
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
        </form>
    </div>
<!-- Footer --><!-- Footer --><!-- Footer --><!-- Footer --><!-- Footer --><!-- Footer --><!-- Footer --><!-- Footer --><!-- Footer -->
<footer>
<div>&copy; <span id="year"></span> HGBaquiran College, Inc.</div>
    <script>
    // Get the current year
    const currentYear = new Date().getFullYear();
    // Set the year in the HTML
    document.getElementById('year').textContent = currentYear;
    </script>
    <div class="footer-links">
      <a href="termsofuse.html">Terms of Use</a>
      <a href="privacypolicy.html">Privacy Policy</a>
    </div>
    <style>
      footer {
        background-color: #333;
        color: #fff;
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        font-size: 16px;
        text-align: center;
      }
    
      footer div {
        color: #fff;
      }
    
      .footer-links a {
        margin: 0 10px;
        text-decoration: none;
        color: #fff;
        display: inline-block;
      }
    
      .footer-links a:hover {
        text-decoration: underline;
      }
    
      /* Responsive for smaller screens */
      @media (max-width: 768px) {
        footer {
          flex-direction: column;
        }
        .footer-links {
          margin-top: 10px;
          text-align: center; /* Center the links */
        }
        .footer-links a {
          display: inline-block; /* Keep the links side by side */
          margin: 0 5px;
        }
      }
    </style> 
  </footer>
</body>
</html>
