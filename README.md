#  Portfolio numérique interactif

## 🌟 Description du Projet
Projet de portfolio numérique interactif conçu pour présenter efficacement des projets réalisés en analyse de données, visualisation interactive et automatisation des processus. Ce portfolio permet de valoriser les compétences et faciliter les interactions professionnelles. La mise à jour du contenu est simplifiée grâce à l'intégration directe de données provenant de fichiers aux formats .xlsx et .docx.

## 💡 Fonctionnalités
- Présentation des projets réalisés
- Navigation fluide avec sidebar responsive
- Carrousel dynamique pour la présentation des projets
- Interface utilisateur intuitive avec thèmes clair et sombre
- Animations CSS et JavaScript interactives
- Formulaire de contact intégré avec gestion automatique des réponses
- Compatibilité et optimisation sur tous types d’appareils et orientations

## 💪 Technologies Utilisées
- **Front-end** : HTML5, CSS3, JavaScript
- **Back-end** : PHP
- **Animation & Interactivité** : CSS Animations, JavaScript
- **Responsive Design** : Flexbox, CSS Media Queries

## 🗃️ Structure du projet
```
portfolio                                    
├── data                                     # Dossier contenant les documents et fichiers source pour le contenu du portfolio
│   ├── **.xlsx  ou  **.docx                 # Document présentant le profil 
│   └── projets                              # Données spécifiques à chaque projet présenté
│       └── x_**.xlsx                        # Fichier de données pour un projet (1 fichier par projet)
│
├── src                                      # Code source côté serveur
│
├── www                                      # Accessible par le serveur web (racine web publique)
│   ├── css                                  # Feuilles de style CSS
│   ├── images                               
│   │   ├── icons                            # Icônes pour l'interface utilisateur et navigation
│   │   ├── illustrations                    # Images diverses pour l'interface utilisateur et navigation
│   │   ├── portraits                        # Photo personnel ou professionnel
│   │   │ 
│   │   └── projets                          # Images spécifiques liées aux projets
│   │       ├── data                         # Images illustrant les jeux de données utilisés
│   │       ├── global                       # Images globales ou génériques pour les projets
│   │       └── results                      # Images des résultats finaux des projets (visualisations, graphiques, etc.)
│   │ 
│   ├── js                                   # Scripts JavaScript
│   ├── videos                               # Vidéos intégrées pour illustrer les projets ou présenter le portfolio
│   ├── fiche_projet.php                     # Afficher les détails d’un projet
│   └── index.php                            # Page d'accueil du portfolio
│ 
├── LICENSE                                
├── README.md                                
├── composer.json                            # Fichier de gestion des dépendances PHP via Composer
└── composer.lock                            # Fichier généré par Composer pour bloquer les versions des dépendances installées

```

## 🛠 Installation et Exécution
### Prérequis
- Un serveur web tel qu’Apache
- PHP 8.1 ou supérieur
- Navigateur web moderne (Chrome, Firefox, Safari, etc.)

### 🛠 Installation rapide avec Composer (PHP)

Copiez-collez les commandes suivantes directement dans votre terminal :

```bash
# Se mettre dans le dossier souhaité
cd chemin_de_clone

# Cloner le dépôt et entrer dans le dossier
git clone https://github.com/Dim2960/portfolio && cd portfolio

# Vérifier si Composer est installé, sinon l'installer localement
if ! command -v composer &> /dev/null
then
    echo "Composer non détecté, installation en cours..."
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    php -r "unlink('composer-setup.php');"
else
    echo "Composer est déjà installé."
fi

# Installer les dépendances PHP du projet
composer install
```
Cette procédure installe toutes les dépendances nécessaires à l’exécution du projet.


### 📝 Mise à jour du contenu via fichiers `.xlsx` et `.docx`

Le portfolio utilise des fichiers aux formats `.xlsx` (Excel) et `.docx` (Word) afin de simplifier la gestion, la mise à jour et l'intégration des contenus. Voici les instructions détaillées pour remplir et mettre à jour ces fichiers correctement :

#### 📑 Fichiers `.docx`

Ces fichiers servent à saisir des informations textuelles telles que la présentation personnelle (`a_propos.docx`) et l'email de confirmation de contact (`data_contact.docx`).

**Exemple : `a_propos.docx`**

- Ouvrir le fichier dans Microsoft Word ou un éditeur compatible (comme Google Docs ou LibreOffice).
- Modifier le texte directement dans le document. Il est possible de mettre en forme dans le document (gras, souligné, lien hypertexte ...)
- Ne pas inserer d'images ou d'éléments graphiques dans le document.
- Sauvegarder les modifications en conservant le nom exact du fichier original pour permettre une intégration automatique.

#### 📊 Fichiers `.xlsx`

Ces fichiers contiennent des données structurées relatives aux informations personnelles `data_accueil.xslx`, aux meta données des pages web `data_meta.xlsx`et aux projets `[x_nom_projet].xslx`.

**Exemple : `7_analyse_NYC_Taxi.xlsx`**

Voici comment procéder :

1. **Structure du fichier Excel**
   - La colonne A contient les en-têtes de données qui sont utilisé dans le script PHP.
   - La colonne B contient les informations à remplir Chaque ligne correspond à une entrée individuelle de données ou une observation unique.
   - Certaines informations doivent être obligatoirement remplies pour garantir l'intégration (représenté en police rouge).

2. **Mise à jour des données**
   - Ouvrir le fichier `.xlsx` avec Microsoft Excel, Google Sheets ou LibreOffice Calc. 
   - Cas particulier des fiches projets > ajouter un fichier par projet dans le dossier `data/projets`. Le nommer en commençant par son numéro puis son titre.  
   - Ajouter ou modifier les données dans la colonne B.
   - Sauvegarde ton fichier Excel en conservant le nom et l'emplacement d'origine afin d'assurer une intégration automatique sans erreurs.

3. **Bonnes pratiques pour les données Excel**
   - Utiliser un format texte.
   - Éviter de modifier la structure du fichier et les formats qui pourrait ne pas être pris en charge par le script d'intégration.

#### 🔄 Mise à jour et intégration au portfolio

Après avoir modifié les fichiers `.xlsx` et `.docx` :

- Placer les dans les dossiers appropriés :
  ```
  portfolio/
  └── data/
      ├── a_propos.docx
      ├── data_contact.docx
      ├── data_accueil.xslx
      ├── data_meta.xlsx
      └── projets/
          └── [x_nom_projet].xlsx
  ```

- Le script intégrera automatiquement ces modifications lors du chargement de la page web.

**Remarque importante :**  
Toujours effectuer une sauvegarde des anciens fichiers avant de procéder à des modifications majeures, afin de pouvoir restaurer rapidement en cas de problème.

## 🔍 Utilisation
1. Accédez au site 
2. Naviguez à travers les sections grâce à la sidebar ou aux boutons de défilement
3. Consultez les détails des projets dans le carrousel interactif
4. Contact via le formulaire dédié

## 🌐 Déploiement
Le projet peut être facilement déployé sur tout hébergeur web supportant PHP, comme OVH ou un serveur Apache traditionnel.

## 📚 Licence
Ce projet est distribué sous licence MIT. Vous êtes libre d’utiliser, modifier et distribuer le contenu du projet en respectant les conditions de la licence.

## 📚 Contribution
Toutes les contributions, suggestions ou corrections de bugs sont les bienvenues. Merci d'ouvrir une issue ou de soumettre directement une pull request pour toute amélioration.

