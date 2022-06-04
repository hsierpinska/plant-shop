<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep roślinny</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   
</head>
<body>
<div id="start"></div>
<div id="header">
    <div id="logo">
        <a href="index.php"><img src="logo2.svg"></a>
    </div>
    
    <div id="menu">
            
            <?php
            if (isset($_SESSION['login'])) {

                echo <<< LOGIN
                <div class="login">Zalogowano jako $_SESSION[login]</div>
                <a href="logout.php" class='target'>Wyloguj się</a>
                LOGIN;
            } else {
                echo "<a href=\"login.php\" class='target'>Zaloguj się</a>";
            }
             ?>
            
            <a href="sklep.php" >Sklep roślinny</a>
            <a href="koszyk.php" class='target'>Koszyk</a>
            <a href="zamowienia.php" class='target'>Zamówienia</a>
            <?php
            if (isset($_SESSION['perm'])) {
                if (($_SESSION['perm'] == 1) || ($_SESSION['perm'] == 2)) {
                echo "<a href=\"users.php\">Użytkownicy</a></div>";
                }
            }
            ?>
            
    </div>
    
        
</div>





<div id="ph1">
    <div class="b"></div>
    <?php

    
    if (empty($_POST['login']) || empty($_POST['password'])) {
        header("location: ./login.php?msg=Uzupelnij");
        exit();
    } else {
        $_POST['login'] = trim($_POST['login']);
        $_POST['password'] = trim($_POST['password']);
        require_once("connect.php");
        $sql = "SELECT id, password, perm FROM `users` where username=\"{$_POST['login']}\";";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $pass = sha1($_POST['password']);
            if (($pass)==($row['password'])) {
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['perm'] = $row['perm'];
                $_SESSION['user_id'] = $row['id'];
                header("location: ./index.php");
            } else {
                header("location: ./login.php?msg=Nieprawidlowe");
                
                exit();
            }
            
        
        } else {
            header("location: ./login.php?msg=Nieprawidlowe");
            exit();
        }
    }
?>
    </div>
</div>

<footer>
    Autor: Helena Sierpińska
</footer>
<script src="scroll.js"></script>
<script src="scrollFade.js"></script>
<script src="zoom.js"></script>
</body>
</html>
