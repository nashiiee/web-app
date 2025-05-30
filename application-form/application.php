<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application PHP</title>
  <link rel="stylesheet" href="styles/applicationphp.css">
</head>
<body>
  <?php
  function generateApplicationHtmlSummary() {
    $fields = [
      'First Name' => htmlspecialchars($_POST['first_name']),
      'Last Name' => htmlspecialchars($_POST['last_name']),
      'Email' => htmlspecialchars($_POST['email']),
      'Phone' => htmlspecialchars($_POST['phone']),
      'Position' => htmlspecialchars($_POST['position']),
      'Country' => htmlspecialchars($_POST['country']),
      'City' => htmlspecialchars($_POST['city']),
      'Address' => htmlspecialchars($_POST['address']),
      'Additional Information' => htmlspecialchars($_POST['additional_info'] ?? '')
    ];
    $output = "<table class='app-summary-table'>";
    foreach ($fields as $label => $value) {
      $output .= "<tr><th>$label</th><td>$value</td></tr>";
    }
    $output .= "</table>";
    return $output;
  }

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
    $filePath = __DIR__ . "/application.txt";
    $file = fopen($filePath, "a") or die("Unable to open file at $filePath!");
    fwrite($file, $applicationData);
    fclose($file);
    echo "<p>Application saved successfully</p>";
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
      echo "</div>";
      echo "</div>";

      $applicationData = generateApplicationTextSummary();
      echo "<div class='save-application'>";
      saveApplication($applicationData);
      echo "</div>";
    }
  }

  displayApplicationSummary();
  ?>
</body>
</html>