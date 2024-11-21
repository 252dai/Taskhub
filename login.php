<?php
// print_r($_SERVER);
if($_POST){
    // POST情報があるときの処理
    // 1. 入力チェック
    // 2. ログインID、パスワードが一致しているかどうかをチェック
    // 3. ログイン後に画面にリダイレクトする
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: projectVer1.php");
    exit;

} else {
    // POST情報がないときの処理
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインフォーム</title>
</head>
<body>
    <form action="login.php" method="post">
        ユーザ名 : <input type ="name" name = "username" value=""><br>
        パスワード : <input type ="password" name = "passWord" value=""><br>
        <input type="submit" name="login" value= "ログイン"/>
    </form>
</body>
</html>