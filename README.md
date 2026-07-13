# 🎙️ Podcast-Finder API

Podcast-Finder est une API RESTful développée avec **Laravel 10**, permettant aux utilisateurs de rechercher, écouter et découvrir des podcasts selon leurs intérêts.  
Elle fournit des endpoints sécurisés pour gérer les podcasts, épisodes et animateurs, avec un système **d’authentification et de rôles**.

---

## 📌 Contexte du projet

Vous êtes recruté comme développeur backend au sein d’une start-up spécialisée dans l’audio digital, qui souhaite créer une API Laravel pour une plateforme de découverte et de gestion de podcasts.

Cette API permettra aux utilisateurs de rechercher, écouter et découvrir des podcasts selon leurs centres d’intérêt, tandis que les administrateurs pourront gérer les podcasts, épisodes et animateurs via des endpoints sécurisés.

---

## 👤 User Stories

### Utilisateur :
- 📝 Créer un compte avec prénom, nom, email et mot de passe sécurisé.  
- 🔑 Se connecter et se déconnecter.  
- 🔄 Réinitialiser son mot de passe.  
- 🎧 Consulter la liste des podcasts disponibles.  
- 🔍 Rechercher un podcast ou un épisode par titre, genre ou animateur.  
- 📖 Afficher les détails d’un podcast (description, épisodes, animateur).

### Animateur :
- 🎙️ Créer un podcast pour publier des épisodes.  
- ✏️ Modifier ses propres podcasts et informations (titre, description, image).  
- ➕ Ajouter des épisodes à ses podcasts.  
- ✏️ Modifier ses propres épisodes (titre, description, fichier audio).  
- 🗑️ Supprimer ses podcasts ou épisodes si nécessaire.  
- 📋 Consulter la liste de ses podcasts et épisodes publiés.

### Administrateur :
- 🛠️ Ajouter, modifier et supprimer des podcasts, épisodes et animateurs.  
- 👥 Gérer les utilisateurs : suppression ou changement de rôle.

---

## 🔗 Endpoints API

### Authentification :
- 📝 Créer un utilisateur  
- 🔑 Authentification et génération de token JWT  
- 🔒  Déconnexion de l’utilisateur

### Podcasts

**Admin et Animateur (création/modification) :**  
- ➕ Créer un podcast  
- ✏️ Modifier un podcast  
- 🗑️ Supprimer un podcast  

**Tous les utilisateurs :**  
- 🎧 Lister tous les podcasts  
- 📖 Afficher les détails d’un podcast

### Épisodes

**Admin et Animateur (création/modification) :**  
- ➕ Ajouter un épisode à un podcast  
- ✏️ Modifier un épisode  
- 🗑️ Supprimer un épisode  

**Tous les utilisateurs :**  
- 📋 Lister les épisodes d’un podcast  
- 📖 Afficher les détails d’un épisode

### Animateurs

**Tous les utilisateurs :**  
- 👤 Lister tous les animateurs  
- 📖 Afficher les détails d’un animateur

### Recherche
- 🔍 Rechercher des podcasts par titre, catégorie ou animateur  
- 🔍 Rechercher des épisodes par titre, podcast ou date

### Gestion des utilisateurs (Admin)
- 👥 Lister tous les utilisateurs  
- ➕ Créer un utilisateur avec rôle  
- ✏️ Modifier les informations ou le rôle d’un utilisateur  
- 🗑️ Supprimer un utilisateur

---

## ⚙ Fonctionnalités principales

- 🔒 **Authentification et rôles** → Sécurisation via Laravel Sanctum  
- ✅ **Validation et Form Requests** → Centralisation de la validation des données et fichiers multimédias  
- 🔎 **Recherche multi-critères** → Filtrage avancé des podcasts et épisodes  
- 🛠️ **Gestion utilisateurs et animateurs** → CRUD complet avec rôles et permissions  
- 📄 **Documentation API** → Swagger pour visualiser et tester les endpoints  
- 🧪 **Tests automatisés** → PHPUnit pour garantir la fiabilité et la stabilité de l’API

---

## 🧱 Architecture technique

### Backend (API)
- **Framework** : Laravel 10
- **Base de données** : MySQL  
- **ORM** : Eloquent  
- **Authentification** : JWT via Laravel Sanctum  
- **Architecture** : MVC (API RESTful)   

### Tests
- **Tests automatisés** : PHPUnit (Feature)  
- **Tests manuels** : Postman pour tous les endpoints  

---

## 👩‍💻 Réalisé par

**HOUSNA FATHI** - Développeuse web full-stack
**SALMA HARDA** - Formatrice
