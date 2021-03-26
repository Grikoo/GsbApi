<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/visiteur.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$visiteur = new visiteur($db);

// set ID property of product to be edited
$visiteur->id_visiteur = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$visiteur->readOne();

// create array
$visiteur_arr = array(
    "id_visiteur" =>  $visiteur->id_visiteur,
    "nom_visiteur" => $visiteur->nom_visiteur,
    "date_embauche" => $visiteur->date_embauche,
    "prenom_visiteur" => $visiteur->prenom_visiteur,
    "adresse_visiteur" => $visiteur->adresse_visiteur,
    "cp_visiteur" => $visiteur->cp_visiteur,
    "ville_visiteur" => $visiteur->ville_visiteur,
    "nom_labo" => $visiteur->nom_labo,
    "code_secteur" => $visiteur->code_secteur

);

// make it json format
print_r(json_encode($visiteur_arr, JSON_PRETTY_PRINT));
?>
