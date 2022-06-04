<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktualizacja</title>
</head>
<body>
    <?php
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        require_once('connect.php');
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $login = $_POST['login'];
            $password = sha1($_POST['password']);
            $perm = $_POST['perm'];
            $username = $_GET['username'];
            $sql = "update users set username=\"{$login}\", password=\"{$password}\", perm=\"{$perm}\" where username=\"{$username}\";";

            $result = $connect->query($sql);
            echo $connect->error;
        } elseif (empty($_POST['login']) && !empty($_POST['password'])) {
            $password = sha1($_POST['password']);
            $perm = $_POST['perm'];
            $username = $_GET['username'];
            $sql = "update users set password=\"{$password}\", perm=\"{$perm}\" where username=\"{$username}\";";
            $result = $connect->query($sql);
        } elseif (!empty($_POST['login']) && empty($_POST['password'])) {
            $login = $_POST['login'];
            $perm = $_POST['perm'];
            $username = $_GET['username'];
            $sql = "update users set username=\"{$login}\", perm=\"{$perm}\" where username=\"{$username}\";";
            $result = $connect->query($sql);
        } else {
            $perm = $_POST['perm'];
            $sql = "update users set perm=\"{$perm}\" where username=\"{$username}\";";
        }
    ?>
        <script>
            alert("Zmieniono");
            history.back();
        </script>
</body>
</html>

