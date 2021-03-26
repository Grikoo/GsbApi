<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/praticien.php';

$database = new Database();
$db = $database->getConnection();

$DepPraticien = new Praticien($db);
$user = isset($_GET['user']) ? $_GET['user'] : die();
$pwd = isset($_GET['pwd']) ? $_GET['pwd'] : die();
// read the details of product to be edited
if($user == "gsb"&& $pwd== "gsb"){
  $stmt = $DepPraticien->readDep();
}else{
  echo json_encode(
      array("message" => "Erreur login")
  );
}
$num = $stmt->rowCount();

if($num>0){
  $DepPraticien_arr=array();
  $DepPraticien_arr["departement_praticien"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $DepPraticien_item=array(
      "dp_praticien" => $dp_praticien
    );

    array_push($DepPraticien_arr["departement_praticien"], $DepPraticien_item);
  }

  echo json_encode($DepPraticien_arr, JSON_PRETTY_PRINT);
}
else{
  echo json_encode(
    array("message" => "Aucun departement de praticiens trouvés.")
  );
}
?>
