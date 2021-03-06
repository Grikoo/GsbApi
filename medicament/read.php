<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

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

$database = new Database();
$db = $database->getConnection();

$medicaments = new medicament($db);

$stmt = $medicaments->read();
$num = $stmt->rowCount();

if($num>0){
  $medicaments_arr=array();
  $medicaments_arr["medicaments"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $medicaments_item=array(
      "nom_commercial" => $nom_commercial,
      "id_famille" => $id_famille,
      "code_famille" => $code_famille,
      "lib_famille" => $lib_famille,
      "composition" => $composition,
      "effets" => $effets,
      "contre_indication" => $contre_indication,
      "prix_echantillon" => $prix_echantillon,
      "depot_legal" => $depot_legal
    );

    array_push($medicaments_arr["medicaments"], $medicaments_item);
  }

  echo json_encode($medicaments_arr, JSON_PRETTY_PRINT);
}
else{
  echo json_encode(
    array("message" => "Aucun medicaments trouvés.")
  );
}
?>
