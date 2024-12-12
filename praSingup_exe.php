<?php include('header.php'); ?>
<?php
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=project01', "root", "1234");
    } catch(PDOException $e){
        echo $e->getMessage();
    }
    $db->set_charset('utf8');

    $email = $_POST['email'];
    $password = $_POST['password'];
    $nickname = $_POST['nickname'];
    
    $stmt = $db->prepare("INSERT INTO users (user_id, mail, password, nickname, created_at) VALUES (NULL, ?, ?, ?, now())");
    $stmt->bind_param('sss', $email, $password, $nickname);
    $res = $stmt->execute();
    $stmt->close();
    
    if (!$res){
        echo '登録失敗';
    } else {
        echo '登録成功';
    }
?>
<?php include('footer.php'); ?>