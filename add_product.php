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
        <form method = "post" action="insert.php">
        <h2>Dodaj nowy produkt</h2>
        <br>
        <input type="text" placeholder="Nazwa produktu" name="name" required=""><br><br>
        <input type="number" placeholder="Cena" step="0.01" min="0.01" name="price" required="" ><br><br>
        <input type="number" placeholder="Ilość" name="quantity" min="1" required=""><br><br>
        <label for="image">Zdjęcie:</label>
                <select name="image" id="image">
                    <?php
                    require_once('connect.php');
                    $sql = "select name from images;";
                    $result = $connect->query($sql);
                    echo $connect->error;;
                    $i = 1;
                    while ($row=$result->fetch_assoc()) {
                        echo <<< SELECT
                        <option value="$i">$row[name]</option>
                        SELECT;
                        $i++;
                    }
                    ?>
                </select>
        <br><br>
        <input type="submit" class="buttons" value="Dodaj">
    </form>
    </div>
    <div class="b"></div>
</div>

<footer>
    Autor: Helena Sierpińska
</footer>
<script src="scroll.js"></script>
<script src="scrollFade.js"></script>
<script src="zoom.js"></script>
</body>
</html>
