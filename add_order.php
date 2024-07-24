<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $products = $_POST['products']; // Array of product IDs
    $quantities = $_POST['quantities']; // Array of quantities for each product

    $total = 0;
    foreach ($products as $index => $product_id) {
        $quantity = $quantities[$index];
        $sql = "SELECT price FROM products WHERE id=$product_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total += $row['price'] * $quantity;
        }
    }

    $sql = "INSERT INTO orders (customer_id, total) VALUES ('$customer_id', '$total')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;
        foreach ($products as $index => $product_id) {
            $quantity = $quantities[$index];
            $sql = "SELECT price FROM products WHERE id=$product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $price = $row['price'];
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
                $conn->query($sql);
            }
        }
        echo "Order added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Add Order</h2>
<form method="post" action="">
  Customer ID: <input type="text" name="customer_id"><br><br>
  Products: <input type="text" name="products[]"><br><br>
  Quantities: <input type="text" name="quantities[]"><br><br>
  <input type="submit" value="Add Order">
</form>

</body>
</html>
