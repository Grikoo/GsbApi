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
        $query = "SELECT MAX(id_rapport)+1 AS MAX  FROM rapport_visite";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // create rapport_visite
    public function create(){

        // query to insert record
        $query = "INSERT INTO rapport_visite(id_visiteur, id_praticien, date_rapport, bilan) VALUES (?,?,?,?)";

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
}
?>
