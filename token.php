<?php

include_once './config/session.php';

//debut token
$clefprivee = '1234';
//$user = filter_input(INPUT_POST,'user',FILTER_SANITIZE_SPECIAL_CHARS);
//$pwd = filter_input(INPUT_POST,'pwd',FILTER_SANITIZE_SPECIAL_CHARS);
$json = file_get_contents('php://input');
$object = json_decode($json, true);
$pwd = $object['pwd'];
$user = $object['user'];
$timer = time();
if($user != null){
    $token = sha1($user.$timer.$pwd.$clefprivee);
    $login = new Session();
    $testlogin = $login->login($user, $pwd, $token ,$timer);
    header('Content-Type: application/json');
    $tok_timer_item=array(
        "token"=>$token,
        "valid"=>$timer
    );
    echo json_encode($tok_timer_item, JSON_PRETTY_PRINT);
}



?>
