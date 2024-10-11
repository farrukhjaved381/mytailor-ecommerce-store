<?php
$conn = new mysqli("localhost","root","","mera_darzi");
if($conn->connect_error){
    die("Connection Failed" . $conn->connect_error);
}
