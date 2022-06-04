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
<div class="aa"> <?php
if (isset($_SESSION['perm'])) {
        if (($_SESSION['perm'] == 1) || ($_SESSION['perm'] == 2)) {
        echo "<a href=\"add_product.php\">Dodaj nowy produkt</a></div>";
        }
    }
?>
<section class="products">
<?php


require_once("connect.php");
$sql = "SELECT * FROM `plants`;";
$result = $connect->query($sql);

while ($rows=$result->fetch_assoc()) {

    echo <<< PRODUKTY
    
    <div class="product-card">
    <div class="product-image">
    <img src="./assets/$rows[image].png">
    </div>
    <div class="product-info">
    <h2>$rows[plant_name]</h2>
    <a class="buttons" href="add_cart.php?id=$rows[id]">Dodaj do koszyka</a> 
    PRODUKTY;
    if (isset($_SESSION['perm'])) {
        if (($_SESSION['perm'] == 1) || ($_SESSION['perm'] == 2)) {
            echo "<a href=\"delete.php/?id=$rows[id]\">Usuń</a>";
        }
    }
    echo <<< PRODUKTY
    <br><br>
    Cena: $rows[price] zł<br>
    Ilość: $rows[quantity]
    </div>
    </div>
    
    PRODUKTY;

}

?>   
 </section>     
    </div>



<footer>
    Autor: Helena Sierpińska
</footer>
<script src="scroll.js"></script>
<script src="scrollFade.js"></script>
<script src="zoom.js"></script>
</body>
</html>
