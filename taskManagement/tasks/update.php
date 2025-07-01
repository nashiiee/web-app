<?php
include "../database/database.php";

$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle update
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET title = :title, description = :description, due_date = :due_date, priority = :priority, status = :status WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':due_date' => $due_date,
        ':priority' => $priority,
        ':status' => $status,
        ':id' => $id
    ]);

    header("Location: ../pages/show.php");
    exit();
} else if (isset($_GET['id'])) {
    // Fetch current task data
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($task) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Task</title>
            <link rel="stylesheet" href="../css/styles.css">
            <style>
              .insert-form {
                margin-top: 1rem;
              }
            </style>
        </head>
        <body>
        <div class="container">
            <h1 class="main-text-header">Update Task</h1>
            <form method="POST" action="update.php" class="insert-form">
                <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
                <label for="title">Task Title:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required><?= htmlspecialchars($task['description']) ?></textarea>
                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" value="<?= htmlspecialchars($task['due_date']) ?>" required>
                <label for="priority">Priority:</label>
                <select id="priority" name="priority" required>
                    <option value="Low" <?= $task['priority'] === 'Low' ? 'selected' : '' ?>>Low</option>
                    <option value="Normal" <?= $task['priority'] === 'Normal' ? 'selected' : '' ?>>Normal</option>
                    <option value="High" <?= $task['priority'] === 'High' ? 'selected' : '' ?>>High</option>
                </select>
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Pending" <?= $task['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="In Progress" <?= $task['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="Completed" <?= $task['status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
                </select>
                <button type="submit" class="add-btn">Update Task</button>
            </form>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "Task not found.";
    }
} else {
    echo "No task ID specified.";
}
?>