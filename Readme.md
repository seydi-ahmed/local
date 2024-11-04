# Privilège Escalation - Projet "Local"

## Objectif
Ce projet consiste à obtenir un accès root sur la machine virtuelle 01-Local1.ova fournie. La méthodologie inclut des techniques de privilège escalation tout en respectant les restrictions imposées (pas de modification dans GRUB ni dans la VM).

## Pré-requis
- VirtualBox installé pour exécuter la machine virtuelle.
- Kali Linux ou tout autre système d'exploitation avec des outils de pentest pourrait être utile pour attaquer la VM si nécessaire.

## Etapes pas à pas
### Importer la VM dans VirtualBox
- Ouvrez VirtualBox.
- Dans File > Import Appliance, sélectionnez le fichier ```01-Local1.ova```.
- Importez la VM et démarrez-la.

### Obtenir un Accès de Base
1. Identifier le point d'entrée:
- La machine n'affiche pas d'adresse IP visible. Vérifiez les interfaces réseau.
- Utilisez des commandes de base telles que ip a ou ifconfig pour identifier toute adresse de loopback ou de type réseau local.
2. Scanner le Réseau Local
- Si aucune IP n'est détectée directement, il est possible que la machine soit connectée en réseau NAT ou ponté.
Lancez une analyse sur le réseau local depuis votre machine hôte pour détecter d'éventuelles ouvertures.