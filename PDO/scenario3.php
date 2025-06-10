<?php
  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "PHPPDO";

  $dsn = "mysql:host=$host;
  dbname=$dbname";

  $conn = new PDO($dsn, $user, $password);

  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  // Inserting a new movies
  $title = "Cars";
  $director = "John Lasseter";
  $release_year = 2006;
  $available = TRUE;

  $insert = $conn->prepare("INSERT INTO movies (title, director, release_year, available) VALUES(:title, :director, :release_year, :available)");
  $insert->execute([
    'title' => $title,
    'director' => $director,
    'release_year' => $release_year,
    'available' => $available
  ]);

  echo "Movies inserted succesfully";

  // Retrieve all movies and show their availability
  echo "<h3>All Movies Available:</h3>";
  $select = $conn->query("SELECT * FROM movies");
  $movies = $select->fetchAll();
  foreach ($movies as $movie) {
      $isAvailable = $movie->available ? "Available" : "Not Available";
      echo "ID: {$movie->id} | Title: {$movie->title} | Director: {$movie->director} | Year: {$movie->release_year} | Status: {$isAvailable}<br>";
  }

  // Update the availability of a movie.
  $update = $conn->prepare("UPDATE movies SET available = :available WHERE title = :title");
  $update->execute([
      'available' => 0, // 0 for Not Available, 1 for Available
      'title' => 'Cars'
  ]);
  echo "Availability of all 'Cars' movies updated.<br><br>";

  // Delete a movie from the database.
  $delete = $conn->prepare("DELETE FROM movies WHERE title = :title");
  $delete->execute(['title' => 'Cars']);
  echo "All movies with the title 'Cars' have been deleted.<br>";
?>  