<?php 
ini_set('display_errors', 'On');

session_start();
require_once('../classes/UserLogic.php');
$logout = filter_input(INPUT_POST,'logout');
if(!$logout){
    exit(不正なリクエストです);
}

$result = UserLogic::checkLogin();

if(!$result){
    exit('セッションが切れましたので、ログインし直してください');
}

UserLogic::logout();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>ログアウト完了</h2>
    <p>ログアウトしました</p>
    <a href="login_form.php">ログイン画面へ</a>
    <form action="logout.php" method="post"></form>
    <input type="submit" name="logout" value="ログアウト">

    <a href="./signup_form.php">戻る</a>
</body>
</html>