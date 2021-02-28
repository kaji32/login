<?php
session_start();
ini_set('display_errors', 'On');
require_once('../classes/UserLogic.php');

$err = [];


$email = filter_input(INPUT_POST, 'email');
if(!$email){
    $err['email'] = 'メールアドレスを記入してください';
}



$password = filter_input(INPUT_POST, 'password');
if(!$password){
    $err['password'] = 'パスワードをを記入してください';
}



if(count($err) > 0){
    $_SESSION = $err; 
    header('Location: login_form.php');
    return;
}

$result = UserLogic::login($email, $password);

if(!$result){
 header('Location: login.php');
 return;
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>ログイン完了</h2>
    <p>ログインしました</p>
    <a href="./mypage.php">マイページへ</a>
</body>
</html>