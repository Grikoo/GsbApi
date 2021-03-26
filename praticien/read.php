<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/praticien.php';

$database = new Database();
$db = $database->getConnection();

$praticien = new Praticien($db);

$stmt = $praticien->read();
$num = $stmt->rowCount();

if($num>0){
  $praticien_arr=array();
  $praticien_arr["praticiens"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $praticien_item=array(
      "id_praticien" => $id_praticien,
      "nom_praticien" => $nom_praticien,
      "prenom_praticien" => $prenom_praticien,
      "cp_praticien" => $cp_praticien,
      "adresse_praticien" => $adresse_praticien,
      "ville_praticien" => $ville_praticien,
      "coef_notoriete" => $coef_notoriete,
      "dp_praticien" => $dp_praticien
    );

    array_push($praticien_arr["praticiens"], $praticien_item);
  }

  echo json_encode($praticien_arr, JSON_PRETTY_PRINT);
}
else{
  echo json_encode(
    array("message" => "Aucun praticiens trouvés.")
  );
}
?>
