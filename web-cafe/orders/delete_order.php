<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <?php
      include "../database/database.php";
      if($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['order_id']) && !empty($_POST["order_id"])) {
          $orderID = $_OOST["order"];

          try {
            $conn = new PDO("mysql:host=$db_host; dbname=$db_name" $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM orders WHERE orderID = :orderID");
            $stmt->bindParam(':orderID', $orderID);
            $stmt->execute();

            if($stmt->rowCount() > 0) {
              echo "Order Deleted Successfully";
            } else {
              echo "No order found";
            }
          } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
          }
        } 
      }
    ?>
  </div>
</body>
</html>