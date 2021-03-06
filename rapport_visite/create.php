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
$json = file_get_contents('php://input');
$object = json_decode($json, true);
$pwd = $object['pwd'];
$user = $object['user'];
$timer = $object['valid'];
$token = $object['token'];


$login = new Session();
$login->login($user, $pwd, $token ,$timer);

$database = new Database();
$db = $database->getConnection();

$rapportvisite = new rapport_visite($db);

if(!isset($_GET['id_visiteur']) OR !isset($_GET['motif']) OR !isset($_GET['id_praticien']) OR !isset($_GET['bilan']) OR empty($_GET['id_visiteur']) OR empty($_GET['motif']) OR empty($_GET['id_praticien']) OR empty($_GET['bilan']))
{
  echo '{';
      echo '"message": "Des informations sont manquantes."';
  echo '}';
}
else {

  // set product property values
  $rapportvisite->id_visiteur = $_GET['id_visiteur'];
  $rapportvisite->id_praticien = $_GET['id_praticien'];
  $rapportvisite->date_rapport = date('Y-m-d H:i:s');
  $rapportvisite->bilan = $_GET['bilan'];
  $rapportvisite->motif = $_GET['motif'];

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
