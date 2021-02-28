<?php 
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function setToken(){
    
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;
    return $_SESSION['token']; 
}

?>
/Applications/MAMP/htdocs/login/functions.php
