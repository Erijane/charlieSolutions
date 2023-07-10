# Le projet
## Mon ressenti

Au global, de l'installation de l'environnement à la finalisation de ce projet il m'a fallu environ 8 heures. 

Le projet, n'était au commencement pas facile à prendre en main, une petite explication du contenu de la BDD aurait été un plus. il y a de nombreuses choses qui quand on ne travaille pas dans l'IOT de base sont assez flou. 

Afin de répondre aux différentes demandes voici les quelques postulats que j'ai établis:
 - Il était inutile de copier dans la nouvelle table les valeurs quand les trackers avaient une position non vérifiée. Les données n'étant pas exploitables.
 - Pour faire le lien entre un tracker et les capteurs il fallait prendre deux paramètres en compte, l'id du topic et l'id de la trame.
 - Dans le "ble_payload": [ "C ID 003F3F;0;0;-60"] la donnée de l'exemple si contre, étant le RSSI
 - On ne peut pas savoir de façon certaine à tous les coups si un capteur se trouve dans la zone du chantier. En effet, nous ne disposons que de deux choses: la distance tracker -> chantier, et la distance tracker -> capteur, mais pas de la direction. Il existe donc plusieurs possibilités. 
 Ex: 
 Si la distance tracker -> chantier = 450m et la distance tracker -> capteur = 400m, au mieux le capteur see trouve à 50m du chantier et au pire il se trouve à 850m. 

 ## Ce qu'on pourrait améliorer

Des améliorations sont possibles dans ce que j'ai fait. 
- Le graphisme du projet
- Les performances de l'ajout des données dans la nouvelle table. Pour le moment tout ce fait en une seule fois. L'échantillon de données n'était pas énorme cela ne pose pas de soucis, mais sur des millions voire des milliards de ligne cela pourrait causer de gros soucis de performance. Une solution serait de rendre la commande plus dynamique en lui donnant un rang de date à importer. Et d'importer les données jours par jours via des jobs mis dans une queue.

## Lancer le projet

``` 
// cloner le projet dans le répertoire de votre choix
git clone git@github.com:Erijane/charlieSolutions.git
cd charlieSolutions

// Installation des packages requis
composer install
npm install
npm run build

// Lancer le projet, attention docker doit être installée et lancer sur la machine
// Note: cette commande peut prendre du temps la première fois
./vendor/bin/sail up -d 

// Création des tables dans la base de données
./vendor/bin/sail artisan migrate

// Le site est accessible à cette adresse
http://localhost/
```

La première action que vous devrez faire est de créer votre compte utilisateur, pour cela utiliser le bouton "Register" en haut à droite. Une fois connecté vous pourrez voir que l'ensemble des pages sont vides. Ceci est normal car les données ne sont pas encore en BDD. Pour y remédier lancer ces commandes.

``` 
// Ajout des données du dump fourni dans la BDD
./vendor/bin/sail artisan db:seed --class=DatabaseSeeder

// Mise en place de la nouvelle table
./vendor/bin/sail artisan app:convert-data
``` 

Une fois la commande lancer les données seront visibles sur les différentes pages.

## Tests

Des tests sont disponibles sur le projet, pour les lancer il vous suffira d'exécuter la commande suivante:
``` 
./vendor/bin/sail artisan test
``` 

