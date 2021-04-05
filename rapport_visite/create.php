<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/rapport_visite.php';
include_once '../config/session.php';

//debut token
$user = filter_input(INPUT_POST,'user',FILTER_SANITIZE_SPECIAL_CHARS);
$pwd = filter_input(INPUT_POST,'pwd',FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST,'token',FILTER_SANITIZE_SPECIAL_CHARS);
$timer = filter_input(INPUT_POST,'valid',FILTER_SANITIZE_SPECIAL_CHARS);


$login = new Session();
$login->login($user, $pwd, $token ,$timer);

$database = new Database();
$db = $database->getConnection();

$rapportvisite = new rapport_visite($db);

if(!isset($_POST['id_visiteur']) OR !isset($_POST['motif']) OR !isset($_POST['id_praticien']) OR !isset($_POST['bilan']) OR empty($_POST['id_visiteur']) OR empty($_POST['motif']) OR empty($_POST['id_praticien']) OR empty($_POST['bilan']))
{
  echo '{';
      echo '"message": "Des informations sont manquantes."';
  echo '}';
}
else {

  // set product property values
  $rapportvisite->id_visiteur = $_POST['id_visiteur'];
  $rapportvisite->id_praticien = $_POST['id_praticien'];
  $rapportvisite->date_rapport = date('Y-m-d H:i:s');
  $rapportvisite->bilan = $_POST['bilan'];
  $rapportvisite->motif = $_POST['motif'];

  // create the product
  if($rapportvisite->create()){
      echo '{';
          echo '"message": "Rapport de visite créer."';
      echo '}';
  }

  // if unable to create the product, tell the user
  else{
      echo '{';
          echo '"message": "Impossible de créer le rapport de visite."';
      echo '}';
  }
}



?>
