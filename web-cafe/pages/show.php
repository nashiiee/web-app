<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <h1 class="main-text-header"> ☕ Coffee Shop Order Form</h1>
    <table>
      <tr>
        <th>Order Id</th>
        <th>Name</th>
        <th>Coffee Type</th>
        <th>Size</th>
        <th>Total Price</th>
        <th>Instructions</th>
        <th>Extras</th>
      </tr>
      <?php include '../orders/show_orders.php'; ?>
    </table>
    <form action="index.html">
      <button type="submit">Main Menu</button>
    </form>
  </div>
</body>
</html>