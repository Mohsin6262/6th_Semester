<?php
//step 1. Database Connection + Database Selection
//server name, user, user's password, and database
//must be provided.
$servername = "localhost";
$username = "root";
$password = "";
$database = "mohsinproject";

// Create Connection
$conn = new mysqli($servername, $username, $password, $database);

//step 2. Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP MySqli (Object-Oriented) Basics</title>
</head>
<body>
<?php
    // query code
    //step 3. Perform query or operation on database
    $sql = "SELECT id, name, email FROM users";
    $result = $conn->query($sql);

    //step 4. Show results
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    //step 5. Free result set
    $result->free();
?>
</body>
</html>

<?php
//step 6. Close Database Connection
$conn->close();
?>
