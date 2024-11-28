<?php
class Client{
public $id;
public $firstname;
public $lastname;
public $email;
public $password;
public $reg_date;
public static $errorMsg = "";
public static $successMsg= "";

public function __construct($firstname,$lastname,$email,$password){
    //initialize the attributs of the class with the parameters, and hash the password
$password = password_hash("amine123456",PASSWORD_DEFAULT);
$sql = "INSERT INTO Clients (firstname,lastname, email,password) VALUES ('Amine', 'Ze','Amineze@gmail.com','$password')";
if (mysqli_query($conn, $sql)) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" .mysqli_error($conn);

}
}
public function insertClient($tableName,$conn){
//insert a client in the database, and give a message to $successMsg and $errorMsg
//code

}

//select a client by id, and return the row result
    public static function selectAllClients($tableName,$conn){
    //select all the client from database, and inset the rows results in an array $data[]
    $sql = "SELECT id, firstname, lastname,password FROM Clients WHERE email='amineze@gmail.com'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    echo  "pass: " . $row["password"]. " - Name: " .$row["firstname"]. " " . $row["lastname"]. "<br>";
    if(password_verify("amine123456", $row["password"])) {
    echo "valid";
    }else{
    echo "no";
    }
    }
    } else {
    echo "0 results";
    }
    
    }
    static function selectClientById($tableName,$conn,$id){
}
static function updateClient($client,$tableName,$conn,$id){
//update a client of $id, with the values of $client in parameter
//and send the user to read.php
$sql = "UPDATE Clients SET lastname='EL' WHERE id=2";

if (mysqli_query($conn, $sql)) {

echo "Record updated successfully";

} else {

echo "Error updating record: " .mysqli_error($conn);

}
}
static function deleteClient($tableName,$conn,$id){
//delet a client by his id, and send the user to read.php
$sql = "DELETE FROM Clients WHERE id=3";

if (mysqli_query($conn, $sql)) {

echo "Record deleted successfully";

} else {

echo "Error deleting record: " .mysqli_error($conn);

}
 }
}
?>