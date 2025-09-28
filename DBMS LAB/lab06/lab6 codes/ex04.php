<?php 
$username = 'root'; 
$password = ''; 

try {
    // Ensure the correct database name is used here
    $str = 'mysql:host=localhost;dbname=mohsin_db;charset=utf8'; 
    $db = new PDO($str, $username, $password);  
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    echo "Connected successfully<br><br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html> 
<html> 
<head> 
    <title>Php-PDO Basics</title> 
</head> 
<body> 

<?php 
try {
    $q = $db->prepare("SELECT * FROM department"); 
    $q->execute(); 
    echo "Table: Department";
    $q_records = $q->fetchAll(); 
    foreach ($q_records as $row) { 
        echo $row["departmentID"] . " - " . $row["name"] . "<br>"; 
    } 
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?> 

</body> 
</html> 

<?php 
$db = null; 
?>
