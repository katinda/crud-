<?php

session_start();

$servername = 'localhost';
$username = 'root';
$password = 'root';

//On essaie de se connecter
try{
    $conn = new PDO("mysql:host=$servername;dbname=crud", $username, $password);
    //On définit le mode d'erreur de PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}

/*On capture les exceptions si une exception est lancée et on affiche
 *les informations relatives à celle-ci*/
catch(PDOException $e){
  die("Erreur : " . $e->getMessage());
}

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $conn->query("INSERT INTO data (name,location) VALUES ('$name','$location')")  ;


    $_SESSION['message'] = "Record has been saved !";
    $_SESSION['msg_type'] = "success";

    header("location: indexBis.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM data  WHERE id=$id");

    $_SESSION['message'] = "Record has been deleted !";
    $_SESSION['msg_type'] = "danger";

    header("location: indexBis.php");
}


?>