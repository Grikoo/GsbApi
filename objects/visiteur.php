<?php
class visiteur{

    // database connection and table name
    private $conn;
    private $table_name = "visiteur";

    // object properties
    public $id_visiteur;
    public $nom_visiteur;
    public $date_embauche;
    public $prenom_visiteur;
    public $adresse_visiteur;
    public $cp_visiteur;
    public $ville_visiteur;
    public $id_labo;
    public $id_secteur;
    public $nom_labo;
    public $code_secteur;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
      $query = "SELECT visiteur.*, labo.nom_labo, secteur.code_secteur FROM visiteur INNER JOIN labo ON visiteur.id_labo = labo.id_labo INNER JOIN secteur ON visiteur.id_secteur = secteur.id_secteur ORDER BY 1";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
    // used when filling up the update product form
    public function readOne(){

        // query to read single record
        $query = "SELECT visiteur.*, labo.nom_labo, secteur.code_secteur FROM visiteur INNER JOIN labo ON visiteur.id_labo = labo.id_labo INNER JOIN secteur ON visiteur.id_secteur = secteur.id_secteur WHERE visiteur.id_visiteur = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_visiteur);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->nom_visiteur = $row['nom_visiteur'];
        $this->date_embauche = $row['date_embauche'];
        $this->prenom_visiteur = $row['prenom_visiteur'];
        $this->adresse_visiteur = $row['adresse_visiteur'];
        $this->cp_visiteur = $row['cp_visiteur'];
        $this->ville_visiteur = $row['ville_visiteur'];
        $this->nom_labo = $row['nom_labo'];
        $this->code_secteur = $row['code_secteur'];
    }
}
?>
