<?php
    session_start();
    if (isset($_GET['quantity'])) {
        
        
        if ($_GET['quantity']) {
            
            
            if (($_SESSION['cart'][$_GET['id']])!=1) {
            $_SESSION['cart'][$_GET['id']] -= 1;
            }
        } else {
            
            $_SESSION['cart'][$_GET['id']] += 1;
        }
        
    }
    if (isset($_GET['delete'])) {
        unset($_SESSION['cart'][$_GET['id']]); 
    }
    header('location: koszyk.php');

?>