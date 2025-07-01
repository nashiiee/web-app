<?php
  if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    include '../database/database.php';

    try {
      $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $food = htmlspecialchars($_POST['food'] ?? '');
      $staff = htmlspecialchars($_POST['staff'] ?? '');
      $speed = htmlspecialchars($_POST['speed'] ?? '');
      $service = htmlspecialchars($_POST['service'] ?? '');
      $comments = htmlspecialchars($_POST['comments'] ?? '');

      if (!$food || !$staff || !$speed || !$service) {
        die("Please complete all required feedback fields.");
      }

      $sql = "INSERT INTO feedback_responses (food, staff, speed, service, comments, submitted_at)
        VALUES (:food, :staff, :speed, :service, :comments, NOW())";
      $stmt = $conn->prepare($sql);
      $stmt->execute([
        ':food' => $food,
        ':staff' => $staff,
        ':speed' => $speed,
        ':service' => $service,
        ':comments' => $comments
      ]);

      echo "<div style='text-align:center; padding:2rem;'>";
      echo "<h2>🎉 Feedback Submitted Successfully!</h2>";
      echo "<ul style='list-style:none;'>";
      echo "<li><strong>Food:</strong> $food</li>";
      echo "<li><strong>Staff:</strong> $staff</li>";
      echo "<li><strong>Speed:</strong> $speed</li>";
      echo "<li><strong>Service:</strong> $service</li>";
      echo "<li><strong>Comments:</strong> $comments</li>";
      echo "</ul>";
      echo "<br><a href='../pages/show.php'><button>Back to Feedback Records</button></a>";
      echo "</div>";


    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
  }
?>