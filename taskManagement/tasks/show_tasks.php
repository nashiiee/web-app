
<?php
include 'base.php';
include "../database/database.php";

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM tasks");

    $stmt->execute();

    // Fetch all the orders
    $tasks = $stmt->fetchAll();

    // Display each order as a table row
    foreach ($tasks as $task) {
        echo "<tr>";
        echo "<td>" . $task['id'] . "</td>";
        echo "<td>" . $task['title'] . "</td>";
        echo "<td>" . $task['description'] . "</td>";
        echo "<td>" . $task['due_date'] . "</td>";
        echo "<td>" . $task['priority'] . "</td>";
        echo "<td>" . $task['status'] . "</td>";
        echo "
          <td>
            <a href='../tasks/update.php?id=" . $task['id'] . "' style=' 
            background-color: #48cae4;
            color: #fff;
            border: none;
            padding: 0.2em 0.5em;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-right: 0.5em;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s, transform 0.2s;'>
              Update</a>
            <form method='POST' action='../tasks/delete.php' style='display:inline;'>
              <input type='hidden' name='id' value='" . $task['id'] . "'>
              <button type='submit' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this task?');\">Delete</button>
            </form>
          </td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>