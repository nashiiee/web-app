<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/web-app-2433/taskManagement/tasks/retrieve.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔎 Retrieve Task</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <?php
        include "../database/database.php";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $taskID = $_POST["task_id"];

            try {
                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
                $stmt->bindParam(':id', $taskID, PDO::PARAM_INT);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    echo "<h1>🔎 Task Details</h1>";
                    echo "<table>";
                    echo "<tr><td><strong>Task ID</strong></td><td>" . htmlspecialchars($result['id']) . "</td></tr>";
                    echo "<tr><td><strong>Title</strong></td><td>" . htmlspecialchars($result['title']) . "</td></tr>";
                    echo "<tr><td><strong>Description</strong></td><td>" . htmlspecialchars($result['description']) . "</td></tr>";
                    echo "<tr><td><strong>Due Date</strong></td><td>" . htmlspecialchars($result['due_date']) . "</td></tr>";
                    echo "<tr><td><strong>Priority</strong></td><td>" . htmlspecialchars($result['priority']) . "</td></tr>";
                    echo "<tr><td><strong>Status</strong></td><td>" . htmlspecialchars($result['status']) . "</td></tr>";
                    echo "</table>";
                } else {
                    echo "Task not found. Please check the Task ID and try again.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>

        <br />

        <form action="../pages/retrieve.html">
            <button type="submit">Back</button>
        </form>     
    </div>
</body>
</html>