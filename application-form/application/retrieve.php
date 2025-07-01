<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Retrieve</title>
  <link rel="stylesheet" href="../styles/retrieve.css">
</head>
  <?php
    include "../database/applicationdb.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $applicantID = $_POST["applicant_id"];

      try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM applicants WHERE applicant_id = :applicantID");
        $stmt->bindParam(':applicantID', $applicantID);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result) {
          echo "<h1>Applicant Details</h1>";
          echo "<table>";
          echo "<tr><td>Applicant ID</td><td>" . htmlspecialchars($result['applicant_id']) . "</td></tr>";
          echo "<tr><td>First Name</td><td>" . htmlspecialchars($result['first_name']) . "</td></tr>";
          echo "<tr><td>Last Name</td><td>" . htmlspecialchars($result['last_name']) . "</td></tr>";
          echo "<tr><td>Email</td><td>" . htmlspecialchars($result['email']) . "</td></tr>";
          echo "<tr><td>Phone</td><td>" . htmlspecialchars($result['phone']) . "</td></tr>";
          echo "<tr><td>Country</td><td>" . htmlspecialchars($result['country']) . "</td></tr>";
          echo "<tr><td>City</td><td>" . htmlspecialchars($result['city']) . "</td></tr>";
          echo "<tr><td>Address</td><td>" . htmlspecialchars($result['address']) . "</td></tr>";
          echo "<tr><td>Position</td><td>" . htmlspecialchars($result['position']) . "</td></tr>";
          echo "<tr><td>Additional Info</td><td>" . nl2br(htmlspecialchars($result['additional_info'])) . "</td></tr>";
          echo "</table>";
          echo "<form action='../pages/index.html'>";
          echo "<button type='submit' class='main-menu-btn'>Main Menu</button>";
          echo "</form>";
        } else {
          echo "Applicant not found. Try again.";
        }
      } catch (PDOException $e) {
        echo 'ERROR: ' . htmlspecialchars($e->getMessage());
      }
    }

    $conn = null;
  ?>
<body>
</body>
</html>