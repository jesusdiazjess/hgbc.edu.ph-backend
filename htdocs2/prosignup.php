<?php

session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: home.php"); // Redirect to home page if logged in
    exit();
}

$error_message = "";
$email_error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the name is provided
    if (empty($_POST["name"])) {
        $error_message = "Name is required";
    }

    // Check if the email is valid
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error_message = "Valid email is required";
    }

    // Check if the password meets the requirements
    $error_message = "";

// Check if the password is at least 8 characters long
if (strlen($_POST["password"]) < 8) {
    $error_message .= "Password must be at least 8 characters long. ";
}

// Check if the password contains at least one letter
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    $error_message .= "Password must contain at least one letter. ";
}

// Check if the password contains at least one number
if (!preg_match("/[0-9]/", $_POST["password"])) {
    $error_message .= "Password must contain at least one number. ";
}

// Check if the password contains at least one special character
if (!preg_match("/[\W_]/", $_POST["password"])) {
    $error_message .= "Password must contain at least one special character. ";
}

// Check if the password matches the confirmation password
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    $error_message .= "Passwords must match. ";
}

// If there is any error, prevent signup and display the error message
if (!empty($error_message)) {
    echo $error_message;
} else {
    // Proceed with the signup process if no errors
    echo "Signup unsuccessful!";
}


    // If there's an error, display it on the sign-up page
    if (empty($error_message)) {
        // Hash the password
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Database connection
        $mysqli = require __DIR__ . "/database.php";

        // Prepare the SQL statement
        $sql = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";

        $stmt = $mysqli->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        // Bind parameters
        $stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

        // Execute the statement
        if ($stmt->execute()) {
            // Directly redirect without file_exists() check
            header("Location: /success.html");
            exit;
        } else {
            // Check for duplicate entry error
            if ($stmt->errno == 1062) {
                $email_error = "This email is already registered. Please use a different email.";
            } else {
                $error_message = "An error occurred while processing your request. Please try again.";
            }
        }
        // Close the statement and connection
        $stmt->close();
        $mysqli->close();
    }
}
?>