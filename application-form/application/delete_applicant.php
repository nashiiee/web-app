<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../styles/delete.css">
</head>
<body>
  <?php
    include "../database/applicationdb.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      if (isset($_POST['delete_id']) && !empty($_POST["delete_id"])) {
        $deleteID = $_POST["delete_id"];

        try {
          $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $conn->prepare("DELETE FROM applicants WHERE applicant_id = :deleteID");
          $stmt->bindParam(':deleteID', $deleteID);
          $stmt->execute();

          if ($stmt->rowCount() > 0) {
            echo "<p class='applicant-deleted'>Applicant Deleted Successfully</p>";
            echo "<br><a href='../pages/index.html' class='return-to-main-btn'>Return to Main Menu</a>";
          } else {
            echo "No applicant found with that ID";
          }
        } catch (PDOException $e) {
          echo "ERROR: " . $e->getMessage();
        }
      } else {
        echo "Please provide a valid ID to delete.";
      }
    }
  ?>
</body>
</html>