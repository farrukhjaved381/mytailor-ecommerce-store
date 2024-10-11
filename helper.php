<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function is_loggged_in()
{
    if (isset($_SESSION['username'])) {
        return true;
    } else {
        return false;
    }
}

function wpent_get_current_user()
{
    if (is_loggged_in()) {
        return array('login' => 1, 'user_fields' => array('username' => $_SESSION['username']));
    } else {
        return array('login' => 0, 'user_fields' => false);
    }
}

function get_records($table_name)
{
    $conn = new mysqli("localhost", "root", "", "mera_darzi");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_query = "SELECT * FROM $table_name";
    $records = $conn->query($sql_query);
    $rows= array();
    if ($records->num_rows > 0) {
        while ($row = $records->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    return $rows;
}

function delete_record($table_name, $record_id)
{
    $conn = new mysqli("localhost", "root", "", "mera_darzi");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql_query = "DELETE FROM $table_name WHERE id='$record_id'";
    
    if ($conn->query($sql_query) === true) {
        return "User record deleted successfully";
    } else {
        return "Error deleting record: " . $conn->error;
    }
}

function update_record($table_name, $record_id, $fields) {
    $conn = new mysqli("localhost", "root", "", "mera_darzi");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $arr = [];
    foreach ($fields as $column => $value) {
        $arr[] = "$column='" . $conn->real_escape_string($value) . "'";
    }
    $set_sql_stmt = implode(', ', $arr);

    $sql = "UPDATE $table_name SET $set_sql_stmt WHERE  id='$record_id'";

    if ($conn->query($sql) === true) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }

    $conn->close();
}

function add_record($table_name, $fields) {
    $conn = new mysqli("localhost", "root", "", "mera_darzi");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $columns = implode(', ', array_keys($fields));
    $data = implode(', ', array_fill(0, count($fields), '?'));

    $sql = "INSERT INTO $table_name ($columns) VALUES ($data)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        return false;
    }

    $types = '';
    $values = [];
    foreach ($fields as $value) {
        if (is_int($value)) {
            $types .= 'i'; // integer
        } elseif (is_float($value)) {
            $types .= 'd'; // double
        } elseif (is_string($value)) {
            $types .= 's'; // string
        } else {
            $types .= 's'; // default to string if type is unknown
        }
        $values[] = $value;
    }

    $stmt->bind_param($types, ...$values);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        echo "Error adding record: " . $stmt->error;
        $stmt->close();
        $conn->close();
        return false;
    }
}

function updateStichedStatus($checkboxValue, $id) {
    $conn = new mysqli("localhost", "root", "", "mera_darzi");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $basePriceQuery = $conn->query("SELECT product_price, quantity FROM tbl_cart WHERE id='$id'");
    $row = $basePriceQuery->fetch_assoc();
    $basePrice = $row['product_price'];
    $quantity = $row['quantity'];

    if ($checkboxValue == 1) {
        $newPrice = $basePrice + 500;
    } else {
        $newPrice = $basePrice - 500;
    }

    $totalPrice = $newPrice * $quantity;
    $conn->query("UPDATE tbl_cart SET product_price='$newPrice', total_price='$totalPrice', is_stiched='$checkboxValue' WHERE id='$id'");

    $grandTotalQuery = $conn->query("SELECT SUM(total_price) as grand_total FROM tbl_cart");
    $grandTotalRow = $grandTotalQuery->fetch_assoc();
    $grandTotal = $grandTotalRow['grand_total'];

    $conn->close();

     echo json_encode(array('new_price' => $newPrice, 'new_total_price' => $totalPrice, 'grand_total' => (float) $grandTotal));
     exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkbox_value'])) {
    $checkboxValue = $_POST['checkbox_value'];
    $id = $_POST['id'];
    $updatedPrices = updateStichedStatus($checkboxValue, $id);
    echo json_encode($updatedPrices);
}

function updateQuantity($quantity, $id) {
    $conn = new mysqli("localhost", "root", "", "mera_darzi");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $priceQuery = $conn->query("SELECT product_price FROM tbl_cart WHERE id='$id'");
    $row = $priceQuery->fetch_assoc();
    $price = $row['product_price'];

    $totalPrice = $price * $quantity;
    $conn->query("UPDATE tbl_cart SET quantity='$quantity', total_price='$totalPrice' WHERE id='$id'");

    $grandTotalQuery = $conn->query("SELECT SUM(total_price) as grand_total FROM tbl_cart");
    $grandTotalRow = $grandTotalQuery->fetch_assoc();
    $grandTotal = $grandTotalRow['grand_total'];

    $conn->close();

    echo json_encode( array('new_total_price' => (float) $totalPrice, 'grand_total' => (float) $grandTotal));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['checkbox_value']) && isset($_POST['id'])) {
        $checkboxValue = $_POST['checkbox_value'];
        $id = $_POST['id'];
        $updatedPrices = updateStichedStatus($checkboxValue, $id);
        echo json_encode($updatedPrices);
    } elseif (isset($_POST['quantity']) && isset($_POST['id'])) {
        $quantity = $_POST['quantity'];
        $id = $_POST['id'];
        $updatedPrices = updateQuantity($quantity, $id);
        echo json_encode($updatedPrices);
    }
}