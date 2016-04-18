<?php
  // Richard Davis
  // CSCI4000
  // 17 April 2016
  // Assignment 4

  // connects db
  require_once('richard_davis_database.php');

  function get_majors() {
    global $db;
    // sets query to show all records in table
    $query = "SELECT * FROM major";
    // prepares query for execution creating PDO
    $statement = $db->prepare($query);
    // executes prepared statement
    $statement->execute();
    // returns an array for all the records in the query
    $majors = $statement->fetchAll();
    // frees connection so other sql statements can be executed
    $statement->closeCursor();
    return $majors;
  }

  function get_major_name($majorID) {
    global $db;
    $query = 'SELECT * FROM major
              WHERE majorID = :majorID';
    $statement = $db->prepare($query);
    $statement->bindValue(':majorID', $majorID);
    $statement->execute();
    $major = $statement->fetch();
    $statement->closeCursor();
    $major_name = $major['majorName'];
    return $major_name;
  }

  function get_students($majorID) {
    global $db;
    // sets query to show all records in table
    $query = "SELECT * FROM student WHERE majorID = :majorID";
    // prepares query for execution creating PDO
    $statement = $db->prepare($query);
    $statement->bindValue(':majorID', $majorID);
    // executes prepared statement
    $statement->execute();
    // returns an array for all the records in the query
    $students = $statement->fetchAll();
    // frees connection so other sql statements can be executed
    $statement->closeCursor();
    return $students;
  }

  $majors = get_majors();

  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
      $action = 'list_students';
    }
  }

  if ($action == 'list_students') {
    $major_id = filter_input(INPUT_GET, 'major_id', FILTER_VALIDATE_INT);
    if ($major_id == NULL || $major_id == FALSE) {
      $major_id = 1;
    }
    $major_name = get_major_name($major_id);
    $students = get_students($major_id);
  }

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
    <section id="main">
      <h2>Student List</h2>
      <nav>
        <h3>Majors</h3>
        <ul>
<?php foreach ($majors as $m) { ?>
        <li><a href="?major_id=<?php echo $m['majorID']; ?>"><?php echo $m['majorName']; ?></a></li>
<?php } ?>
        </ul>
      </nav>
      <section id="display">
      <h3><?php echo $major_name ?></h3>
        <table>
          <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th></th>
          </tr>
<!-- iterates through student table, printing rows in tabular format -->
<?php foreach ($students as $s) { ?>
          <tr>
            <td class="s_id"><? echo $s['studentID']; ?></td>
            <td class="s_fname"><? echo $s['firstName']; ?></td>
            <td class="s_lname"><? echo $s['lastName']; ?></td>
            <td class="s_gender"><? echo $s['gender']; ?></td>
            <td>
              <form action="richard_davis_delete_student.php" method="post">
                <input type="hidden" name="student_id" value="<?php echo $s['studentID']; ?>">
                <input class="s_delete" type="submit" value="Delete">
              </form>
            </td>
<?php } ?>
        </table>
        <br>
        <a href="richard_davis_add_student_form.php">Add Student</a>
      </section>
    </section>
    <footer>
    <p>&copy; <?php echo date("Y"); ?> Richard Davis Kung Fu School</p>
    </footer>
  </body>
</html>
