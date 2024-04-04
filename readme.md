# Installation de wampp server : 

- Aller sur le site : https://wampserver.aviatechno.net/ 
- Télécharger l'exécutable compatible avec la version de ton pc.
- Tu auras besoin de'un certain nombre de truc VC : il faut laisser ce exécutable faire le nécessaire pour toi : https://github.com/abbodi1406/vcredist/releases/download/v0.80.0/VisualCppRedist_AIO_x86_x64.exe 
- Tu pourras maintenant passer et réaliser l'installation 
- A ce stade, tu as un server Apache installé et un server MySql installés sur ta machine. 
- Tu vas retrouver la racine de ton serveur sur ton PC dans la partie : C:\wamp64
- Teste la réussite de l'installation en tapant : locaclhost dans ton navigateur. Tu devrais voir des trucs wamp s'afficher.

# Code PHP 
- Tout le code php devra être écrit et déposé dans le dossier www situé à la racine de ton wamp server : C:\wamp64\www
- Cree un dossier du nom du projet et met tout ton code inside of it. 
- Nomme un fichier index.html; ce sera le point d'entrée dans ton site à chaque fois que la page est chargée ( je te recomende de renommer le Bienvenu)
- Maintenant tu peux créer des fichier .php, .html, ... Les fichiers .php seront interprétés vers du html avant d'être affichés au niveau du navigateur

# Configuration de mysql database : 
- La base de donnée est accessible au niveau de : http://localhost/phpmyadmin
- username : root sans mot de passe