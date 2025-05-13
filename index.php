<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Introduction</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>Welcome to the Bee Kingdom!</header>
  <section>
    <h2>Php Basics</h2>
    <ul>
      <li>Syntax</li>
      <li>Comments</li>
      <li>Variable</li>
      <li>Echo</li>
      <li>Data Types</li>
      <li>String Concatenation</li>
    </ul>
  </section>
  <section>
    <h2>About Bees</h2>
    <?php
      // echo "Hello, World!";
      $beeCount = 10000; // declaring a variable stars with a $ sign
      $beeSpecies = 'Honey Bees';
      $greeting = 'Hello';
      $beeColor = 'yello, black, brown';
      $averageLifeSpan = 122.5;
      $isEndangered = true;

      // checking the data types
      var_dump($isEndangered);
      var_dump($averageLifeSpan);
      // var_dump($beeSpecies);

      $endangeredInfo = $isEndangered ? 'They are considered endangered' : 'They are considered endangered';

      $beeDescription = "Bees are insects with colors " .$beeColor . ".";
      $lifeSpanInfo = "On average the live up to $averageLifeSpan days";

      echo "<p>$beeDescription</p>";
      echo "<p>$lifeSpanInfo</p>";
      // concatenating .

      // echo "The bee count is " . $beeCount . " <br><br>";
      // echo "The specie is " . $beeSpecies . " <br>";

    ?>
  </section>
</body>
</html>