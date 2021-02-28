<?php

require_once('../dbconnect.php');

class UserLogic
{
    /**ユーザーを登録する
    * @param array $userData
    * @return bool $result
    */
    public static function createUser($userData)
    {
        $sql = 'INSERT INTO users (name, email, password) VALUES(?, ?, ?)';
        $result = false;
        //ユーザーデータを配列に入れる
        $arr = [];
        $arr[] = $userData['username'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);

        try{
            $stmt = connectDb()->prepare($sql);
            $result = $stmt->execute($arr);
        }catch(PDOException $e){
            return $result;
        }
        return $result;
    }

    /**ログイン処理
    * @param string $email
    * @param string $result
    * @return bool $result
    */
    public static function login($email, $password)
    {
        //結果の定義
        $result = false;
        //ユーザーをemailから検索して取得
        $user = self::getUserByEmail($email);

        if(!$user){
            $_SESSION['msg'] = 'emailが存在しません。';
            return $result;
        }

        if(password_verify($password, $user['password'])){
            //ログイン成功
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }

        $_SESSION['msg'] = 'passwordが一致しません';
        return $result;

    }

    /**
    * emiailからユーザーを取得
    * @param string $email
    * @return array/bool $user|$result
    */
    public static function getUserByEmail($email)
    {
        //SQLの準備
        $sql = 'SELECT * FROM users WHERE email = ?';
        //emailを配列に入れる
        $arr[] = $email;
        //SQLの実行
        try{
            $stmt = connectDb()->prepare($sql);
            $stmt->execute($arr);
            //SQLの結果を返す
            $user = $stmt->fetch();
            return $user;
        }catch(PDOException $e){
            return false;
        }
    }

    /**
    * ログインチェック
    * @param string $email
    * @return bool $result
    */
    public static function checkLogin()
    {
        $result = false;

        if(isset($_SESSION['login_user'])&&$_SESSION['login_user']['id']>0){
            return $result = true;
        }
        return $result;
    }

    public static function logout()
    {
        $_SESSION = array();
        session_destroy();
    }
}