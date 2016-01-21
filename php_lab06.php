<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link type="text/css" href="style.css" rel="stylesheet" />
</head>
<body>
<div id="wrapper">

<h1>Students</h1>

<?php
$counter = 1;

require_once("dbinfo.php");
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(mysqli_connect_errno() != 0){
    die("<p>Uh oh, could not connect to DB " . mysqli_connect_error() . "</p>");
}

$query = "SELECT * FROM students;";
$results = $database->query($query);

if (isset($_GET["message"])){
    echo "<h3>".$_GET["message"]."</h3>";
}

echo "<table>";
echo "<tr>";
echo "<th>Key</th>";
echo "<th>ID</th>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th colspan='2' class='center'><a href='php_lab06_add.php'>Add Student</a></th>";
echo "</tr>";
while($record = $results->fetch_assoc()){
    if ($counter++ %2 == 0){
        echo "<tr class='styled'>";
    } else {
        echo "<tr>";
    }
    echo "<td>".$record['primary_key']."</td>";
    echo "<td>".$record['id']."</td>";
    echo "<td>".$record['firstname']."</td>";
    echo "<td>".$record['lastname']."</td>";
    echo "<td><a href='php_lab06_delete.php?primary_key=".$record['primary_key']."'>delete</a></td>";
    echo "<td><a href='php_lab06_update.php?primary_key=".$record['primary_key']."'>update</a></td>";
    echo "</tr>";
}
echo "</table>";

?>
</div>
</body>
</html>
