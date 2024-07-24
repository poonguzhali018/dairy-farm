<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO customers (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "New customer added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Add Customer</h2>
<form method="post" action="">
  Name: <input type="text" name="name"><br><br>
  Email: <input type="text" name="email"><br><br>
  Phone: <input type="text" name="phone"><br><br>
  Address: <textarea name="address"></textarea><br><br>
  <input type="submit" value="Add Customer">
</form>

</body>
</html>
