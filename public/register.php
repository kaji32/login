<?php 
ini_set('display_errors', 'On');
require_once('../functions.php');
session_start();


require_once('../classes/UserLogic.php');

$err = [];
$token = filter_input(INPUT_POST, 'token');
if(!isset($_SESSION['token']) || $token !==$_SESSION['token']){
    exit('不正なリクエスト');
}

$username = filter_input(INPUT_POST, 'username');
if(!$username){
    $err[] = 'ユーザー名を記入してください';
}

$email = filter_input(INPUT_POST, 'email');
if(!$email){
    $err[] = 'メールアドレスを記入してください';
}

$password = filter_input(INPUT_POST, 'password');
if(!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)){
    $err[] = 'パスワードは英数字８文字以上１００文字以下にしてください';
}

$password_conf = filter_input(INPUT_POST, 'password_conf');
if($password !== $password_conf){
    $err[] = '確認用パスワードと異なっています';
}



if(count($err) === 0){
    //ユーザーを登録する処理
   $hasCreated = UserLogic::createUser($_POST);

   if(!$hasCreated){
       $err[] = '登録に失敗しました';
   }
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
    <?php if(count($err)>0): ?>
    <?php foreach($err as $e): ?>
    <p><?php echo $e; ?></p>
    <?php endforeach;?>
    <?php else :?>
    <p>ユーザー登録が完了しました。</p>
    <?php endif; ?>
    <a href="./signup_form.php">戻る</a>
</body>
</html>