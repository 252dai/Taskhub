<?php
$errMess = array();

if ($_POST) {
    // 入力チェック
    if (!$_POST['username']) {
        $errMess[] = "名前を入力してください";
    } elseif (strlen($_POST['username']) > 20) { 
        $errMess[] = "名前は20文字以内にしてください";
    }

    if (!$_POST['password']) {
        $errMess[] = "パスワードを入力してください";
    } elseif (strlen($_POST['password']) > 50) { 
        $errMess[] = "パスワードは50文字以内にしてください";
    }

    if ($_POST['password'] != $_POST['password2']) {
        $errMess[] = "確認用パスワードが一致しません";
    }

    $userfile = "../uesrinfo.txt";
    if(!$errMess){
        $ph = password_hash($_POST['password'], algo: PASSWORD_DEFAULT);
        $line = '"' . $_POST['username'] . '","' .$ph . '"' . "\n";
        $ret = file_put_contents($userfile, $line, flags: FILE_APPEND);
    }

    // エラーがなければリダイレクト
    if (!$errMess) {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <?php
    if ($errMess) {
        echo '<div class="alert alert-danger" role="alert">';
        echo implode('<br>', $errMess);
        echo '</div>';
    }
    ?>
    <div class="login">
        <form action="" method="post">
            <h1>Sign up</h1>
            <label>ユーザ名</label> 
            <input type="text" name="username" value=""><br>
            <label>パスワード</label>
            <input type="password" name="password" value=""><br>
            <label>パスワード(確認)</label>
            <input type="password" name="password2" value=""><br>
            <input type="submit" name="register" value="登録">
        </form>
    </div>
</body>
</html>
