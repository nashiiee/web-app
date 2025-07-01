<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Applicants</title>
</head>
<body>
  <div class="container">
    <?php
      include "../database/applicationdb.php";

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['applicant_id']) && !empty($_POST['applicant_id'])) {
          $applicantID = $_POST['applicant_id'];
          $firstName = $_POST['first_name'] ?? '';
          $lastName = $_POST['last_name'] ?? '';
          $email = $_POST['email'] ?? '';
          $phone = $_POST['phone'] ?? '';
          $country = $_POST['country'] ?? '';
          $city = $_POST['city'] ?? '';
          $address = $_POST['address'] ?? '';
          $position = $_POST['position'] ?? '';
          $additionalInfo = $_POST['additional_info'] ?? '';

          try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE applicants SET first_name=:first_name, last_name=:last_name, email=:email, phone=:phone, country=:country, city=:city, address=:address, position=:position, additional_info=:additional_info WHERE applicant_id=:applicant_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
              ':first_name' => $firstName,
              ':last_name' => $lastName,
              ':email' => $email,
              ':phone' => $phone,
              ':country' => $country,
              ':city' => $city,
              ':address' => $address,
              ':position' => $position,
              ':additional_info' => $additionalInfo,
              ':applicant_id' => $applicantID
            ]);

            echo "<p>Applicant updated successfully!</p>";
          } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
          }
        } else {
          echo "Please provide a valid applicant ID.";
        }
      }
    ?>
  </div>
</body>
</html>