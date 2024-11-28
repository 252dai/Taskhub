<?php
session_start();
if(!isset($_SESSION['username'])){
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: login.php");
    exit;
}
$comment_array = array();


//DB接続
try{
    $pdo = new PDO('mysql:host=localhost;dbname=project01', "root", "1234");
} catch(PDOException $e){
    echo $e->getMessage();
}

//DBからコメントデータを取得する
$sql = "SELECT * FROM `project01-table`;";
$comment_array = $pdo->query($sql);

//DBの接続を閉じる
$pdo = null;

?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskhub</title>
    <link rel="stylesheet" href="common2.css">
    <link rel="stylesheet" href="confirm2.css">
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
    <div class="confirm">
        <div class="container">
            <h2 class="confirm-title">確認</h2><hr>
            <div class="confirmArea">
                <section>
                    <?php foreach($comment_array as $comment): ?>
                    <article>
                        <div class="subjectArea">
                            <span>授業名</span>
                            <p class="subject"><?php echo $comment["subject"];?></p>
                        </div>
                        <div class="workArea">
                            <span>課題</span>
                            <p class="work"><?php echo $comment["work"];?></p>
                            <img src="data:image/*;base64,<?php echo base64_encode($comment['imagework']); ?>" class="imageFileA" alt=" ">
                        </div>
                        <div class="responseArea">
                            <span>回答</span>
                            <button onclick="toggleResponse(this)">表示</button>
                            <p class="response"><?php echo $comment["response"];?></p>
                            <img src="data:image/*;base64,<?php echo base64_encode($comment['imageRep']); ?>" class="imageFileB" alt=" ">
                        </div>
                        <hr>
                    </article>
                    <?php endforeach; ?>
                </section>
            </div>

            <script>
                function toggleResponse(button){
                    const article = button.closest('article');
                    const response = article.querySelector('.response');
                    const imageFileB = article.querySelector('.imageFileB');

                    if((response.style.display === "none") || (imageFileB.style.display === "none")){
                        response.style.display = "block";
                        imageFileB.style.display = "block";
                        button.textContent = "非表示";
                    }else{
                        response.style.display = "none";
                        imageFileB.style.display = "none";
                        button.textContent = "表示";
                    }
                }
            </script> 
        </div> 
    </div>
</body>
</html>