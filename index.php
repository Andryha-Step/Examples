<?php

function printWords($result_set){
    echo "<br/>";
    $i = ["name", "lastName"];
    while($txt = $result_set->fetch_assoc())
    {
        echo "Name of user: " . $txt[$i[0]] . " and lastName: " . $txt[$i[1]];
        echo "<br />";
    }
}
function enterNewUser(){
    global $mysqli;
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $lastName = htmlspecialchars($_POST['lastName']);
    if($id != null){
        $mysqli -> query("INSERT INTO `testtable` (`id`, `name`, `lastName`) VALUES ('$id', '$name', '$lastName')");
    } else {
        $mysqli -> query("INSERT INTO `testtable` (`name`, `lastName`) VALUES ('$name', '$lastName')");
    }
}
function deleteInfo(){
    global $mysqli;
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $lastname = htmlspecialchars($_POST['lastName']);
    if($name != null){
        $mysqli -> query("DELETE FROM `testtable` WHERE `name` = '$name'");
    }else if ($id != null){
        $mysqli -> query("DELETE FROM `testtable` WHERE `id` = '$id'");
    }
}
    $mysqli = new mysqli ("localhost", "root", "", "testbase");   
    $mysqli -> query("SET NAMES 'utf-8'");
    $result_set = $mysqli -> query ("SELECT * FROM `testtable`");
    
    print_r($result_set); 

    printWords($result_set);

    if(isset($_POST['subm'])){
    enterNewUser();
    } else if (isset($_POST['delSubm'])){
        deleteInfo();
    }

    $mysqli -> close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<hr>
<form action="" method="POST">
<label>Name new user:</label>
<input type="text" name="name"><br><br>
<label>LastName new user</label>
<input type="text" name="lastName"><br><br>
<label>Enter user's id</label>
<input type="text" name="id"><br><hr>
<input type="submit" name="subm" value="Add this user">
<input type="submit" name="delSubm" value="Delete this user">
</form>
</body>
</html>