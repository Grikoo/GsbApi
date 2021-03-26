<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/praticien.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$UnDpPraticien = new Praticien($db);

// set ID property of product to be edited
$UnDpPraticien->dp_praticien = isset($_GET['id']) ? $_GET['id'] : die();
$user = isset($_GET['user']) ? $_GET['user'] : die();
$pwd = isset($_GET['pwd']) ? $_GET['pwd'] : die();
// read the details of product to be edited
if($user == "gsb"&& $pwd== "gsb"){
  $UnDpPraticien->readNbDep();
}else{
  echo json_encode(
      array("message" => "Erreur login")
  );
}
