<?php

include_once '../config/session.php';
//debut token
$clefprivee = '1234';
$user = filter_input(INPUT_POST,'user',FILTER_SANITIZE_SPECIAL_CHARS);
$pwd = filter_input(INPUT_POST,'pwd',FILTER_SANITIZE_SPECIAL_CHARS);
$timer = filter_input(INPUT_POST,'timer',FILTER_SANITIZE_SPECIAL_CHARS);
if($user != null){
    $token = sha1($user.$timer.$pwd.$clefprivee);
    echo "Parametre :";
    echo "<br>";
    echo "Voici votre token :  token=".$token;
    echo "<br>";
    echo " Voici votre temps de validité :  valid=".$timer;
    echo "<br>";
    echo "la durée du token est de 20minutes";
    echo "<br>";
    echo "Ne pas oublier de poster les logins dans le body";

    $login = new Session();
    $testlogin = $login->login($user, $pwd, $token ,$timer);
}else{
    header("Location: /GsbApi/connection.php");
}

?>
