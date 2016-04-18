<?php
  // Richard Davis
  // CSCI4000
  // 03 April 2016
  // Assignment 3

  // connects to db
  require_once('richard_davis_database.php');

?>
<!DOCTYPE html>
  <head>
    <meta charset="UTF-8">
    <title>Richard Davis' Kung Fu School</title>
    <link rel="stylesheet" type="text/css" href="main.css">
  </head>
  <body>
    <header>
      <h1>Richard Davis's Kung Fu School - Students<h1>
    </header>
    <section>
      <h3>Add Student</h3>
      <form action="richard_davis_add_student.php" method="post">
        <label>Name:</label>
        <input type="text" name="s_name"><br>
        <label>Email:</label>
        <input type="text" name="s_email"><br>
        <input type="submit" value="Add Student"><br>
      </form>
      <a href="index.php">View All Students</a>
    </section>
  </body>
</html>
