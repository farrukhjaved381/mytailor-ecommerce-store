<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("admin-headscripts.php");
include("admin-navbar.php");
include("admin-sidebar.php");
