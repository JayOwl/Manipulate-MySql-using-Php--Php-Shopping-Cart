<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <link type="text/css" href="style.css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">

<h1>Delete Student</h1>

<?php

require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(mysqli_connect_errno() != 0){
    die("<p>Uh oh, could not connect to DB " . mysqli_connect_error() . "</p>");
}

if (isset($_GET["submit"])) {
    if(isset($_POST["confirm"]) && $_POST["confirm"] == "yes"){
        $primary_key = $_GET["primary_key"];
        $query = "DELETE FROM students WHERE primary_key = $primary_key;";
        $database->query($query);
        $message = "STUDENT DELETED!";
        if ($database->affected_rows > 0){
            $message = "STUDENT DELETION SUCCESSFUL!";
        } else {
            $message = "STUDENT DELETION FAILED!";
        }
    } else {
        $message = "STUDENT NOT DELETED.";
    }
    header("Location: php_lab06.php?message=$message");
}

if (isset($_GET["primary_key"])) {
    $primary_key = $_GET["primary_key"];
    $query = "SELECT * FROM students WHERE primary_key = $primary_key;";
    $results = $database->query($query);
    $record = $results->fetch_assoc();
    $id = $record['id'];
    $firstname = $record['firstname'];
    $lastname = $record['lastname'];

    echo "<p>Student ID: $id<br/>";
    echo "First Name: $firstname<br/>";
    echo "Last Name: $lastname</p>";
}

?>
    <form method="post" action="php_lab06_delete.php?submit=true&primary_key=<?php echo $primary_key ?>">
        <input type="radio" name="confirm" value="yes" id="yes">
        <label for="yes">Yes</label><br/>
        <input type="radio" name="confirm" value="no" id="no">
        <label for="no">No</label><br/>
        <input type="submit" value="submit" />
    </form>


</div>
</body>
</html>