# LOCAL

Pour ce projet de privilège escalation, je vais vous fournir un guide détaillé. L'objectif est d'obtenir un accès root à une machine virtuelle fournie sans modifier GRUB ou les paramètres de la VM. Le tout sera documenté dans un fichier unique qui contiendra les étapes à suivre pour exploiter la machine cible.

Fichier: local_steps.md
Voici les étapes à inclure dans votre fichier local_steps.md :

Privilège Escalation - Projet "Local"
Objectif
Ce projet consiste à obtenir un accès root sur la machine virtuelle 01-Local1.ova fournie. La méthodologie inclut des techniques de privilège escalation tout en respectant les restrictions imposées (pas de modification dans GRUB ni dans la VM).

Pré-requis
VirtualBox installé pour exécuter la machine virtuelle.
Kali Linux ou tout autre système d'exploitation avec des outils de pentest pourrait être utile pour attaquer la VM si nécessaire.
Etapes pas à pas
1. Importer la VM dans VirtualBox
Ouvrez VirtualBox.
Dans File > Import Appliance, sélectionnez le fichier 01-Local1.ova.
Importez la VM et démarrez-la.
2. Obtenir un Accès de Base
a) Identifier le point d'entrée
La machine n'affiche pas d'adresse IP visible. Vérifiez les interfaces réseau.
Utilisez des commandes de base telles que ip a ou ifconfig pour identifier toute adresse de loopback ou de type réseau local.
b) Scanner le Réseau Local
Si aucune IP n'est détectée directement, il est possible que la machine soit connectée en réseau NAT ou ponté.

Lancez une analyse sur le réseau local depuis votre machine hôte pour détecter d'éventuelles ouvertures.
bash
Copy code
sudo nmap -sP 192.168.0.0/24
Notez l'adresse IP obtenue. Utilisez ensuite cette adresse pour établir une connexion SSH ou autre.
c) Accéder à la VM via SSH (si accessible)
bash
Copy code
ssh user@<adresse_ip>
Remplacez <adresse_ip> par l'adresse IP détectée.
Utilisez les informations d'identification de base si elles sont fournies.
3. Analyser les Permissions et Identifier des Failles Potentielles
Une fois dans la machine, cherchez des informations pouvant mener à une escalade de privilège.

a) Vérifier les permissions SUID
Certaines commandes ou exécutables peuvent avoir le bit SUID défini, permettant à n'importe quel utilisateur d'exécuter le fichier avec les privilèges du propriétaire (souvent root).

bash
Copy code
find / -perm -4000 2>/dev/null
Notez tous les binaires SUID listés, car certains peuvent être vulnérables.

b) Examiner les tâches cron
Les tâches cron s'exécutent automatiquement, parfois avec des privilèges root.

bash
Copy code
cat /etc/crontab
ls -la /etc/cron.*
Vérifiez si des scripts ou commandes exécutés par cron peuvent être manipulés.

4. Escalader les Privilèges
À partir des informations collectées, choisissez une méthode d'escalade de privilège :

a) Exploiter un binaire SUID vulnérable
Si un binaire SUID est vulnérable, recherchez les exploits associés dans des bases comme GTFOBins (https://gtfobins.github.io/).
Exécutez le binaire avec des privilèges pour vérifier si vous pouvez obtenir un accès root.
b) Manipuler un Script cron
Si un script exécuté par cron est modifiable, insérez une commande pour obtenir un shell root.

Par exemple, si myscript.sh s'exécute chaque minute :
bash
Copy code
echo "cp /bin/bash /tmp/rootbash; chmod +s /tmp/rootbash" >> /path/to/myscript.sh
Attendez que le cron s'exécute, puis lancez /tmp/rootbash -p pour obtenir un accès root.
c) Exécuter une commande de privilège escalation
Utilisez des commandes comme sudo si elles sont accessibles.
bash
Copy code
sudo -l
Si un programme peut être exécuté avec sudo sans mot de passe, exploitez-le pour obtenir un shell root.
5. Vérification et Capture du Drapeau
Une fois root, accédez au fichier flag en utilisant :
bash
Copy code
cat /root/flag.txt
Notez le contenu du drapeau pour valider l’accès root.
Conseils de Sécurité
Ce projet est strictement éducatif. Ne réalisez jamais de telles opérations sans l'autorisation explicite du propriétaire de la machine.

Ce fichier local_steps.md documente toutes les étapes nécessaires pour atteindre l'accès root, de l'importation de la VM à l'acquisition finale du drapeau, tout en respectant les restrictions imposées.