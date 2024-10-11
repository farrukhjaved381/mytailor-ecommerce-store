<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'] . "/myweb/mera-darzi/helper.php");
// Check if the user is logged in
if (is_loggged_in()) {
    // User is logged in, redirect to checkout
    header("Location: checkout.php");
    exit();
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}