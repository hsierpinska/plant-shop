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
    <div class="box1">
        <?php
        if (isset($_SESSION['perm'])) {
            echo "<h2>Twoje zamówienia</h2><br>";
            $username = $_SESSION['login'];
            require_once('connect.php');
            $sql = "SELECT plants.plant_name as name, users.username as user, plants.price as pri, orders.quantity as quan, ((plants.price)*(orders.quantity)) as summary 
            FROM orders join plants on orders.product_id=plants.id join users on users.id=orders.user_id 
            WHERE username=\"{$username}\";";
            $result = $connect->query($sql);
            if ((mysqli_num_rows ( $result )) > 0) {
            echo "<table class='styled-table'>
            <thead>
            <tr>
            <th>Nazwa produktu</th>
            <th>Ilość</th>
            <th>Cena poj. produktu</th>
            <th>Całość</th>
            </tr>
            </thead>
            <tbody>
            ";
            while ($rows=$result->fetch_assoc()) {
                echo "
                <tr>
                <td>$rows[name]</td>
                <td>$rows[quan]</td>
                <td>$rows[pri]</td>
                <td>$rows[summary]</td>
                </tr>
                ";
            }
            echo "</tbody></table><br>";
        } else {
            echo "<h2>Nie masz żadnych zamówień<h2>";
        }
        } else {
            echo "<h2>Musisz być zalogowany, aby móc złożyć zamówienie.</h2>";
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
