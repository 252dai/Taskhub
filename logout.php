<?php
    session_start();
    if(!empty($_POST["submit"])){
        $_SESSION = array();
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logout</title>
    <link rel="stylesheet" href="logout.css">
</head>
<body>
    <div class="container">
        <h1>ログアウト</h1>
        <p>ログアウトしますか？</p>
        <form action="logout.php" method="post" >
            <input type="submit" name="submit" value="ログアウト" class="button">
        </form>
    </div>
</body>
</html>