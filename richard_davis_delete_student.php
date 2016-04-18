<?php
  // Richard Davis
  // CSCI4000
  // 17 April 2016
  // Assignment 4

  // connects to db
  require_once('richard_davis_database.php');

  // gets values from post array
  $student_id = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);

  // if the value is acceptable, creates PDO and executes query
  if ($student_id != false) {
    $query = 'DELETE FROM student
              WHERE studentID = :student_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':student_id', $student_id);
    $success = $statement->execute();
    $statement->closeCursor();
  }

  // redirects to index page
  include('index.php');
?>
