# télécharger
```01-Local1.ova```

# mettez ceci 
```sha1sum 01-Local1.ova```

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

# mettre ceci
ftp 192.168.1.26
login: anonymous
pwd: Entrée (le bouton)

# gobuster dir -u http://192.168.1.26/ -w /usr/share/wordlists/dirb/common.txt 

# curl http://192.168.1.26/files/

