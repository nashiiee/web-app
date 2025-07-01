<?php
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    include '../database/database.php'; // Make sure this file defines $db_host, $db_name, $db_username, $db_password

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sanitize inputs
        $nickname = htmlspecialchars($_POST['nickname'] ?? 'Anonymous');
        $food     = htmlspecialchars($_POST['food'] ?? '');
        $staff    = htmlspecialchars($_POST['staff'] ?? '');
        $speed    = htmlspecialchars($_POST['speed'] ?? '');
        $service  = htmlspecialchars($_POST['service'] ?? '');
        $comments = htmlspecialchars($_POST['comments'] ?? '');

        // Insert into DB
        $sql = "INSERT INTO feedbacks (nickname, food, staff, speed, service, comments, submitted_at)
                VALUES (:nickname, :food, :staff, :speed, :service, :comments, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nickname' => $nickname,
            ':food'     => $food,
            ':staff'    => $staff,
            ':speed'    => $speed,
            ':service'  => $service,
            ':comments' => $comments
        ]);

        echo "<div style='text-align:center; padding:2rem;'>";
        echo "<h2>🎉 Feedback Submitted Successfully!</h2>";
        echo "<ul style='list-style:none;'>";
        echo "<li><strong>Nickname:</strong> $nickname</li>";
        echo "<li><strong>Food:</strong> $food</li>";
        echo "<li><strong>Staff:</strong> $staff</li>";
        echo "<li><strong>Speed:</strong> $speed</li>";
        echo "<li><strong>Service:</strong> $service</li>";
        echo "<li><strong>Comments:</strong> $comments</li>";
        echo "</ul>";
        echo "<br><a href='../pages/show.php'><button>Back to Feedback Records</button></a>";
        echo "</div>";

    } catch (PDOException $e) {
        echo "<div style='color:red;'>Database error: " . $e->getMessage() . "</div>";
    }
}
?>
