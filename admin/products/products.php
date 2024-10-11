<?php
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/admin/includes/header/admin-header.php");
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/helper.php");
$products = get_records("tbl_products");
?>
<div class="container top-heading">
  <h1>Products
    <span style="float:right;">
    <a href='add_products.php?id=$id'>
        <button>Add New Products</button>
      </a>
    </span>
  </h1>
  <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th style='text-align:center'>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
           foreach ($products as $product) {
            $id = $product["id"];
            $name = $product["name"];
            $description = $product["description"];
            $price = $product["price"];
            $image = $product["image"];
          echo "<tr>";
          echo "<td>$id</td>";
          echo "<td>$name</td>";
          echo "<td>$description</td>";
          echo "<td>$price</td>";
          echo "<td><img src='$image' alt='Product Image' width='50' height='50'></td>";
          echo "<td>
          <span>
          <a href='edit_products.php?id=$id'>
          <button style='padding:5px'>Edit</button>
          </a>
          </span>
          <span style='padding-left:20px'>
          <a href='delete_products.php?id=$id'>
          <button style='padding:5px'>Delete</button>
          </a>
          </span>
          </td>";
          echo "</tr>";
         
          
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
