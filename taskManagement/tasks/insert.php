<?php 
// filepath: /Applications/XAMPP/xamppfiles/htdocs/web-app-2433/taskManagement/tasks/insert.php
include 'base.php'; 
include "../database/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Added</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
      .summary-container {
        max-width: 400px;
        margin: 3em auto 1.5em auto;
        background: #f8fdff;
        border-radius: 14px;
        box-shadow: 0 4px 18px #0001;
        padding: 2em 2em 1.5em 2em;
        text-align: center;
      }
      .summary h2 {
        color: #0077b6;
        margin-bottom: 1em;
      }
      .summary ul {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5em 0;
        text-align: left;
      }
      .summary li {
        margin-bottom: 0.7em;
        font-size: 1.08em;
      }
      .back-btn {
        background: #0077b6;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.7em 2em;
        font-size: 1em;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
      }
      .back-btn:hover {
        background: #00b4d8;
        transform: scale(1.04);
      }
    </style>
</head>
<body>
  <div class="summary-container">
    <?php
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);
            $due_date = htmlspecialchars($_POST['due_date']);
            $priority = htmlspecialchars($_POST['priority']);
            $status = htmlspecialchars($_POST['status']);

            $sql = "INSERT INTO tasks (title, description, due_date, priority, status)
                    VALUES (:title, :description, :due_date, :priority, :status)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':due_date' => $due_date,
                ':priority' => $priority,
                ':status' => $status
            ]);

            echo "<div class='summary'>";
            echo "<h2>Task Added Successfully!</h2>";
            echo "<ul>";
            echo "<li><strong>Title:</strong> $title</li>";
            echo "<li><strong>Description:</strong> $description</li>";
            echo "<li><strong>Due Date:</strong> $due_date</li>";
            echo "<li><strong>Priority:</strong> $priority</li>";
            echo "<li><strong>Status:</strong> $status</li>";
            echo "</ul>";
            echo "</div>";

        } catch (PDOException $e) {
            echo "<div class='summary'>";
            echo "Database error: " . $e->getMessage();
            echo "</div>";
        }
    }
    ?>
    <form action="../pages/show.php">
      <button type="submit" class="back-btn">Back</button>
    </form>
  </div>
</body>
</html>