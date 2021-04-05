<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

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

$stmt = $rapportvisite->readMax();
$num = $stmt->rowCount();

if($num>0){
  $rapportvisite_arr=array();
  $rapportvisite_arr["Max_rapport"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $rapportvisite_item=array(
      "MAX" => $MAX
    );

    array_push($rapportvisite_arr["Max_rapport"], $rapportvisite_item);
  }

  echo json_encode($rapportvisite_arr, JSON_PRETTY_PRINT);
}
else{
  echo json_encode(
    array("message" => "Impossible de calculer le nombre de rapports.")
  );
}
?>
