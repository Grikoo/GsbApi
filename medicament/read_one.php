<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/medicament.php';
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
$Unmedicament = new medicament($db);

// set ID property of product to be edited
$idmed = filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS);
if($idmed!=null){
  $Unmedicament->depot_legal = $idmed;
}else{
  echo json_encode(
    array("message" => "erreur id")
  );
  die();
}

// read the details of product to be edited
$Unmedicament->readOne();

// create array
$Unmedicament_arr = array(
  "nom_commercial" =>  $Unmedicament->nom_commercial,
  "id_famille" => $Unmedicament->id_famille,
  "code_famille" => $Unmedicament->code_famille,
  "lib_famille" => $Unmedicament->lib_famille,
  "composition" => $Unmedicament->composition,
  "effets" => $Unmedicament->effets,
  "contre_indication" => $Unmedicament->contre_indication,
  "prix_echantillon" => $Unmedicament->prix_echantillon
);

// make it json format
echo(json_encode($Unmedicament_arr, JSON_PRETTY_PRINT));
?>
