<?php
   
    session_start();
    if (isset($_SESSION['cart'])) {
        require_once('connect.php');
        $userid = $_SESSION['user_id'];
        foreach($_SESSION['cart'] as $key => $val) {

            $sql = "insert into orders (user_id, product_id, quantity) values(\"{$userid}\", \"{$key}\", \"{$val}\");";
            $result = $connect->query($sql);
            $sql = "UPDATE plants set quantity = (quantity - {$val}) where id=\"$key\";";
            $result = $connect->query($sql);
            
        }

        echo "<script>alert('Zamówienie zostało złożone');</script>"; 
    }
    unset($_SESSION['cart']); 
    echo "<script>history.back();</script>";
?>