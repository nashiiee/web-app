<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="table-container">
    <h1 class="main-text-header show-tasks">Show Tasks</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Task</th>
          <th>Description</th>
          <th>Due Date</th>
          <th>Priority</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <?php include '../tasks/show_tasks.php'; ?>
    </table>
    <br />
    <form action="index.html">
        <button type="submit" class="main-menu-button">Main Menu</button>
    </form>
  </div>  
</body>
</html>