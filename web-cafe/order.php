<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php 
    function displayOrderSummary() {
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo "<div class='summary'>";
        echo '<h2>Order Summary</h2>';

        $coffee_prices = [
          "espresso" => 250,
          "latte" => 300,
          "cappuccino" => 350,
          "americano" => 200,
          "mocha" => 400
        ];

        $size_prices = [
          "small" => 0.00,
          "medium" => 50.0,
          "large" => 80.0
        ];

        $extras_prices = [
          "sugar" => 5.75,
          "cream" => 10.50
        ];

        $name = htmlspecialchars($_POST['name']);
        $coffeeType = htmlspecialchars($_POST['coffee']);
        $size = htmlspecialchars($_POST['size']);
        $instructions = htmlspecialchars($_POST['instructions']);
        $extras = isset($_POST['extras']) ? $_POST['extras'] : [];

        $total_price = $coffee_prices[$coffeeType] + $size_prices[$size];

        foreach($extras as $extra) {
          $total_price += $extras_prices[$extra];
        }

        echo $name;
        echo "<br>";
        echo $coffeeType;
        echo "<br>";
        echo $size;


        if(!empty($extras)) {
          echo "<br>Extras: " . implode(", ", $extras);
        } else {
          echo "<br>No extras selected.";
        }
        echo "<br>";

        echo $total_price;
        echo "<br>";
        echo "Special Instructions: " . $instructions;
    
        echo displayPassword($total_price);
        
        $receiptContent = generateReceiptContent($name, $coffeeType, $size, $extras, $total_price, $instructions);
        echo "<pre>$receiptContent</pre>";
        echo saveReceipt($receiptContent);
        echo "</div>";
      }
    }

    function displayPassword($total_price) {
      if ($total_price>250 && $total_price<350) {
        echo "<p>Password is 12345</p>";
      } elseif($total_price >= 350) {
        echo "<p>You get a free donut!</p>";
      }
    }

    function generateReceiptContent($name, $coffeeType, $size, $extras, $total_price, $instructions) {
      $receiptContent = "Order Summary\n";
      $receiptContent .= "-----------------\n";
      $receiptContent .= "Name: " . $name . "\n";
      $receiptContent .= "Coffee Type: " . $coffeeType . "\n";
      $receiptContent .= "Size: " . $size . "\n";
      $receiptContent .= "Extras: " . implode(", ", $extras) . "\n";
      $receiptContent .= "Total Price: " . $total_price . "\n";
      $receiptContent .= "Special Instructions: " . $instructions . "\n";
      $receiptContent .= "-----------------\n";
      $receiptContent .= "Thank you for your order!\n";
      $receiptContent .= "-----------------\n";
      return $receiptContent;
    }

    function saveReceipt($receiptContent) {
      $filePath = __DIR__ . "/OrderSummary.txt";
      $file = fopen($filePath, "w") or die("Unable to open file at $filePath!");
      fwrite($file, $receiptContent);
      fclose($file);
      echo "<p>Receipt saved successfully</p>";
    }

    displayOrderSummary();
  ?>
</body>
</html>