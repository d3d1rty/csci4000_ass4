<?php
  // Richard Davis
  // CSCI4000
  // 03 April 2016
  // Assignment 3

  // connects to the db
  require_once('richard_davis_database.php');

  // gets values from post array
  $name = filter_input(INPUT_POST, 's_name');
  $email = filter_input(INPUT_POST, 's_email');

  // if values are valid, creates PDO, and executes query
  if ($name != false && $name != null && $email != false && $email != null) {
    $query = 'INSERT INTO students
                (name, email)
              VALUES
                (:name, :email)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $success = $statement->execute();
    $statement->closeCursor();
  }

  // redirects to index
  include('index.php');
?>
