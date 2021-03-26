<?php
class medicament{

    // database connection and table name
    private $conn;
    private $table_name = "medicament";

    // object properties
    public $nom_commercial;
    public $id_famille;
    public $composition;
    public $effets;
    public $contre_indication;
    public $prix_echantillon;
    public $depot_legal;
    public $public_famille;
    public $code_famille;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){

      $query = "SELECT * FROM medicament INNER JOIN famille";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
    // used when filling up the update product form
    public function readOne(){
        // query to read single record
        $query = "SELECT medicament.*,famille.* FROM medicament INNER JOIN famille ON medicament.id_famille = famille.id_famille WHERE medicament.depot_legal = ? ORDER BY 1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->depot_legal);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->nom_commercial = $row['nom_commercial'];
        $this->id_famille = $row['id_famille'];
        $this->lib_famille = $row['lib_famille'];
        $this->code_famille = $row['code_famille'];
        $this->composition = $row['composition'];
        $this->effets = $row['effets'];
        $this->contre_indication = $row['contre_indication'];
        $this->prix_echantillon = $row['prix_echantillon'];

    }
}
?>
