<!-- edit_user.php -->
<?php
ob_start(); // Start output buffering

include ($_SERVER['DOCUMENT_ROOT'] . "/myweb/mera-darzi/admin/includes/header/admin-header.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/myweb/mera-darzi/helper.php");

$record_id = $_GET["id"];

$conn = new mysqli("localhost", "root", "", "mera_darzi");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$q = "SELECT * FROM tbl_users WHERE id='$record_id'";
$record = $conn->query($q);

if ($record->num_rows > 0) {
    $row = $record->fetch_assoc();
    $id = $row["id"];
    $username = $row["username"];
    $password = $row["password"];
    $role = $row["role"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = [
        'username' => $_POST["username"],
        'password' => $_POST["password"],
        'role' => $_POST["role"]
    ];

    $result = update_record("tbl_users", $record_id, $fields);
    if ($result === "Record updated successfully") {
        ob_end_clean(); // Clear the buffer before redirecting
        header("Location: users.php");
        exit();
    } else {
        echo $result;
    }
}

$conn->close();
?>

<div class="container top-heading">
    <h2 style="text-align: center;">Edit User</h2>
    <form method="POST" action="">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" required>
                    </td>
                    <td>
                        <input type="password" name="password" value="<?php echo $password; ?>" required>
                    </td>
                    <td>
                        <select name="role" id="role" value="<?php echo $role; ?>" required>
                            <option value="user" <?php echo $role == 'user' ? 'selected' : ''; ?>>User</option>
                            <option value="admin" <?php echo $role == 'admin' ? 'selected' : ''; ?>>Admin</option>

                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <h1>
            <button type="submit">Update User</button>
        </h1>

    </form>
</div>

</body>

</html>