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
        'name' => $_POST["name"],
        'description' => $_POST["description"],
        'price' => $_POST["price"],
        'image' => $_POST["image"]
    ];


    $result = add_record("tbl_products", $fields);
    if ($result === "Record added successfully") {
        ob_end_clean(); // Clear the buffer before redirecting
        header("Location: products.php");
        exit();
    } else {
        echo $result;
    }

    $conn->close();
}
?>

<div class="container top-heading">
    <h2 style="text-align: center;">Add Product</h2>
    <form method="POST" action="">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="name" required>
                    </td>
                    <td>
                        <input type="text" name="description"
                            required>
                    </td>
                    <td>
                        <input type="text" name="price" required>
                    </td>
                    <td>
                        <input type="text" name="image" required>
                    </td>
                </tr>
            </tbody>
        </table>
        <h1>
            <button type="submit">Add Product</button>
        </h1>
    </form>
</div>

</body>
</html>