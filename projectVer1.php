<?php
session_start();
if(!isset($_SESSION['username'])){
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
    <title>Taskhub</title>
    <link rel="stylesheet" href="common2.css">
    <link rel="stylesheet" href="projectVer2.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="header-right">
                <a href="projectVer1.php">トップ<a>
                <a href="register.php">登録<a>
                <a href="confirm.php">確認<a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="main-visual">
        <div class="container">
            <h1 class="top-title">課題を復習しよう</h1><br>
            <p class="top-text">
                課題と回答を保存して
                <br>
                好きな時に見返そう！！！
            </p>
            <div class="list">
                <a href="projectVer1.php">トップ<a>
                <a href="register.php">登録<a>
                <a href="confirm.php">確認<a>
            </div>
        </div>
    </div>
    <div class="howUse">
            <div class="container">
                <h2>使用方法</h2>
                <div class="how-use-wrapper">         <!--カードを囲む要素-->
                    <div class="howUse-card"><!--1枚目-->         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/registerSample.png" alt="使い方1">
                            <a href="register.php" class="howUse-title">課題保存</a>
                            <p class="howUse-text">
                                課題保存のやり方
                                <br>
                                教科・課題・回答欄に書く！！
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">  <!--2枚目-->       <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/confirmSample.png" alt="使い方1">
                            <a href="confirm.php" class="howUse-title">回答の確認</a>
                            <p class="howUse-text">
                                回答確認のやり方
                                <br>
                                表示・非表示で確認できる！！
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/空背景.png" alt="使い方1">
                            <h3 class="howUse-title">使い方1つ目</h3>
                            <p class="howUse-text">
                                使い方1つ目
                                <br>
                                です！！
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/空背景.png" alt="使い方1">
                            <h3 class="howUse-title">使い方1つ目</h3>
                            <p class="howUse-text">
                                使い方1つ目
                                <br>
                                です！！
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/空背景.png" alt="使い方1">
                            <h3 class="howUse-title">使い方1つ目</h3>
                            <p class="howUse-text">
                                使い方1つ目
                                <br>
                                です！！
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/空背景.png" alt="使い方1">
                            <h3 class="howUse-title">使い方1つ目</h3>
                            <p class="howUse-text">
                                使い方1つ目
                                <br>
                                です！！
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <a href="logout.php" class = "logout">ログアウト</a>
            <p>&copy; 2024 Taskhub Company</p>
</body>
</html>