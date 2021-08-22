<?php
try {
$server = 'localhost';
$user = 'root';
$password= '';
$db = 'usersignup0';

$conn = new PDO("mysql:host=$server; dbname=$db",$user, $password);

}catch(PDOException $e){
    
    

    echo "Error " .$e->getMessage();
}


?>