<?php
class Praticien{

    // database connection and table name
    private $conn;
    private $table_name = "praticien";

    // object properties
    public $id_praticien;
    public $nom_praticien;
    public $prenom_praticien;
    public $adresse_praticien;
    public $cp_praticien;
    public $ville_praticien;
    public $dp_praticien;
    public $coef_notoriete;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){
      $query="SELECT id_praticien, nom_praticien, prenom_praticien, adresse_praticien, cp_praticien, ville_praticien, dp_praticien, coef_notoriete FROM praticien INNER JOIN type_praticien ON praticien.id_type_praticien = type_praticien.id_type_praticien ORDER BY 1";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function readOne(){

        // query to read single record
        $query = "SELECT * FROM praticien WHERE id_praticien = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_praticien);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->nom_praticien = $row['nom_praticien'];
        $this->prenom_praticien = $row['prenom_praticien'];
        $this->adresse_praticien = $row['adresse_praticien'];
        $this->cp_praticien = $row['cp_praticien'];
        $this->ville_praticien = $row['ville_praticien'];
        $this->coef_notoriete = $row['coef_notoriete'];
        $this->id_type_praticien = $row['id_type_praticien'];
    }

    public function readDep(){

      $query = "SELECT DISTINCT(dp_praticien) FROM praticien ORDER BY dp_praticien ASC";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function readNbDep(){
      
      $query = "SELECT * FROM praticien WHERE dp_praticien = ? ORDER BY nom_praticien ASC";

      // prepare query statement
      $stmt = $this->conn->prepare($query);

      // bind id of product to be updated
      $stmt->bindParam(1, $this->dp_praticien);

      // execute query
      $stmt->execute();

      // get retrieved row
      $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
      $num = $stmt->rowCount();

      if($num>0){
        $praticien_arr["praticiens"]=array();
        $row = array();
        foreach($rows as $row){
          extract($row,EXTR_OVERWRITE);
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
    }

    public function readNomPrat(){

      $query = "SELECT * FROM praticien WHERE nom_praticien = ?";

      // prepare query statement
      $stmt = $this->conn->prepare($query);

      // bind id of product to be updated
      $stmt->bindParam(1, $this->nom_praticien);

      // execute query
      $stmt->execute();

      // get retrieved row
      $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
      $num = $stmt->rowCount();

      if($num>0){
        $praticien_arr["praticiens"]=array();
        $row = array();
        foreach($rows as $row){
          extract($row,EXTR_OVERWRITE);
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
    }
}
?>
