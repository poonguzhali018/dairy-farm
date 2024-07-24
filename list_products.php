<?php
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<body>

<h2>Product List</h2>

<table border="1">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Stock</th>
  </tr>
  <?php
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["description"]. "</td><td>" . $row["price"]. "</td><td>" . $row["stock"]. "</td></tr>";
      }
  } else {
      echo "<tr><td colspan='5'>No products found</td></tr>";
  }
  ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
