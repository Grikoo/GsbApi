# GsbApi
Actuellement ce que l'on peut obtenir avec l'api :

# LOGIN
user : gsb / pwd : gsb 

il faut se log grace a connection pour recevoir son token et son temp de validité
il faut les POST dans le BODY avec le login et password

# RAPPORT VISITE (create a verif)
POST rapport_visite - /rapport_visite/read.php

POST Max numéro rapport_visite - /rapport_visite/readMax.php

POST rapport_visite - /rapport_visite/create.PHP

id_visiteur : int id_rapport : int id_praticien : int motif: string bilan: sting

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
