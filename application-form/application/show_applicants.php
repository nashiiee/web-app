<?php 
  include "../database/applicationdb.php";

  try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM applicants");
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($row['applicant_id']) . "</td>";
      echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['email']) . "</td>";
      echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
      echo "<td>" . htmlspecialchars($row['country']) . "</td>";
      echo "<td>" . htmlspecialchars($row['city']) . "</td>";
      echo "<td>" . htmlspecialchars($row['address']) . "</td>";
      echo "<td>" . htmlspecialchars($row['position']) . "</td>";
      echo "<td>" . nl2br(htmlspecialchars($row['additional_info'])) . "</td>";
      echo "</tr>";
    }
  } catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
?>