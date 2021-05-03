<?php
class rapport_visite{

    // database connection and table name
    private $conn;
    private $table_name = "rapport_visite";

    // object properties
    public $id_visiteur;
    public $id_rapport;
    public $id_praticien;
    public $date_rapport;
    public $bilan;
    public $motif;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){

      $query = "SELECT id_visiteur,id_rapport,bilan,id_praticien,date_rapport,motif FROM rapport_visite  ORDER BY id_rapport";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function readMax(){

        // query to read single record
        $query = "SELECT COUNT(*) AS MAX  FROM rapport_visite";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create rapport_visite
    public function create(){

        // query to insert record
        $query = "INSERT INTO rapport_visite(id_visiteur, id_praticien, date_rapport, bilan, motif) VALUES (?,?,?,?,?)";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id_visiteur=htmlspecialchars(strip_tags($this->id_visiteur));
        $this->id_praticien=htmlspecialchars(strip_tags($this->id_praticien));
        $this->date_rapport=htmlspecialchars(strip_tags($this->date_rapport));
        $this->bilan=htmlspecialchars(strip_tags($this->bilan));
        $this->motif=htmlspecialchars(strip_tags($this->motif));


        $stmtMax = $this->readMax();
        $rowMax = $stmtMax->fetch(PDO::FETCH_ASSOC);
        $this->id_rapport= $rowMax['MAX'];


        return true;

    }
    public function getRapportofpraticien(){
        $query = "SELECT * from rapport_visite where rapport_visite.id_praticien = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_praticien);

        // execute query
        $stmt->execute();
        $rows = $stmt->fetchall(PDO::FETCH_ASSOC);
        $num = $stmt->rowCount();

        if($num>0){
            if($num>0){
                $rapport_visite["rapport_visite"]=array();
                $row = array();
                foreach($rows as $row){
                  extract($row,EXTR_OVERWRITE);
                    $rapport_item=array(
                      "id_praticien" => $id_praticien,
                      "date" => $date_rapport,
                      "motif" => $motif,
                      "bilan" => $bilan
                    );
                    array_push($rapport_visite["rapport_visite"], $rapport_item);
                }
                echo json_encode($rapport_visite, JSON_PRETTY_PRINT);
              }
        }

        

    }
}
?>
