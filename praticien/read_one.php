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
$UnPraticien = new Praticien($db);

// set ID property of product to be edited
$UnPraticien->id_praticien = isset($_GET['id']) ? $_GET['id'] : die();

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
