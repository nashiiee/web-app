<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applicants</title>
  <link rel="stylesheet" href="../styles/show_applicants.css">
</head>
<body>
  <div class="container">
    <h1 class="main-text-header">Applicants</h1>
    <p class="sub-description">
      Below is a list of all job applicants and their submitted details.<br>
      You can review each application, including the applicant’s name, contact information, address, position applied for, and additional information.
    </p>
    <table>
      <tr>
        <th>Applicant ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Country</th>
        <th>City</th>
        <th>Address</th>
        <th>Position</th>
        <th>Additional Info</th>
      </tr>
      <?php include '../application/show_applicants.php'; ?>
    </table>
    <form action="index.html">
      <button type="submit" class="main-menu-btn">Main Menu</button>
    </form>
  </div>
</body>
</html>