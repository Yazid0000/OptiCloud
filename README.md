# 👓 OPTI CLOUD — Système de Gestion de Cabinet Opticien

OPTI CLOUD est une application web développée en **PHP** avec **WAMP Server**, conçue pour gérer l'ensemble des activités d'un cabinet opticien. Les données sont persistées dans une base **MySQL**.

---

## ✨ Fonctionnalités

### 👥 Gestion des Patients
- Création de fiches patients complètes (nom, téléphone, email, adresse, mutuelle)
- Modification et suppression de patients
- Historique des rendez-vous et prescriptions par patient

### 📅 Rendez-vous
- Planification avec date, heure et motif
- Suivi des statuts : En attente / Confirmé / Terminé / Annulé
- Vue des rendez-vous du jour sur le tableau de bord

### 📋 Prescriptions Optiques
- Saisie complète OD/OG (sphère, cylindre, axe)
- Addition pour la presbytie
- Liaison patient / opticien

### 🛒 Ventes & Paiements
- Création de ventes multi-produits (montures, verres, lentilles)
- Mise à jour automatique du stock à chaque vente
- Suivi des paiements : Espèces, Carte, Chèque, Mutuelle, Virement
- Statuts automatiques : Impayé / Partiel / Payé

### 📦 Gestion du Stock
- Suivi des quantités pour montures, verres et lentilles
- Alertes visuelles pour les stocks faibles (< 5 unités)
- Gestion par catégories et marques

### 🚚 Fournisseurs & Commandes
- Gestion complète des fournisseurs
- Commandes avec détail produits et montants
- Mise à jour automatique du stock à la réception

### 🖨️ Impression
- Page centrale de sélection du module à imprimer
- Impression de tous les modules (patients, ventes, stock...)
- Lancement automatique de l'impression

### 🔐 Authentification & Utilisateurs
- Connexion sécurisée par session PHP
- Gestion des rôles : Admin / Employé
- Administration des comptes utilisateurs

---

## 📸 Captures d'écran

### Tableau de bord
![Tableau de bord](screenshots/dashboard.png)

### Gestion des patients
![Patients](screenshots/patients.png)

### Nouvelle vente
![Ventes](screenshots/ventes.png)

### Prescriptions
![Prescriptions](screenshots/prescriptions.png)

---

## 🛠️ Technologies utilisées

| Technologie | Version / Détail |
|---|---|
| PHP | 5.x |
| MySQL | 5.x |
| WAMP Server | Serveur local |
| Bootstrap | 5.3.2 |
| Bootstrap Icons | 1.11.1 |
| FPDF | 1.86 — Génération PDF |

---

## 🚀 Installation

1. Cloner le dépôt :
```bash
git clone https://github.com/Yazid0000/OPTI_CLOUD_PHP5.git
```

2. Copier le dossier dans le répertoire WAMP :
```
C:\wamp\www\OPTI_CLOUD_PHP5\
```

3. Créer la base de données :
   - Ouvrir phpMyAdmin : `http://localhost/phpmyadmin`
   - Créer une base nommée `opticloud`
   - Importer le fichier `database/Opticloud.sql`

4. Vérifier la connexion dans `connexion.php` :
```php
$con = mysqli_connect("localhost", "root", "", "opticloud");
```

5. Accéder à l'application :
```
http://localhost/www/OPTI_CLOUD_PHP5/
```

### Compte par défaut

| Login | Mot de passe |
|---|---|
| `admin` | `admin` |

> ⚠️ Pensez à changer le mot de passe après la première connexion.

---

## 📁 Structure du projet

```
OPTI_CLOUD_PHP5/
├── index.php               # Tableau de bord
├── login.php               # Page de connexion
├── logout.php              # Déconnexion
├── auth.php                # Protection des pages par session
├── connexion.php           # Connexion base de données
├── layout.php              # Template sidebar + navbar
├── layout_end.php          # Fermeture du template
│
├── patient/                # Gestion des patients
├── rendezvous/             # Gestion des rendez-vous
├── prescription/           # Gestion des prescriptions
├── vente/                  # Gestion des ventes
├── paiement/               # Gestion des paiements
├── monture/                # Stock montures
├── verre/                  # Stock verres
├── lentille/               # Stock lentilles
├── fournisseur/            # Gestion des fournisseurs
├── commande/               # Commandes fournisseurs
├── categorie/              # Catégories produits
├── marque/                 # Marques produits
├── opticien/               # Gestion des opticiens
├── utilisateur/            # Gestion des utilisateurs
├── impression/             # Pages d'impression
├── fpdf/                   # Librairie génération PDF
└── database/
    └── Opticloud.sql       # Script de création de la base
```

---

## 👨‍💻 Auteur

**Yazid Bennouna**
Étudiant en informatique
[@Yazid0000](https://github.com/Yazid0000)

---

## 📄 Licence

Ce projet est développé dans le cadre d'un projet académique.
