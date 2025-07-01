<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Feedback Records</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h1 class="main-text-header">📋 Submitted Feedback</h1>

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nickname</th>
            <th>Food</th>
            <th>Staff</th>
            <th>Speed</th>
            <th>Service</th>
            <th>Comments</th>
            <th>Date Submitted</th>
          </tr>
        </thead>
        <tbody>
          <?php include '../feedbacks-backend/show_feedback.php'; ?>
        </tbody>
      </table>
    </div>

    <form action="./index.html" style="margin-top: 2rem;">
      <button type="submit">Back to Main Menu</button>
    </form>
  </div>
</body>
</html>
