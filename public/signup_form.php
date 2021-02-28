<?php 
session_start();
require_once('../functions.php');

$login_err = isset($_SESSION['login_err'])? $_SESSION['login_err']:null;
?>
<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>ユーザー登録フォーム</h2>
    <?php if(isset($err['msg'])): ?>
    <p><?php echo $err['msg']?></p>
        <?php endif ;?>
        <form action="register.php" method="post">
        <input type="hidden" name='token' value="<?php echo h(setToken()); ?>">
        <p>
            <label for="username">ユーザー名</label>
            <input type="text" name="username">
        </p>
        <p>
            <label for="email">メールアドレス</label>
            <input type="email" name="email">
        </p>
        <p>
            <label for="password">パスワード</label>
            <input type="password" name="password">
        </p>
        <p>
            <label for="password_conf">パスワード確認</label>
            <input type="password" name="password_conf">
        </p>
        <p>
        <input type="submit" value="新規登録">
        </p>
        </form>

        <a href="login_form.php">ログインする</a>
</body>
</html>