<?php
  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "PHPPDO";

  $dsn = "mysql:host=$host;
  dbname=$dbname";

  $conn = new PDO($dsn, $user, $password);

  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  // Inserting a new attendance record
  $student_name = "Jane Doe";
  $date = date('Y-m-d');
  $status = "Present";

  $insert = $conn->prepare("INSERT INTO attendance (student_name, date, status) VALUES (:student_name, :date, :status)");
  $insert->execute([
      'student_name' => $student_name,
      'date' => $date,
      'status' => $status
  ]);
  echo "Inserted attendance for $student_name.<br>";

  // 2. Retrieve and display all attendance records
  echo "<h3>All Attendance Records:</h3>";
  $select = $conn->query("SELECT * FROM attendance");
  $records = $select->fetchAll();
  foreach ($records as $record) {
      echo "ID: {$record->id} | Name: {$record->student_name} | Date: {$record->date} | Status: {$record->status}<br>";
  }

  // 3. Update an existing attendance entry (e.g., change status for id=1)
  $update = $conn->prepare("UPDATE attendance SET status = :status WHERE id = :id");
  $update->execute([
      'status' => 'Late',
      'id' => 11
  ]);
  echo "<br>Updated attendance status for ID 11.<br>";

  // 4. Delete a record from the attendance table (e.g., delete id=1)
  $delete = $conn->prepare("DELETE FROM attendance WHERE id = :id");
  $delete->execute(['id' => 11]);
  echo "Deleted attendance record with ID 11.<br>";
?>