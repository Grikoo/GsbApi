# GsbApi
Actuellement ce que l'on peut obtenir avec l'api :

# RAPPORT VISITE (en cours)
GET rapport_visite - /rapport_visite/read.php

GET Max numéro rapport_visite - /rapport_visite/readMax.php

POST rapport_visite - /rapport_visite/create.PHP

id_visiteur : int id_rapport : int id_praticien : int motif: string bilan: sting

# PRATICIEN
POST departement praticien /praticien/readDep.php user : GSB pwd : GSB id : dp_praticien (numero du departement)

POST with id, praticien - /praticien/read_one.php?id= user : GSB pwd : GSB id : id_praticien

POST praticien - /praticien/read.php user : GSB pwd : GSB

POST praticien - /praticien/readNbDep.php user : GSB pwd : GSB id : dp_praticien (numero du departement)

# medicament (non securisé)
GET with id, medicament - /medicament/read_one.php?id=

GET medicament - /medicament/read.php

# VISITEUR (non securisé)
GET visiteur - /visiteur/read.php

GET with id, visiteur - /visiteur/read_one.php?id=

# login
login : GSB / password : GSB

PEZZALI Benjamin HEULIN Damien ISSAAD Ricky
