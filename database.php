<?php
include("connection.php");
//create an instance of Connection class

//call the createDatabase methods to create database "chap4Db";
$sql = "CREATE DATABASE chap4Db";

if (mysqli_query($conn, $sql)) {

echo "Database created successfully";

} else {

echo "Error creating database: " .
mysqli_error($conn);

}

$query = "CREATE TABLE Clients (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,firstname VARCHAR(30) NOT NULL,lastname VARCHAR(30) NOT NULL,email VARCHAR(50) UNIQUE,password VARCHAR(80),reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

//call the selectDatabase method to select the chap4Db
$sql = "SELECT id, firstname, lastname FROM clients";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
echo "id: " . $row["id"]. " - Name: " .$row["firstname"]. " " . $row["lastname"]."<br>";
}

} else {
echo "0 results";

}
//call the createTable method to create table with the $query
$query = "CREATE TABLE Clients (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,firstname VARCHAR(30) NOT NULL,lastname VARCHAR(30) NOT NULL,email VARCHAR(50) UNIQUE,password VARCHAR(80),reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMPON UPDATE CURRENT_TIMESTAMP)";
if (mysqli_query($conn, $query)) {
echo "Table Clients created successfully";
} else {
echo "Error creating table: " .mysqli_error($conn);
}
?>