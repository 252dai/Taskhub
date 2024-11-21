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
</head>
<body>
    <h1>新規登録</h1>
    <?php
    if ($errMess) {
        echo '<div class="alert alert-danger" role="alert">';
        echo implode('<br>', $errMess);
        echo '</div>';
    }
    ?>
    <form action="" method="post">
        ユーザ名 : <input type="text" name="username" value=""><br>
        パスワード : <input type="password" name="password" value=""><br>
        パスワード(確認) : <input type="password" name="password2" value=""><br>
        <input type="submit" name="register" value="登録">
    </form>
</body>
</html>
