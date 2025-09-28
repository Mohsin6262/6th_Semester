<?php 
// Step 1: Database Connection
$db = mysqli_connect("localhost", "root", "", "mohsin_db");

// Step 2: Check Connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit(); // Stop script if connection fails
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP MySQLi (Procedural) Basics</title>
</head>
<body>

<?php 
// Step 3: Perform query or operation on database
$sql = "SELECT * FROM department";
$result = mysqli_query($db, $sql);

// Step 4: Show result
if ($result) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo $row["departmentID"] . " " . $row["name"] . "<br/>";
    }

    // Step 5: Free result set
    mysqli_free_result($result);
} else {
    echo "Query failed: " . mysqli_error($db);
}
?>

</body>
</html>

<?php 
// Step 6: Close Database Connection
mysqli_close($db);
?>
