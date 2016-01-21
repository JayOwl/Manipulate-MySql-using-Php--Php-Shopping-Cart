<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link type="text/css" href="style.css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">

<h1>Add Student</h1>

<?php

$id = "";
$firstname = "";
$lastname = "";
$primary_key = "";

require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(mysqli_connect_errno() != 0){
    die("<p>Uh oh, could not connect to DB " . mysqli_connect_error() . "</p>");
}

if (isset($_GET["submit"])) {
    if ( empty($_POST["id"]) || empty($_POST["firstname"]) || empty($_POST["lastname"]) ){
        echo "<h3>Please complete all fields!</h3>";
    } else {
        $id = $_POST["id"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $query = "INSERT INTO students (id, firstname, lastname)
                  VALUES ('$id', '$firstname', '$lastname')";
        $database->query($query);
        if ($database->affected_rows > 0){
          $message = "DB UPDATE SUCCESSFUL!";
        } else {
            $message = "DB UPDATE FAILED!";
        }
        header("Location: php_lab06.php?message=$message");
    }
}


?>
    <form method="post" action="php_lab06_add.php?submit=true">
        <input type="text" id="id" name="id" value="<?php echo $id ?>"/>
        <label for="id"> : Student ID</label><br/>
        <input type="text" id="firstname" name="firstname" value="<?php echo $firstname ?>"/>
        <label for="firstname"> : First Name</label><br/>
        <input type="text" id="lastname" name="lastname" value="<?php echo $lastname ?>"/>
        <label for="lastname"> : Last Name</label><br/>
        <input type="submit" value="submit" />
    </form>


</div>
</body>
</html>