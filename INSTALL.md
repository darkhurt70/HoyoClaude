# Guide d'installation rapide

## Étapes d'installation

### 1. Configurer la base de données

#### Option A : Via phpMyAdmin
1. Ouvrez phpMyAdmin dans votre navigateur
2. Cliquez sur "Importer"
3. Sélectionnez le fichier `database.sql`
4. Cliquez sur "Exécuter"

#### Option B : Via ligne de commande
```bash
mysql -u root -p < database.sql
```

### 2. Configurer la connexion

Le fichier `Config/dev.ini` a déjà été créé avec des valeurs par défaut :

```ini
[DB]
dsn = 'mysql:host=localhost;dbname=mihoyo_collection;charset=utf8'
user = 'root'
pass = ''
```

**Modifiez ce fichier si nécessaire** avec vos paramètres MySQL.

### 3. Vérifier l'installation de Plates

Plates a normalement été téléchargé et installé automatiquement dans `Vendor/Plates/`.

Si ce n'est pas le cas :
1. Téléchargez https://github.com/thephpleague/plates/archive/refs/tags/v3.5.0.zip
2. Extrayez le contenu
3. Placez le dossier dans `Vendor/Plates/`

### 4. Démarrer le serveur

#### Si vous utilisez XAMPP :
1. Démarrez Apache et MySQL
2. Ouvrez http://localhost/Claude/

#### Si vous utilisez le serveur PHP intégré :
```bash
php -S localhost:8000
```
Puis ouvrez http://localhost:8000

## Vérification

Vous devriez voir :
- La page d'accueil avec une liste de personnages de test
- Un menu de navigation en haut
- Des cartes de personnages avec images

## Connexion

Utilisez ces identifiants pour tester l'authentification :
- **Username:** admin / **Password:** admin
- **Username:** test / **Password:** test

## En cas de problème

### Erreur "Aucun fichier de configuration trouvé"
→ Vérifiez que `Config/dev.ini` existe

### Erreur de connexion à la base
→ Vérifiez les paramètres dans `Config/dev.ini`
→ Vérifiez que MySQL est démarré

### Page blanche
→ Vérifiez les logs d'erreur PHP
→ Activez l'affichage des erreurs en ajoutant en haut de `index.php` :
```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### Erreur Plates
→ Vérifiez que `Vendor/Plates/src/` existe et contient les fichiers PHP

## Prêt à l'emploi !

Votre application est maintenant prête. Consultez le README.md pour plus de détails sur l'utilisation.
