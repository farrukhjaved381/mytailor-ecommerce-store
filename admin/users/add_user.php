<?php
ob_start(); // Start output buffering

include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/admin/includes/header/admin-header.php");
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/helper.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "mera_darzi");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fields = [
        'username' => $_POST["username"],
        'password' => $_POST["password"],
        'role' => $_POST["role"]
    ];

    $result = add_record("tbl_users", $fields);
    if ($result === "Record added successfully") {
        ob_end_clean(); // Clear the buffer before redirecting
        header("Location: users.php");
        exit();
    } else {
        echo $result;
    }

    $conn->close();
}
?>

<div class="container top-heading">
    <h2 style="text-align: center;">Add User</h2>
    <form method="POST" action="">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="username" required>
                    </td>
                    <td>
                        <input type="password" name="password" required>
                    </td>
                    <td>
                        <select name="role" id="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <h1>
            <button type="submit">Add User</button>
        </h1>
    </form>
</div>

</body>
</html>
