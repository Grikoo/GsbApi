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


  // set product property values
  $rapportvisite->id_praticien = $_GET['id_praticien'];

  // create the product
  $rapportvisite->getRapportofpraticien();



?>
