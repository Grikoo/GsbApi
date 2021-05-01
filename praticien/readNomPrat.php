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

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$UnNomPraticien = new Praticien($db);

// set ID property of product to be edited
$nomprat = filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS);
if($nomprat!=null){
    $UnNomPraticien->nom_praticien = $nomprat;
}else{
  echo json_encode(
    array("message" => "erreur id")
  );
  die();
}

// read the details of product to be edited
$UnNomPraticien->readNomPrat();
