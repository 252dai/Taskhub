<?php $page_title = '新規登録'; ?>
<?php include('header.php'); ?>
    <p>こちらは新規登録ページです</p>
    <form action="praSignup_exe.php" method="post"></form>
    <div>メールアドレス : <input type="text" name="email"></div>
    <div>パスワード : <input type="password" name="password"></div>
    <div><input type="submit" value="登録する"></div>
    </form>
<?php include('footer.php'); ?>