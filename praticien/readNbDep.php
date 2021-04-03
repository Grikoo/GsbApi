<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/praticien.php';
include_once '../config/session.php';

//debut token
$user = filter_input(INPUT_POST,'user',FILTER_SANITIZE_SPECIAL_CHARS);
$pwd = filter_input(INPUT_POST,'pwd',FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST,'token',FILTER_SANITIZE_SPECIAL_CHARS);
$timer = filter_input(INPUT_POST,'valid',FILTER_SANITIZE_SPECIAL_CHARS);


$login = new Session();
$login->login($user, $pwd, $token ,$timer);

//fin token

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$UnDpPraticien = new Praticien($db);

// set ID property of product to be edited
$nbdep = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
if($nbdep!=null){
  $UnDpPraticien->dp_praticien = $nbdep;
}else{
  echo json_encode(
    array("message" => "erreur id")
  );
  die();
}

$UnDpPraticien->readNbDep();

