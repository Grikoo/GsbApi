<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/visiteur.php';
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

$visiteur = new visiteur($db);

$stmt = $visiteur->read();
$num = $stmt->rowCount();

if($num>0){
  $visiteur_arr=array();
  $visiteur_arr["visiteurs"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $visiteur_item=array(
      "id_visiteur" => $id_visiteur,
      "nom_visiteur" => $nom_visiteur,
      "date_embauche" => $date_embauche,
      "prenom_visiteur" => $prenom_visiteur,
      "cp_visiteur" => $cp_visiteur,
      "adresse_visiteur" => $adresse_visiteur,
      "ville_visiteur" => $ville_visiteur,
      "nom_labo" => $nom_labo,
      "code_secteur" => $code_secteur
    );

    array_push($visiteur_arr["visiteurs"], $visiteur_item);
  }

  echo json_encode($visiteur_arr, JSON_PRETTY_PRINT);
}
else{
  echo json_encode(
    array("message" => "Aucun visiteurs trouvés.")
  );
}
?>
