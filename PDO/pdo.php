<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  // print_r(PDO::getAvailableDrivers());
  
  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "Midterm_Act1";

  // data source name
  $dsn = "mysql:host=$host;
  dbname=$dbname";

  $conn = new PDO($dsn, $user, $password);

  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Select query
  // $statement = $conn->query("SELECT * FROM Student");

  // FETCH_ASSOC
  // $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
  // for ($i = 0; $i < count($rows); $i++) {
  //   echo $rows[$i]['ID'] . "." . " " . $rows[$i]['Name'] . " " . "<br/>" . "Date Of Birth: " . $rows[$i]['DateOfBirth'] . "<br/><br/>";
  // }

  // FETCH_OBJ
  // $rows = $statement->fetchAll();
  // for ($i = 0; $i < count($rows); $i++) {
  //   echo $i . ". " .$rows[$i]->Name . "<br/>" .$rows[$i]->Address . "<br/><br/>";
  // }

  // positional parameters
  // $Id = '2';
  // $sql = "SELECT * FROM Student WHERE ID = ?";
  // $statement=$conn->prepare($sql);
  // $statement->execute([$Id]);
  // $users = $statement-> fetchAll();

  // foreach($users as $user) {
  //   echo $user->Name . "<br/>" . $user->Address . " " . $user->DateOfBirth . "<br/><br/>";
  // }

  // named parameter
  // $Name = 'Nash Claracay';
  // $sql = "SELECT * FROM Student WHERE Name = :Name";
  // $statement = $conn->prepare($sql);
  // $statement->execute(["Name" => $Name]);
  // $users = $statement->fetchAll();

  // foreach($users as $user) {
  //   echo $user->Name . "<br/>" . $user->Address . " " . $user->DateOfBirth . "<br/><br/>";
  // }

  // $id = 10;
  // $sql = "SELECT * FROM Student WHERE ID = :ID";
  // $statement=$conn->prepare($sql);
  // $statement->execute(['ID' => $id]);
  // $users=$statement->fetchAll();

  // foreach($users as $user) {
  //   echo $user->Name . "<br/>" . $user->Address . " " . $user->DateOfBirth . "<br/><br/>";
  // }

  // $name = "Jane Doe";
  // $address = "123 Main St";
  // $dateOfBirth = "2000-01-01";

  // // Prepare the INSERT statement
  // $sql = "INSERT INTO Student (Name, Address, DateOfBirth) VALUES (:Name, :Address, :DateOfBirth)";
  // $statement = $conn->prepare($sql);

  // $statement->execute([
  //   'Name' => $name,
  //   'Address' => $address,
  //   'DateOfBirth' => $dateOfBirth,
  // ]);

  // $select = $conn->query("SELECT * FROM Student");
  // $students = $select->fetchAll();

  // foreach ($students as $student) {
  //     echo $student->Name . " | " . $student->Address . " | " . $student->DateOfBirth . "<br/>";
  // }

  // echo "Student inserted successfully.<br/>";

  $id = 17;
  $first_name = "Jane Doe";
  $sql = "DELETE FROM Student WHERE ID=? AND Name=?";
  $statement=$conn->prepare($sql);
  $statement->execute([$id, $first_name]);
  echo $statement->rowCount();

?>