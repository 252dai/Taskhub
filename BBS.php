<?php
$comment_array = array();
$errMess = array();
//DB接続
try{
    $pdo = new PDO('mysql:host=localhost;dbname=project01', "root", "1234");
} catch(PDOException $e){
    echo $e->getMessage();
}


if(!empty($_POST["submit"])){
    if(!empty($_POST["username"])){
        try {
            $stmt = $pdo->prepare("INSERT INTO `bbs-table` (`username`, `comment`, `time`) VALUES (:username, :comment, :time);");
            $stmt->bindParam(':username',$_POST['username'], PDO::PARAM_STR);
            $stmt->bindParam(':comment',$_POST['comment'], PDO::PARAM_STR);
            $current_time = date('Y-m-d H:i:s');
            $stmt->bindParam(':time', $current_time, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e -> getMessage();
        }
    }
}
$sql = "SELECT * FROM `bbs-table`;";
$comment_array = $pdo->query($sql);

$pdo = null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="common2.css">
    <link rel="stylesheet" href="BBS2.css">
    <title>Taskhub</title>
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
    <div class="BBS">
        <div class="container">
            <h2 class="BBS-title">掲示板</h2>
            <?php foreach($comment_array as $comment): ?>
                <div class="BBS-A">
                    <div class="BBS-a">
                        <span>名前</span>
                        <p class="userName1"><?php echo $comment["username"];?></p>
                        <span>日付</span>
                        <p class="Time1"><?php echo $comment["time"];?></p>
                        <span>コメント</span>
                        <p class="Comment1"><?php echo $comment["comment"];?></p>
                    </div>
            </div>    
            <?php endforeach; ?>
            <hr>
            <h2 class="BBS-register">投稿</h2>
            <div class="BBS-B">
                <form  class="register-form" method="POST" action="">
                    <label for="userName2">名前</label><br>
                    <input type="text" name="username" class="inpuser"><br>
                    <label for="Comment2">コメント</label><br>
                    <textarea name="comment" class="inpcom"></textarea><br>
                    <input type="submit" class="submitButton" name="submit" value="投稿">
                </form>
            </div>
        </div>
    </div>
</body>
</html>