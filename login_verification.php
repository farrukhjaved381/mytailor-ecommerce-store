<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["un"];
    $password = $_POST["pass"];
    $conn = new mysqli("localhost", "root", "", "mera_darzi");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check user role and redirect accordingly
        if ($user['role'] == 'admin') {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = 'admin';
            header("Location:/myweb/mera-darzi/admin/index.php");
        } else if($user['role'] == 'user') {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = 'user';
            header("Location:/myweb/mera-darzi/index.php");
        }
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}