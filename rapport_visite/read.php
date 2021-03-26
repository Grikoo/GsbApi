<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/rapport_visite.php';

$database = new Database();
$db = $database->getConnection();

$rapportvisite = new rapport_visite($db);

$stmt = $rapportvisite->read();
$num = $stmt->rowCount();

if($num>0){
  $rapportvisite_arr=array();
  $rapportvisite_arr["rapport_visite"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $rapportvisite_item=array(
      "id_visiteur" => $id_visiteur,
      "id_rapport" => $id_rapport,
      "id_praticien" => $id_praticien,
      "date_rapport" => $date_rapport,
      "bilan" => $bilan,
      "motif" => $motif
    );

    array_push($rapportvisite_arr["rapport_visite"], $rapportvisite_item);
  }

  echo json_encode($rapportvisite_arr, JSON_PRETTY_PRINT);
}
else{
  echo json_encode(
    array("message" => "Aucun rapports de visite trouvés.")
  );
}
?>
