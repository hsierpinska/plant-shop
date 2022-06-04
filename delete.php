<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuwanie</title>
</head>
<body>
<?php
    if (isset($_GET['id'])) {
        require_once 'connect.php';
        $sql = "DELETE FROM `plants` WHERE id={$_GET['id']};";
        $query = $connect->query($sql);
        if ($query) {echo "<script>alert(\"Usunięto\");</script>";}
        else {echo "<script>alert(\"Nie usunięto\");</script>";}
        
        }
    if (isset($_GET['username'])) {
        require_once 'connect.php';
        $sql = "DELETE FROM `users` WHERE username=\"{$_GET['username']}\";";
        $query = $connect->query($sql);
        

    }
    ?>
        <script>
            history.back();
        </script>
</body>
</html>

