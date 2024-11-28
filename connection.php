<?php
class Connection{
private $servername=;
private $username=;
private $password=;
public $conn;
public function __construct(){
    // Create connection
$conn = mysqli_connect($servername, $username,$password);
    // Check connection
if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
    }
    echo "Connected successfully";
}
function createDatabase($dbName){
//creating a database with the conn in the class ($this->conn)
$sql = "CREATE DATABASE dbName";
if (mysqli_query($conn, $sql)) {
echo "Database created successfully";
} else {
echo "Error creating database: " .mysqli_error($conn);
}
}
function selectDatabase($dbName){
    //select database with the conn of the class, using mysqli_select..
    //code
}
function createTable($query){

  //creating a table with the query
 $query = "CREATE TABLE Clients (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, email VARCHAR(50) UNIQUE,password VARCHAR(80),reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

if (mysqli_query($conn, $query)) {

echo "Table Clients created successfully";

} else {

echo "Error creating table: ".mysqli_error($conn);
}
}
}
?>