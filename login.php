<?php
session_start();
$errMess = array();
// print_r($_SERVER);
if($_POST){
    // POST情報があるときの処理
    // 1. 入力チェック
    if(!$_POST['username']){
        $errMess[] = "名前を入力してください";
    }else if(mb_strlen($_POST['username']) > 20){
        $errMess[] = "名前は20文字以内にしてください";
    }

    if(!$_POST['password']){
        $errMess[] = "パスワードを入力してください";
    }else if(mb_strlen($_POST['password']) > 20){
        $errMess[] = "パスワードは20文字以内にしてください";
    }


    // 2. ログインID、パスワードが一致しているかどうかをチェック

    $userfile = '../userinfo.txt';
    if (file_exists($userfile)){
        $users = file_get_contents($userfile);
        $users = explode("\n",$users);
        foreach($users as $k => $v){
            if (trim($v) === '') continue; // 空行をスキップ
            $v_ary = str_getcsv($v);
            if(count($v_ary) < 2) continue;
            if($v_ary[0] == $_POST['username']){
                if(password_verify($_POST['password'], $v_ary[1])){
                    $_SESSION['username'] = $_POST['username'];// セッション保存
                    // 3. ログイン後に画面にリダイレクトする
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    header("Location: projectVer1.php");
                    exit;

                }
            }
        }
        $errMess[] = "ユーザー名またはパスワードがただしくありません";
    }else{
       $errMess[] = "ユーザーリストファイルが見つかりません";
    }
} else {
    // POST情報がないときの処理
    // セッション情報があるときはログイン後画面にリダイレクトする
    if(isset($_SESSION['username']) && $_SESSION['username']){
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: projectVer1.php");
        exit;
    }
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
            <?php if ($errMess) {
                echo '<div class="alert alert-danger" role="alert">';
                echo implode('<br>', $errMess);
                echo '</div>';
            }?>
            <h1>Sign in</h1>
            <label>ユーザ名</label> 
            <input type="text" name="username" value=""><br>
            <label>パスワード</label>
            <input type="password" name="password" value=""><br>
            <input type="submit" name="register" value="登録">
            <a href="loginRegister.php">新規登録</a>
        </form>
    </div>
</body>
</html>