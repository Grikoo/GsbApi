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

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$UnPraticien = new Praticien($db);

// set ID property of product to be edited
$idprat = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
if($idprat!=null){
  $UnPraticien->id_praticien = $idprat;
}else{
  echo json_encode(
    array("message" => "erreur id")
  );
  die();
}

// read the details of product to be edited
$UnPraticien->readOne();

// create array
$UnPraticien_arr = array(
  "id_praticien" =>  $UnPraticien->id_praticien,
  "nom_praticien" => $UnPraticien->nom_praticien,
  "prenom_praticien" => $UnPraticien->prenom_praticien,
  "adresse_praticien" => $UnPraticien->adresse_praticien,
  "cp_praticien" => $UnPraticien->cp_praticien,
  "ville_praticien" => $UnPraticien->ville_praticien,
  "coef_notoriete" => $UnPraticien->coef_notoriete,
  "id_type_praticien" => $UnPraticien->id_type_praticien

);

// make it json format
echo json_encode($UnPraticien_arr, JSON_PRETTY_PRINT);

?>
