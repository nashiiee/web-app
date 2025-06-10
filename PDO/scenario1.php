<?php
  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "PHPPDO";

  $dsn = "mysql:host=$host;
  dbname=$dbname";

  $conn = new PDO($dsn, $user, $password);

  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  // Inserting a new book
  $title = "Atomic Habits";
  $author = "James Clear";
  $year = 2018;
  $genre = "Self-Help Book";

  $sql = "INSERT INTO books (title, author, published_year, genre) VALUES (:title, :author, :published_year, :genre)";
  $statement = $conn->prepare($sql);
  $statement->execute([
      'title' => $title,
      'author' => $author,
      'published_year' => $year,
      'genre' => $genre
  ]);
  echo "Book inserted successfully.";

  // SELECT all books
  $select = $conn->query("SELECT * FROM books");
  $books = $select->fetchAll();
  echo "<b>All Books:</b><br>";
  foreach ($books as $book) {
      echo "ID: {$book->id} | Title: {$book->title} | Author: {$book->author} | Year: {$book->published_year} | Genre: {$book->genre}<br>";
  }
  echo "<br>";

  // UPDATE a book (change the genre of the book with id=1)
  $update = $conn->prepare("UPDATE books SET genre = :genre WHERE id = :id");
  $update->execute([
      'genre' => 'Fiction',
      'id' => 21
  ]);
  echo "Book with ID 11 updated.<br><br>";

  // DELETE a book (remove the book with id=1)
  $delete = $conn->prepare("DELETE FROM books WHERE id = :id");
  $delete->execute(['id' => 22]);
  echo "Book with ID 11 deleted.<br>";
?>