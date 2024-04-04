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

# Confi git :

En local :
Installer git sur son pc (le faire avec git bash est plus facile)
dans gitbash executer les commandes en remplaçant parles bonnes valeurs :

```sh
$ git config --global user.name "John Doe"
$ git config --global user.email johndoe@example.com
```

## 2 recupérer le code

- Créer un dossier de ton choix, idéalement le htdocs où tu exécuter le serveur
- Ensuite aller dans git bash ou cmd ou le terminale de ton éditeur et être dans le dossier
- exécuter la commande :

```sh
 git clone https://github.com/braviomichel/biblioexchange.git

```

- puis :

```sh
cd biblioexchange

```

### Le code est maintenant sur ton pc, tu peux faire des odifications comme tu veux

` après avoir fait tes modifications, il te suffit de te mettre dans un terminal dans le dossier git (ici biblioexchange utilisé précédemment) et d'exécuter les commandes ci-après pour que moi j'y ai accès`

```sh
git add .
git commit -m"Un message de ton choix"
git branch unNomdeTonChoix
git push origin unNomdeTonChoix

```

`après si j'ai eu à faire des mofifications , pour que tu les rcupères, il te faudra exécuter dans ton dossier biblioexchange local : `

```sh
git pull origin main


```

### et tu les auras automatiquement
