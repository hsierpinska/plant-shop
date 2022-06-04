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
            
    </div>
    
    
        
</div>



<div id="ph1">
    <div class="b"></div>
    <div class="login-show">
        <form method = "post" action="login-page.php">
        <h2>Logowanie</h2>
        
        <br>
        <input type="text" placeholder="Login" name="login"><br><br>
        <input type="password" placeholder="Hasło" name="password"><br><br>
        Nie masz konta? <a href='add_user.php'>Dodaj użytkownika</a><br>
        <?php 
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == "Uzupelnij") {
                    echo "Uzupełnij obydwa pola"; 
                }
            
                elseif ($_GET['msg'] == "Nieprawidlowe") {
                    echo "Nieprawidłowy login lub hasło";
                }
            }
        ?><br><br>
        <input type="submit" class="buttons" value="Zaloguj się">
    </form>
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
