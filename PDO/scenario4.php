<?php
  $host = 'localhost';
  $user = "root";
  $password = "";
  $dbname = "PHPPDO";

  $dsn = "mysql:host=$host;
  dbname=$dbname";

  $conn = new PDO($dsn, $user, $password);

  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

  // 1. Insert a new timelog for an employee
  $employee_name = "Alice Smith";
  $log_date = date('Y-m-d');
  $log_time = date('H:i:s');
  $type = "IN";

  $insert = $conn->prepare("INSERT INTO timelogs (employee_name, log_date, log_time, type) VALUES (:employee_name, :log_date, :log_time, :type)");
  $insert->execute([
      'employee_name' => $employee_name,
      'log_date' => $log_date,
      'log_time' => $log_time,
      'type' => $type
  ]);
  echo "Inserted timelog for $employee_name.<br>";

  // 2. Retrieve all timelogs
  echo "<h3>All Timelogs:</h3>";
  $select = $conn->query("SELECT * FROM timelogs");
  $logs = $select->fetchAll();
  foreach ($logs as $log) {
      echo "ID: {$log->id} | Name: {$log->employee_name} | Date: {$log->log_date} | Time: {$log->log_time} | Type: {$log->type}<br>";
  }

  // 3. Change the log type (e.g., from 'IN' to 'OUT' for id=1)
  $update = $conn->prepare("UPDATE timelogs SET type = :type WHERE id = :id");
  $update->execute([
      'type' => 'OUT',
      'id' => 1
  ]);
  echo "<br>Changed log type to 'OUT' for ID 1.<br>";

  // 4. Delete a log entry (e.g., delete id=1)
  $delete = $conn->prepare("DELETE FROM timelogs WHERE id = :id");
  $delete->execute(['id' => 1]);
  echo "Deleted timelog with ID 1.<br>";
?>