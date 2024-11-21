 
<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=project01', "root", "1234");
    } catch(PDOException $e){
    echo $e->getMessage();
    }

//DB接続
if(!empty($_POST["submit"])){

    try{
        $stmt = $pdo->prepare("INSERT INTO `project01-table` (`subject`, `work`, `response`) VALUES (:subject, :work, :response);");
        $stmt->bindParam(':subject', $_POST['subject'], PDO::PARAM_STR);
        $stmt->bindParam(':work', $_POST["work"], PDO::PARAM_STR);
        $stmt->bindParam(':response', $_POST["response"], PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e){
        echo $e->getMessage();
    }


}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskhub</title>
    <link rel="stylesheet" href="common2.css">
    <link rel="stylesheet" href="register2.css">
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
    <div class="register">
        <div class="container">
            <h2 class="register-title">課題・回答投稿</h2>
            <form class="register-form" method="POST" action="register.php">
                <div class="form-groupA">
                    <label for="subject">教科</label><br>
                    <input type="text" name="subject" >
                </div>
                <div class="form-groupB">
                    <label for="work">課題</label><br>
                    <textarea name="work" class="workTextArea"></textarea>
                </div>
                <div class="form-groupC">
                    <label for="response">回答</label><br>
                    <textarea name="response" class="responseTextArea" ></textarea>
                </div>
                <div class="form-groupD">
                    <input type="submit" name="submit" value="送信" class="submit-button">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
