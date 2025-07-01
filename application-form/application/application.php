<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application PHP</title>
  <link rel="stylesheet" href="../styles/applicationphp.css">
</head>
<body>
  <?php
  include "../database/applicationdb.php";

  function generateApplicationTextSummary() {
    $fields = [
      'First Name' => $_POST['first_name'] ?? '',
      'Last Name' => $_POST['last_name'] ?? '',
      'Email' => $_POST['email'] ?? '',
      'Phone' => $_POST['phone'] ?? '',
      'Position' => $_POST['position'] ?? '',
      'Country' => $_POST['country'] ?? '',
      'City' => $_POST['city'] ?? '',
      'Address' => $_POST['address'] ?? '',
      'Additional Information' => $_POST['additional_info'] ?? ''
    ];
    $output = "----- Application Summary -----\n";
    foreach ($fields as $label => $value) {
      $output .= $label . ": " . $value . "\n";
    }
    $output .= "------------------------------\n";
    $output .= "Thank you for your application, " . ($_POST['first_name'] ?? '') . "!\n";
    $output .= "We will review your application and get back to you soon.\n";
    $output .= "==============================\n\n";
    return $output;
  }

  function saveApplication($applicationData) {
    $filePath = __DIR__ . "../../application.txt";
    $file = fopen($filePath, "a") or die("Unable to open file at $filePath!");
    fwrite($file, $applicationData);
    fclose($file);
    echo "<p>Application saved to file successfully</p>";
  }

  function insertApplicationToDB($conn) {
    try {
      $sql = "INSERT INTO applicants 
        (first_name, last_name, email, phone, country, city, address, position, additional_info)
        VALUES (:first_name, :last_name, :email, :phone, :country, :city, :address, :position, :additional_info)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':email' => $_POST['email'],
        ':phone' => $_POST['phone'],
        ':country' => $_POST['country'],
        ':city' => $_POST['city'],
        ':address' => $_POST['address'],
        ':position' => $_POST['position'],
        ':additional_info' => $_POST['additional_info'] ?? ''
      ]);
      echo "<p>Application saved to database successfully</p>";
    } catch (PDOException $e) {
      echo "<p style='color:red;'>Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
  }

  function displayApplicationSummary() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $fields = [
        'Name' => htmlspecialchars($_POST['first_name']) . ' ' . htmlspecialchars($_POST['last_name']),
        'Email' => htmlspecialchars($_POST['email']),
        'Phone' => htmlspecialchars($_POST['phone']),
        'Position Applied For' => htmlspecialchars($_POST['position']),
        'Country' => htmlspecialchars($_POST['country']),
        'City' => htmlspecialchars($_POST['city']),
        'Address' => htmlspecialchars($_POST['address']),
        'Additional Information' => htmlspecialchars($_POST['additional_info'] ?? '')
      ];

      echo "<div class='summary'>";
      echo '<h2 style="text-align: center;">Application Summary</h2>';
      echo "<table class='app-summary-table' style='border-collapse:collapse; margin-top:1em; background:#fff; border-radius:8px; overflow:hidden; display: flex; align-items: center; justify-content: center;'>";
      foreach ($fields as $label => $value) {
        echo "<tr>
          <th style='text-align:left; padding:8px 16px; background:#f1f5f9; border-bottom:1px solid #e2e8f0; min-width:150px;'>$label</th>
          <td style='padding:8px 16px; border-bottom:1px solid #e2e8f0;'>$value</td>
        </tr>";
      }
      echo "</table>";
      echo "<div style='margin-top:1.5em; font-size:1.1em; color:black; text-align:center;'>";
      echo "Thank you for your application, <b>" . htmlspecialchars($_POST['first_name']) . "</b>!<br>";
      echo "We will review your application and get back to you soon.";
      echo "<form action='../pages/index.html'>
              <button type='submit' class='main-menu-btn'>Main Menu</button>
            </form>";
      echo "</div>";
      echo "</div>";

      // Save to text file
      $applicationData = generateApplicationTextSummary();
      echo "<div class='save-application'>";
      saveApplication($applicationData);
      echo "</div>";

      // Save to database
      try {
        global $db_host, $db_name, $db_username, $db_password;
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        insertApplicationToDB($conn);
      } catch (PDOException $e) {
        echo "<p style='color:red;'>Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
      }
    }
  }

  displayApplicationSummary();
  ?>
</body>
</html>