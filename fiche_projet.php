<?php
session_start();

// recupération de la variable post['id'] pour identifier le projet
if (isset($_POST['id'])) {
    // Validation : l'entier doit être entre 0 et 100
    $id = filter_var(
        $_POST['id'],
        FILTER_VALIDATE_INT,
        array("options" => array("min_range" => 0, "max_range" => 100))
    );

    if ($id !== false) {
        $_SESSION['id'] = $id;
    } else {
        echo "Erreur : la valeur doit être un entier compris entre 0 et 100.";
    }

} else {
    die("Erreur : aucune donnée reçue.");
}


// Inclusion de l'autoloader de Composer pour charger PhpSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Définir le chemin vers le fichier Excel
$inputFileName = 'assets/data/data.xlsx';

try {
    // Charger le fichier Excel
    $spreadsheet = IOFactory::load($inputFileName);
    $worksheet = $spreadsheet->getActiveSheet();
    // Conversion de la feuille en tableau PHP
    $rows = $worksheet->toArray();
} catch(Exception $e) {
    die('Erreur lors de la lecture du fichier Excel : ' . $e->getMessage());
}

// On considère que la première ligne contient les en-têtes, on la saute
$firstRow = true;
foreach ($rows as $row) {
    if ($firstRow) {
        $firstRow = false;
        continue;
    }
    

    if ($row[0] == $_SESSION['id']) {

        // Adapter les indices en fonction de votre fichier Excel
        $titre       = isset($row[1]) ? $row[1] : 'Titre non défini';
        $description = isset($row[2]) ? $row[2] : 'Description non disponible';
        $image_url = isset($row[3]) ? $row[3] : 'url image non disponible';
        $image_alt = isset($row[4]) ? $row[4] : 'alt image non disponible';
        $tags = isset($row[5]) ? $row[5] : 'tags image non disponible';
        $description_detail = isset($row[6]) ? $row[6] : ' non disponible';
        $objectif = isset($row[7]) ? $row[7] : ' non disponible';
        $Probleme_resolu = isset($row[8]) ? $row[8] : ' non disponible';
        $data_source = isset($row[9]) ? $row[9] : ' non disponible';
        $data_size = isset($row[10]) ? $row[10] : ' non disponible';
        $data_type = isset($row[11]) ? $row[11] : ' non disponible';
        $data_remark = isset($row[12]) ? $row[12] : ' non disponible';
        $project_steps = isset($row[13]) ? $row[13] : ' non disponible';
        $technos = isset($row[14]) ? $row[14] : ' non disponible';
        $results = isset($row[15]) ? $row[15] : ' non disponible';
        $difficulties_learns = isset($row[16]) ? $row[16] : ' non disponible';
        $potential_improvements = isset($row[17]) ? $row[17] : ' non disponible';
        $powerbi_link = isset($row[18]) ? $row[18] : ' non disponible';
        $github_link = isset($row[19]) ? $row[19] : ' non disponible';
        $streamlit_link = isset($row[20]) ? $row[20] : ' non disponible';
        $video_link = isset($row[21]) ? $row[21] : ' non disponible';

        break;
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Titre et Meta Description pour le SEO -->
    <title>Portfolio – Dimitri Lefebvre</title>
    <meta name="description" content="Portfolio de Dimitri Lefebvre, Data Analyst certifié PL300 en Power BI, expert en data visualisation, computer vision, Python, SQL et HTML/CSS. 17 ans d'expérience dans l'industrie chimique appliquée aux industries de process (chimie, agroalimentaire, pharma).">
    <meta name="keywords" content="Data Analyst, dataviz, Power BI, PL300, Computer Vision, Python, HTML, CSS, SQL, Industrie Chimique, Agroalimentaire, Pharma">
    
    <!-- URL canonique -->
    <link rel="canonical" href="https://www.portfolio-dimitri-lefebvre.fr/">
    
    <!-- Favicon -->
    <link rel="icon" href="assets/images/icones/favicon.ico">
    
    <!-- Open Graph / Réseaux Sociaux -->
    <meta property="og:title" content="Portfolio – Dimitri Lefebvre">
    <meta property="og:description" content="Data Analyst certifié RNCP, certifié PL300, spécialisé en dataviz, computer vision et SQL. Découvrez mes projets et mon parcours professionnel.">
    <meta property="og:image" content="https://www.portfolio-dimitri-lefebvre.fr/assets/images/og-image.jpg">
    <meta property="og:url" content="https://www.portfolio-dimitri-lefebvre.fr/">
    <meta property="og:type" content="website">
    
    
    <!-- Feuille de style principale -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fiche_projet.css">
    <!-- Feuille de style carousel des projets -->
    <link rel="stylesheet" href="assets/css/carousel-projets.css">
    <!-- Feuille de style pour l'adaptation responsive -->
    <link rel="stylesheet" href="assets/css/responsive_portrait.css">
    <link rel="stylesheet" href="assets/css/responsive_landscape.css">
    
    <!-- Données structurées (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "Lefebvre Dimitri",
        "jobTitle": "Data Analyst",
        "url": "https://www.portfolio-dimitri-lefebvre.fr",
        "description": "Data Analyst certifié PL300, spécialisé en dataviz, computer vision, Python, SQL, HTML et CSS avec 17 ans d'expérience dans l'industrie chimique appliquée aux industries de process.",
        "knowsAbout": [
            "Data Visualisation",
            "Power BI",
            "Computer Vision",
            "Python",
            "SQL",
            "HTML",
            "CSS",
            "Industrie Chimique",
            "Agroalimentaire",
            "Pharma",
            "Industrie de process"
        ],
        "certifications": "PL300",
        "sameAs": [
            "https://www.linkedin.com/in/dim-lefebvre60"
        ]
    }
    </script>
</head>
<body>

    <!-- Header avec logo, navigation et appel à l'action -->
    <header class="header">
        <nav class="navigation">
            <div class="nav-left">
                <button id="openSidebarBtn" class="btn btn-hamburger">
                    <!-- Menu Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                            width="24" 
                            height="24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round">
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                </button>
            </div>

            <div class="nav-center">
                <a href="index.php#accueil" target="_self">Accueil</a>
                <a href="index.php#projets" target="_self">Projets</a>
                <a href="index.php#a-propos" target="_self">À propos</a>
                <a href="index.php#contact" target="_self">Contact</a>
            </div>

            <span id="sectionTitle"></span>
            
            <div class="nav-right">
                <button id="themeToggleBtn" class="btn btn-theme-toggle">
                    <!-- Icône de lune (mode clair par défaut) -->
                    <svg    class="icon icon-moon" 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="24" height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                    </svg>

                    <!-- Icône de soleil (affichée en mode sombre) -->
                    <svg    class="icon icon-sun" 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="24" 
                            height="24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            style="display: none;">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path>
                        <path d="M12 20v2"></path>
                        <path d="M4.93 4.93l1.41 1.41"></path>
                        <path d="M17.66 17.66l1.41 1.41"></path>
                        <path d="M2 12h2"></path>
                        <path d="M20 12h2"></path>
                        <path d="M6.34 17.66l-1.41 1.41"></path>
                        <path d="M19.07 4.93l-1.41 1.41"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>



    <!-- SIDEBAR (panneau latéral) -->
    <aside class="sidebar" id="sidebar">
        <button class="btn-close-sidebar" id="closeSidebarBtn">
            &times;
        </button>
    
        <div class="sidebar-profile">
            <!-- Photo de profil -->
            <img src="assets/images/portraits/DL_gris.png" alt="Photo de Dimitri Lefebvre" class="profile-picture" />
            
            <!-- Informations de profil -->
            <h2 class="profile-name">Dimitri Lefebvre</h2>
            <p class="profile-title">Data Analyst</p>
        </div>
        
        <!-- Menu du sidebar -->
        <div class="sidebar-menu">
            <a href="index.php#accueil" class="sidebar-link" target="_self">
                <svg    xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Accueil
            </a>
            <a href="index.php#projets" class="sidebar-link" target="_self">
                <svg    xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" >
                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                Projets
            </a>
            <a href="index.php#a-propos" class="sidebar-link" target="_self">
                <svg    xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                À propos
            </a>
            <a href="index.php#contact" class="sidebar-link" target="_self">
                <svg    xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                Contact
            </a>
        </div>

        <div class="sidebar-social">
            <div class="social-links">
                <a href="https://github.com/Dim2960" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                            width="24" 
                            height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round">
                        <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
                        <path d="M9 18c-4.51 2-5-2-7-2"></path>
                    </svg>
                </a>
                
                <a href="https://www.linkedin.com/in/dim-lefebvre60" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect width="4" height="12" x="2" y="9"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a>
                
                    <a href="#contact" class="sidebar-link" target="_self">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                            width="24" 
                            height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                </a>
            </div>
        </div>

    </aside>


    <main>

        <div class="wrapper-fiche-projet">
            <section id="fiche-projet">
                <div class="fiche-projet-frame">

                    <div class="fiche-projet-frame-title">
                        <div class="fiche-projet-title">
                            <h1><?php echo htmlspecialchars($titre); ?></h1>
                            <!-- <h3>Sous-titre précisant le domaine </h3> -->
                        </div>
                    </div>

                    <div class="fiche-projet-frame-context">

                        <div class="fiche-projet-frame-context-content">
                            <h2>Contexte</h2>
                            <p>
                                <?php echo htmlspecialchars($description_detail); ?>
                            </p>
                        </div>
                        
                        <div class="fiche-projet-frame-context-image">
                            <img src="assets/images/projets/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($image_alt); ?>" />
                        </div>

                    </div>

                    <div class="fiche-projet-frame-issueTarget">
                        <div class="fiche-projet-frame-issue">
                            <h4>🗨️ Problématique : </h4><?php echo htmlspecialchars($Probleme_resolu); ?>
                        </div>

                        <div class="fiche-projet-frame-target">
                            <h4>🎯 Objectif : </h4><?php echo htmlspecialchars($objectif); ?>
                        </div>
                    </div>

                    <hr>

                    <div class="fiche-projet-frame-data-methodo">
                        <div class="fiche-projet-frame-data-methodo-data">
                            <h2>Données</h2>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Source</th>
                                        <th>Taille</th>
                                        <th>Type de données</th>
                                        <th>Particularités</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo htmlspecialchars($data_source); ?></td>
                                        <td><?php echo htmlspecialchars($data_size); ?></td>
                                        <td><?php echo htmlspecialchars($data_type); ?></td>
                                        <td><?php echo htmlspecialchars($data_remark); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="fiche-projet-frame-data-methodo-methodo">
                            <h2>Méthodologie & Outils</h2>
                            <h3>Étapes de réalisation :</h3>
                            <div class="list-steps">
                                <ol>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $project_stepsArray = explode('|-|', $project_steps); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($project_stepsArray as $project_step) {
                                        echo '<li>' . trim(htmlspecialchars($project_step)) . '</li>';
                                    }
                                    ?>
                                </ol>
                            </div>
                            
                            </br>

                            <h3>Outils & technologies utilisés :</h3>
                            <div class="list-box">
                                <ul>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $technoArray = explode('|-|', $technos); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($technoArray as $techno) {
                                        echo '<li>' . trim(htmlspecialchars($techno)) . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="fiche-projet-frame-results">
                        <div class="fiche-projet-frame-results-header">

                            <div class="fiche-projet-frame-results-header-title">
                            <!-- Résultats & Impact -->
                            <h2>Résultats & Impact</h2>
                            </div>

                            <div class="fiche-projet-frame-results-header-links">
                                <?php
                                if ($powerbi_link != ' non disponible') {
                                    echo '<div class="ctn-icon">
                                                <a href="' . htmlspecialchars($powerbi_link) . '" target="_blank">
                                                    <img src="assets/images/icons/icons8-power-bi-2021-48.png" alt="Lien vers Power BI" />
                                                </a>
                                            </div>';
                                }   
                                if ($github_link != ' non disponible') {
                                    echo '<div class="ctn-icon">
                                                <a href="' . htmlspecialchars($github_link) . '" target="_blank">
                                                    <img src="assets/images/icons/icons8-github-48.png" alt="Lien vers GitHub" />
                                                </a>
                                            </div>';
                                }
                                if ($streamlit_link != ' non disponible') {
                                    echo '<div class="ctn-icon">
                                                <a href="' . htmlspecialchars($streamlit_link) . '" target="_blank">
                                                    <img src="assets/images/icons/icons8-streamlit-48.png" alt="Lien vers Streamlit" />
                                                </a>
                                            </div>';
                                }
                                if ($video_link != ' non disponible') {
                                    echo '<div class="ctn-icon">
                                                <a href="' . htmlspecialchars($video_link) . '" target="_blank">
                                                    <img src="assets/images/icons/icons8-video-48.png" alt="Lien vers Vidéo" />
                                                </a>
                                            </div>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="fiche-projet-frame-results-content">
                            <div class="fiche-projet-frame-results-list list-puce">
                                <ul>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $resultsArray = explode('|-|', $results); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($resultsArray as $result) {
                                        echo '<li><p>' . trim(htmlspecialchars($result)) . '</p></li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="fiche-projet-frame-group-dif-improv">
                        <div class="fiche-projet-frame-difficulties-learns">
                            <h2>Difficultés & Apprentissages</h2>
                            <div class="list-puce">
                                <ul>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $difficulties_learnsArray = explode('|-|', $difficulties_learns); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($difficulties_learnsArray as $difficulty_learn) {
                                        echo '<li>' . trim(htmlspecialchars($difficulty_learn)) . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="fiche-projet-frame-improvements">
                            <h2>Perspectives d'amélioration</h2>
                            <div class="list-puce">
                                <ul>
                                    <?php 
                                    // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                    $potential_improvementsArray = explode('|-|', $potential_improvements); 

                                    // Parcourir chaque tag et l'afficher dans une balise <span>
                                    foreach($potential_improvementsArray as $potential_improvement) {
                                        echo '<li>' . trim(htmlspecialchars($potential_improvement)) . '</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>

    </main>

    <!-- Footer avec informations complémentaires et liens sociaux -->
    <footer>

        <p>
            &copy; 2025 Dimitri Lefebvre. Tous droits réservés.
        </p>
        <span>
            <a href="https://github.com/Dim2960" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round">
                    <path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"></path>
                    <path d="M9 18c-4.51 2-5-2-7-2"></path>
                </svg>
            </a>
            <a href="https://www.linkedin.com/in/dim-lefebvre60" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    width="24" 
                    height="24" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    stroke-linecap="round" 
                    stroke-linejoin="round">
                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                    <rect width="4" height="12" x="2" y="9"></rect>
                    <circle cx="4" cy="4" r="2"></circle>
                </svg>
            </a>
            <a href="index.php#contact">
                <svg xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
            </a>
        </span>
    </footer>

<!-- Inclusion des scripts JavaScript -->
<script src="assets/js/scripts.js"></script>

</body>
</html>
