 
<?php
session_start();
$errMess = array();
if(!isset($_SESSION['username'])){
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: login.php");
    exit;
}
try{
    $pdo = new PDO('mysql:host=localhost;dbname=project01', "root", "1234");
    } catch(PDOException $e){
    echo $e->getMessage();
    }

//DB接続
if(!empty($_POST["submit"])){
    if(!empty($_POST["subject"]) && !empty($_POST["work"]) && !empty($_POST["response"])){
        try{
            if((isset($_FILES['imagework']) && $_FILES['imagework']['error'] == UPLOAD_ERR_OK) && (isset($_FILES['imageRep']) && $_FILES['imageRep']['error'] == UPLOAD_ERR_OK)){
                $imageFilework = file_get_contents($_FILES['imagework']['tmp_name']);
                $imageFileRep = file_get_contents($_FILES['imageRep']['tmp_name']);
                $stmt = $pdo->prepare("INSERT INTO `project01-table` (`subject`, `work`, `response`, `imagework`, `imageRep`) VALUES (:subject, :work, :response, :imagework, :imageRep);");
                $stmt->bindParam(':subject', $_POST['subject'], PDO::PARAM_STR);
                $stmt->bindParam(':work', $_POST["work"], PDO::PARAM_STR);
                $stmt->bindParam(':response', $_POST["response"], PDO::PARAM_STR);
                $stmt->bindParam(':imagework', $imageFilework, PDO::PARAM_LOB);
                $stmt->bindParam(':imageRep', $imageFileRep, PDO::PARAM_LOB);
                $stmt->execute(); 
            }else if(isset($_FILES['imagework']) && $_FILES['imagework']['error'] == UPLOAD_ERR_OK){
                $imageFilework = file_get_contents($_FILES['imagework']['tmp_name']);
                $stmt = $pdo->prepare("INSERT INTO `project01-table` (`subject`, `work`, `response`, `imagework`) VALUES (:subject, :work, :response, :imagework);");
                $stmt->bindParam(':subject', $_POST['subject'], PDO::PARAM_STR);
                $stmt->bindParam(':work', $_POST["work"], PDO::PARAM_STR);
                $stmt->bindParam(':response', $_POST["response"], PDO::PARAM_STR);
                $stmt->bindParam(':imagework', $imageFilework, PDO::PARAM_LOB);
                $stmt->execute();
            } else if(isset($_FILES['imageRep']) && $_FILES['imageRep']['error'] == UPLOAD_ERR_OK){  
                $imageFileRep = file_get_contents($_FILES['imageRep']['tmp_name']);
                $stmt = $pdo->prepare("INSERT INTO `project01-table` (`subject`, `work`, `response`, `imageRep`) VALUES (:subject, :work, :response, :imageRep);");
                $stmt->bindParam(':subject', $_POST['subject'], PDO::PARAM_STR);
                $stmt->bindParam(':work', $_POST["work"], PDO::PARAM_STR);
                $stmt->bindParam(':response', $_POST["response"], PDO::PARAM_STR);
                $stmt->bindParam(':imageRep', $imageFileRep, PDO::PARAM_LOB);
                $stmt->execute();
            }else{
                $stmt = $pdo->prepare("INSERT INTO `project01-table` (`subject`, `work`, `response`) VALUES (:subject, :work, :response);");
                $stmt->bindParam(':subject', $_POST['subject'], PDO::PARAM_STR);
                $stmt->bindParam(':work', $_POST["work"], PDO::PARAM_STR);
                $stmt->bindParam(':response', $_POST["response"], PDO::PARAM_STR);
                $stmt->execute();
                }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }else{
        $errMess[] = "教科、課題、回答のどれかが空欄です";
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
        <?php if ($errMess) {
            echo '<div class="alert alert-danger" role="alert">';
            echo implode('<br>', $errMess);
            echo '</div>';
        }?>
        <div class="container">
            <h2 class="register-title">課題・回答投稿</h2>
            <form class="register-form" method="POST" action="register.php" enctype="multipart/form-data">
                <div class="form-groupA">
                    <label for="subject">教科</label><br>
                    <input type="text" name="subject" placeholder="数学" >
                </div>
                <div class="form-groupB">
                    <label for="work">課題</label><br>
                    <textarea name="work" class="workTextArea" placeholder="画像のみの場合『画像通り』と記入"></textarea>
                </div>
                <div class="form-groupE">
                    <input type="file" name="imagework" accept="image/*">
                </div>
                <div class="form-groupC">
                    <label for="response">回答</label><br>
                    <textarea name="response" class="responseTextArea" placeholder="画像のみの場合『画像通り』と記入"></textarea>
                </div>
                <div class="form-groupF">
                    <input type="file" name="imageRep" accept="image/*">
                </div>
                <div class="form-groupD">
                    <input type="submit" name="submit" value="送信" class="submit-button">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
