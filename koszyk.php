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
            if (empty($_SESSION['cart'])) {
                echo "<div class=\"box1\"><h2>Nic nie znajduje się obecnie w koszyku.</h2></div>";
            } else {
                require_once("connect.php");
                echo '<div class="cart"><h2>Koszyk</h2><br><br><table class="styled-table">
                <thead>
                <th></th>
                <th>Nazwa</th>
                <th>Cena</th>
                <th>Dostępne sztuki</th>
                <th colspan="3">Ilość</th>
                <th></th>
                </thead>
                <tbody>';
                $sum = 0;
                $price = 0;
                foreach($_SESSION['cart'] as $key => $val) {
                    $sql = "SELECT * FROM `plants` WHERE id=$key;";
                    $result = $connect->query($sql);
                    $row=$result->fetch_assoc();
                    
                    $price=($row['price'])*$val;
                    $sum+=$price;
                    echo <<< TABLE
                    <tr>
                    <td><img src="./assets/$row[image].png"></td>
                    <td>$row[plant_name]</td>
                    <td>$row[price]</td>
                    <td>$row[quantity]</td>
                    <td><a href="quantity.php?quantity=1&id=$key">-</a>
                    <td>$val</td>
                    <td><a href="quantity.php?quantity=0&id=$key">+</a>
                    <td><a href="quantity.php?delete=1&id=$key">Usuń z koszyka</a></td>
                    
                    </tr>
                    TABLE;
                }
                echo "</tbody></table><br>
                Łączna cena: $sum zł<br><br>
                <a href=\"order.php\">Zamów</a>
                </div>
                ";
                $connect->close();
            }
            
        ?>
        
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
