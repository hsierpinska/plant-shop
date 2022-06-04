<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie</title>
</head>
<body>
<?php
    require_once 'connect.php';
    if (isset($_POST['quantity'])) {
    $_POST['name'] = trim($_POST['name']);
    $_POST['price'] = trim($_POST['price']);
    $_POST['quantity'] = trim($_POST['quantity']);
    $_POST['image'] = trim($_POST['image']);
    $image = $_POST['image'].".png";

    $sql = "insert into plants (plant_name, price, quantity, image) values(\"{$_POST['name']}\", \"{$_POST['price']}\", \"{$_POST['quantity']}\", \"{$image}\");";
    $query = $connect->query($sql);
    if ($query) {echo "<script>alert(\"Dodano produkt\");</script>";}
    else {echo "<script>alert(\"Nie dodano produktu\");</script>";}
    }
    if (isset($_POST['password'])) {
        $_POST['name'] = trim($_POST['name']);
        $_POST['password'] = trim($_POST['password']);
        $password = sha1($_POST['password']);
        if (!isset($_POST['perm']) || ($_POST['perm'])==3) {
            $_POST['perm'] = 3;
        }
        $sql = "insert into users (username, password, perm) values(\"{$_POST['name']}\", \"{$password}\", \"{$_POST['perm']}\");";
        $query = $connect->query($sql);
        if ($query) {echo "<script>alert(\"Dodano użytkownika\");</script>";}
        else {echo "<script>alert(\"Nie dodano użytkownika\");</script>";
        echo $connect->error;
        }
    }
   
    ?>
    
    <script>
        history.back();
    </script>
</body>
</html>