# GsbApi
Actuellement ce que l'on peut obtenir avec l'api :

# login
login : GSB / password : GSB 

il faut se log grace a connection pour recevoir son token et son temp de validité
il faut les POST dans le BODY avec le login et password

# RAPPORT VISITE (en cours)
GET rapport_visite - /rapport_visite/read.php

GET Max numéro rapport_visite - /rapport_visite/readMax.php

POST rapport_visite - /rapport_visite/create.PHP

id_visiteur : int id_rapport : int id_praticien : int motif: string bilan: sting

# PRATICIEN
POST departement praticien /praticien/readDep.php id : dp_praticien (numero du departement)

POST with id, praticien - /praticien/read_one.php?id= id : id_praticien

POST praticien - /praticien/read.php

POST praticien - /praticien/readNbDep.php?id= id : dp_praticien (numero du departement)

# medicament (non securisé)
POST with id, medicament - /medicament/read_one.php?id=

POST medicament - /medicament/read.php

# VISITEUR (non securisé)
GET visiteur - /visiteur/read.php

GET with id, visiteur - /visiteur/read_one.php?id=



PEZZALI Benjamin HEULIN Damien ISSAAD Ricky
