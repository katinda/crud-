<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <?php require_once 'process.php';?>

    <?php
    
    if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        

        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>

    </div>
    <?php endif ?>
    <div class="contaire">
    <?php 
    
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
      die ("Erreur : " . $e->getMessage());
    }

    $result = $conn ->query("SELECT * FROM data") ;
    // pre_r($result);
    //pre_r($result->fetch_assoc()); // ça doit montrer le contenu dans le tableau

    ?>


    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
    <?php
        while ($row = $result->fetch()):
    ?>
            <tr>
                <td> <?php echo $row['name'];?></td>
                <td><?php echo $row['location'];?></td>
                <td>
                    <a href="indexBis.php?edit=<?php echo $row['id'];?>" 
                        class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id'];?>" 
                        class="btn btn-danger">delete</a>    
                </td>
            </tr>
        <?php endwhile;?>    
        </table>
    </div>

    <?php

    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    
    ?>
    <div classs="row justify-content-center">
    <form action="process.php" method="post">
        <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="Enter your name">
        </div>
        <div class="form-group">
        <label>Location</label>
        <input type="text" name="location" class="form-control" value="Enter your location">
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary" name="save">save</button>
        </div>
    </form>
    </div>
    </div>
</body>
</html>