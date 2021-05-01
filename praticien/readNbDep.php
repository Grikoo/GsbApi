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
$json = file_get_contents('php://input');
$object = json_decode($json, true);
$pwd = $object['pwd'];
$user = $object['user'];
$timer = $object['valid'];
$token = $object['token'];


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

