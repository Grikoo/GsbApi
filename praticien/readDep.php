<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/praticien.php';
include_once '../config/session.php';

//debut token
$user = filter_input(INPUT_POST,'user',FILTER_SANITIZE_SPECIAL_CHARS);
$pwd = filter_input(INPUT_POST,'pwd',FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST,'token',FILTER_SANITIZE_SPECIAL_CHARS);
$timer = filter_input(INPUT_POST,'valid',FILTER_SANITIZE_SPECIAL_CHARS);

$login = new Session();
$login->login($user, $pwd, $token ,$timer);

//BDD connection
$database = new Database();
$db = $database->getConnection();

// read the details of product to be edited
$DepPraticien = new Praticien($db);
$stmt = $DepPraticien->readDep();
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
