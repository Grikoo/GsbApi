# GsbApi
Actuellement ce que l'on peut obtenir avec l'api :

# LOGIN
{
    "user":"gsb",
    "pwd":"gsb"
}

Pour récupérer le token et la durée de validité, il faut renseigner le json ci-dessous dans le body de la requête. (/token.php)
Puis, les requêtes seront effectuées en renseigner dans le body un json contenant le login, le mot de passe, le token et la durée de validité
Exemple:
{
    "user":"gsb",
    "pwd":"gsb",
    "token":"92755bf0e36fc4db72118c5a47d5d762c95f0ce8",
    "valid": 1618994892
}

# RAPPORT VISITE 
POST rapport_visite - /rapport_visite/read.php

POST Max numéro rapport_visite - /rapport_visite/readMax.php

POST rapport_visite - /rapport_visite/create.PHP
id_visiteur : int id_rapport : int id_praticien : int motif: string bilan: sting

POST rapport_visite - /rapport_visite/read_one.PHP?id_praticien=
id_praticien : int

# PRATICIEN
POST departement praticien /praticien/readDep.php

POST with id, praticien - /praticien/read_one.php?id= 
id : id_praticien

POST praticien - /praticien/read.php

POST praticien - /praticien/readNbDep.php?id= 
id : dp_praticien (numero du departement)

POST praticien - /praticien/readNomPrat.php?id= 
id : nom_praticien (nom du praticien)

# medicament
POST with id, medicament - /medicament/read_one.php?id= 
id : depot_legal

POST medicament - /medicament/read.php

# VISITEUR
POST visiteur - /visiteur/read.php

POST with id, visiteur - /visiteur/read_one.php?id= 
id : id_visiteur



PEZZALI Benjamin HEULIN Damien ISSAAD Ricky
