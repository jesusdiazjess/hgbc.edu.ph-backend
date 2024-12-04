<?php
session_start(); //START THE SESSION

//CHECK IF A SESSION IS ACTIVE, THEN LOG OUT
if (isset($_SESSION["user_id"])) {
    session_unset(); //UNSET ALL SESSION VARIABLES
    session_destroy(); //DESTROY THE SESSION
}

//REDIRECT TO THE LOG IN PAGE/HOMEPAGE AFTER LOGOUT
header("Location: home.php");
exit;
?>