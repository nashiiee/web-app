<?php
include "../database/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $orderID = $_POST["order_id"];

  try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = :orderID");
    $stmt->bindParam(':orderID', $orderID);
    $stmt->execute();

    $result = $stmt->fetch();

    if ($result) {
      echo "<h1>Order Details</h1>";
      echo "<table>";
      echo "<tr><td>Order ID</td><td>" . $result['order_id'] . "</td></tr>";
      echo "<tr><td>Name</td><td>" . $result['name'] . "</td></tr>";
      echo "<tr><td>Coffee Type</td><td>" . $result['coffee_type'] . "</td></tr>";
      echo "<tr><td>Total Price</td><td>" . $result['total_price'] . "</td></tr>";
      echo "</table>";
    } else {
      echo "Order not found. Try again.";
    }
  } catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }

  $conn = null;
}
?>
