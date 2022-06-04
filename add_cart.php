<?php
    session_start();
    if (isset($_GET['id'])) {
        if (!isset($_SESSION ['cart'])) {
            $_SESSION ['cart'] = array();
        }
        
        if (array_key_exists($_GET['id'], $_SESSION['cart'])) {
            $_SESSION['cart'][$_GET['id']] += 1;
            echo '<script>alert("Produkt znajduje się już w koszyku; dodano o 1 więcej");history.back();</script>';

        } else {
            $_SESSION['cart'][$_GET['id']] = 1;
            echo '<script>alert("Dodano do koszyka");history.back();</script>';
        }
       

    }
?>