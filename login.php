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
    <link rel="stylesheet" href="login.css">
    <title>ログインフォーム</title>
</head>
<body>
    <div class="login">
        <form action="login.php" method="post">
            <h1>Sign in</h1>
            <label>ユーザ名</label> 
            <input type="text" name="username" value=""><br>
            <label>パスワード</label>
            <input type="password" name="password" value=""><br>
            <input type="submit" name="register" value="登録">
        </form>
    </div>
</body>
</html>