<?php
include '../database/database.php';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM feedbacks ORDER BY submitted_at DESC");
    $stmt->execute();

    $feedbacks = $stmt->fetchAll();

    foreach ($feedbacks as $feedback) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($feedback['id']) . "</td>";
        echo "<td>" . htmlspecialchars($feedback['nickname']) . "</td>";
        echo "<td>" . htmlspecialchars($feedback['food']) . "</td>";
        echo "<td>" . htmlspecialchars($feedback['staff']) . "</td>";
        echo "<td>" . htmlspecialchars($feedback['speed']) . "</td>";
        echo "<td>" . htmlspecialchars($feedback['service']) . "</td>";
        echo "<td>" . htmlspecialchars($feedback['comments']) . "</td>";
        echo "<td>" . htmlspecialchars($feedback['submitted_at']) . "</td>";
        echo "</tr>";
    }

} catch (PDOException $e) {
    echo "<tr><td colspan='8'>Database error: " . $e->getMessage() . "</td></tr>";
}
?>
