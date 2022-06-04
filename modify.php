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
    <div class="login-show">
        <?php
        if (isset($_SESSION['perm'])) {
            echo "<h2>Informacje o użytkowniku</h2><br>";
            require_once('connect.php');
            $username = $_GET['username'];
            $sql = "SELECT username, perms.perm FROM `users` join perms on users.perm=perms.id WHERE username=\"{$username}\";";
            $result = $connect->query($sql);
            $rows=$result->fetch_assoc();
            echo <<< USER
            <form method = "post" action="update.php?username=$username">
            <h2>Nazwa: </h2> $rows[username]<br><br>
            <input type="text" placeholder="Nowy login" name="login"><br>
            <h2>Hasło: </h2> ***
            <input type="password" placeholder="Nowe hasło" name="password"><br>
            <h2>Uprawnienia: </h2> $rows[perm]<br><br>
            USER;
            if (isset($_SESSION['perm'])) {
                if (($_SESSION['perm']) == 1) {
                    echo "
                    <label for=\"perm\">Uprawnienia:</label>
                    <select name=\"perm\" id=\"perm\">
                        <option value=\"1\">Admin</option>
                        <option value=\"2\">Moderator</option>
                        <option value=\"3\">User</option>
                    </select><br><br>"; }
                elseif (($_SESSION['perm']) == 2) {
                    echo "
                    <label for=\"perm\">Uprawnienia:</label>
                    <select name=\"perm\" id=\"perm\">
                        <option value=\"2\">Moderator</option>
                        <option value=\"3\">User</option>
                    </select><br><br>";
                
                }
            }
            echo "<input type=\"submit\" class=\"buttons\" value=\"Dodaj\"></form>";
            

        } else {
            echo "<h2>Nie masz uprawnień do wyświetlania tej strony.</h2>";
        }
        ?>
    </div>
    <div class="c"></div>
</div>

<footer>
    Autor: Helena Sierpińska
</footer>
<script src="scroll.js"></script>
<script src="scrollFade.js"></script>
<script src="zoom.js"></script>
</body>
</html>
