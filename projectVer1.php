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
                <a href="projectVer1.php">トップ</a>
                <a href="register.php">登録</a>
                <a href="confirm.php">確認</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="main-visual">
        <div class="container">
            <h1 class="top-title">課題を復習しよう</h1>
            <p class="top-text">
                課題と回答を保存して
                <br>
                好きな時に見返そう！！！
            </p>
            <div class="list">
                <a href="projectVer1.php">トップ</a>
                <a href="register.php">登録</a>
                <a href="confirm.php">確認</a>
            </div>
        </div>
    </div>
    <div class="howUse">
            <div class="container">
                <h2>How to Taskhub</h2>
                <div class="how-use-wrapper">         <!--カードを囲む要素-->
                    <div class="howUse-card"><!--1枚目-->         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/home2.png" alt="home">
                            <a href="projectVer1.php" class="howUse-title">ホームページ</a>
                            <p class="howUse-text">
                                このサイトの使い方
                                <br>
                                いろいろかいてあるよ！！
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">  <!--2枚目-->       <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/aicon1.png" alt="投稿">
                            <a href="register.php" class="howUse-title">課題・回答投稿</a>
                            <p class="howUse-text">
                                課題・回答投稿方法
                                <br>
                                各欄に各々の内容を記載する
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/aicon2.png" alt="確認">
                            <a href="confirm.php" class="howUse-title">確認</a>
                            <p class="howUse-text">
                                課題・回答確認方法
                                <br>
                                表示を押すと回答が見える
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/BBS2.png" alt="掲示板">
                            <a href="BBS.php" class="howUse-title">掲示板</a>
                            <p class="howUse-text">
                                掲示板
                                <br>
                                何を追加したか確認できる
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/suk.png" alt="スケジュール表">
                            <a href="time.php" class="howUse-title">スケジュール表</a>
                            <p class="howUse-text">
                                スケジュール表の使用方法
                                <br>
                                用事と日付を記入
                            </p>
                        </div>
                    </div>
                    <div class="howUse-card">         <!--一つのカードの大枠-->
                        <div class="how-use-inner">
                            <img class="howUse-image" src="images/logout.png" alt="ログアウト">
                            <a href="logout.php" class="howUse-title">ログアウト</a>
                            <p class="howUse-text">
                                ログアウト
                                <br>
                                再度使用する場合はログインが必要
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