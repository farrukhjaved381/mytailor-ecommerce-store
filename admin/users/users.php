<?php
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/admin/includes/header/admin-header.php");
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/helper.php");
$users = get_records("tbl_users");
?>

<div class="container top-heading">
  <h1>Users Data
    <span style="float:right;">
      <a href='add_user.php'>
        <button>Add New User</button>
      </a>
    </span>
  </h1>
  
  <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Role</th>
        <th style='text-align:center'>Action</th>
      </tr>
    
      <?php
      if (!empty($users)) {
          foreach ($users as $user) {
              $id = $user["id"];
              $username = $user["username"];
              $pass = $user["password"];
              $role = $user["role"];
              echo "<tr>";
              echo "<td>$id</td>";
              echo "<td>$username</td>";
              echo "<td>$pass</td>";
              echo "<td>$role</td>";
              echo "<td class='action-buttons' style='text-align:center'>
              <span>
                <a href='edit_user.php?id=$id'>
                  <button>Edit</button>
                </a>
              </span>
              <span>
                <a href='delete_user.php?id=$id' onclick='return confirm(\"Are you sure you want to delete this user?\")'>
                  <button class='delete'>Delete</button>
                </a>
              </span>
              </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='5' style='text-align:center;'>No users found.</td></tr>";
      }
      ?>
  </table>
</div>

</body>
</html>
