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
        $tags = isset($row[5]) ? $row[5] : 'tags non disponible';
        $description_detail = isset($row[6]) ? $row[6] : 'Information non disponible';
        $objectif = isset($row[7]) ? $row[7] : 'Information non disponible';
        $Probleme_resolu = isset($row[8]) ? $row[8] : 'Information non disponible';
        $data_source = isset($row[9]) ? $row[9] : 'Information non disponible';
        $data_size = isset($row[10]) ? $row[10] : 'Information non disponible';
        $data_type = isset($row[11]) ? $row[11] : 'Information non disponible';
        $data_remark = isset($row[12]) ? $row[12] : 'Information non disponible';
        $url_img_data = isset($row[13]) ? $row[13] : 'url image non disponible';
        $alt_img_data = isset($row[14]) ? $row[14] : 'url image non disponible';
        $project_steps = isset($row[15]) ? $row[15] : 'Information non disponible';
        $technos = isset($row[16]) ? $row[16] : 'Information non disponible';
        $results = isset($row[17]) ? $row[17] : 'Information non disponible';
        $img_url_results = isset($row[18]) ? $row[18] : 'url image non disponible';
        $alt_img_results = isset($row[19]) ? $row[19] : 'alt image non disponible';
        $powerbi_link = isset($row[20]) ? $row[20] : 'lien non disponible';
        $github_link = isset($row[21]) ? $row[21] : 'lien non disponible';
        $streamlit_link = isset($row[22]) ? $row[22] : 'lien non disponible';
        $video_link = isset($row[23]) ? $row[23] : 'lien non disponible';
        $difficulties_learns = isset($row[24]) ? $row[24] : 'Information non disponible';
        $potential_improvements = isset($row[25]) ? $row[25] : 'Information non disponible';



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
    <link rel="stylesheet" href="assets/css/fiche_projets.css">
    
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

    <?php 
        include 'header.php'; 

        include 'menu_hamburger.php'; 
    ?>

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
                            <img src="assets/images/projets/global/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($image_alt); ?>" />
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
                            <div class="fiche-projet-frame-data-methodo-data-content">
                                <div class="fiche-projet-frame-data-methodo-data-title">
                                    <h2>Données</h2>
                                </div>

                                <div class="fiche-projet-frame-data-methodo-data-table">
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

                                <div class="fiche-projet-frame-data-methodo-data-table-list">
                                    
                                    <div class="list-puce">
                                            <ul>
                                                <li>Source : <?php echo htmlspecialchars($data_source); ?></li>
                                                <li>Taille : <?php echo htmlspecialchars($data_size); ?></li>
                                                <li>Type de données : <?php echo htmlspecialchars($data_type); ?></li>
                                                <li>Particularités : <?php echo htmlspecialchars($data_remark); ?></li>
                                            </ul>
                                    </div>
                                </div>
                                
                                <?php
                                if ($url_img_data != 'url image non disponible') {
                                ?>
                                <div class="fiche-projet-frame-data-methodo-data-img">
                                    <img src="assets/images/projets/data/<?php echo htmlspecialchars($url_img_data); ?>" alt="<?php echo htmlspecialchars($alt_img_data); ?>" />
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="fiche-projet-frame-data-methodo-methodo">
                            <h2>
                                <?php 
                                if (($project_steps !== 'Information non disponible') & ($technos !== 'Information non disponible')) {
                                    echo 'Méthodologie et Outils';
                                    $jeton_project_steps = 1;
                                    $jeton_technos = 1;
                                    } 
                                elseif (($project_steps != 'Information non disponible') & ($technos === 'Information non disponible')) {
                                    echo 'Méthodologie';
                                    $jeton_project_steps = 1;
                                    $jeton_technos = 0;
                                    }
                                elseif (($project_steps === 'Information non disponible') & ($technos !== 'Information non disponible')) {
                                    echo 'Outils et technologies';
                                    $jeton_project_steps = 0;
                                    $jeton_technos = 1;
                                    }
                                ?>
                            </h2>
                            <?php
                            if ($jeton_project_steps == 1) {
                            ?>
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
                            <?php
                            }
                            if ($jeton_technos == 1) {
                                if ($jeton_project_steps == 1) {
                                ?>
                                <h3>Outils et technologies utilisés :</h3>
                                <?php
                                }
                                ?>
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
                            <?php
                            }   
                            ?>
                        </div>

                    </div>

                    <hr>

                    <div class="fiche-projet-frame-results">

                        <div class="fiche-projet-frame-results-header">
                            <h2>Résultats</h2>
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

                            <div class="fiche-projet-frame-results-img-container">

                                <div class="fiche-projet-frame-results-img">
                                    <?php
                                    if ($img_url_results != 'url image non disponible') {
                                        ?>
                                        <img src="assets/images/projets/results/<?php echo htmlspecialchars($img_url_results); ?>" alt="<?php echo htmlspecialchars($alt_img_results); ?>" />
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="fiche-projet-frame-results-links">
                                    <?php
                                    if ($powerbi_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon">
                                                    <a href="' . htmlspecialchars($powerbi_link) . '" target="_blank">
                                                        <img src="assets/images/icons/icons8-power-bi-2021-48.png" alt="Lien vers Power BI" />
                                                    </a>
                                                </div>';
                                    }   
                                    if ($github_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon">
                                                    <a href="' . htmlspecialchars($github_link) . '" target="_blank">
                                                        <img src="assets/images/icons/icons8-github-48.png" alt="Lien vers GitHub" />
                                                    </a>
                                                </div>';
                                    }
                                    if ($streamlit_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon">
                                                    <a href="' . htmlspecialchars($streamlit_link) . '" target="_blank">
                                                        <img src="assets/images/icons/icons8-streamlit-48.png" alt="Lien vers Streamlit" />
                                                    </a>
                                                </div>';
                                    }
                                    if ($video_link != 'lien non disponible') {
                                        echo '<div class="ctn-icon">
                                                    <a href="assets/videos/' . htmlspecialchars($video_link) . '" target="_blank">
                                                        <img src="assets/images/icons/icons8-video-48.png" alt="Lien vers Vidéo" />
                                                    </a>
                                                </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="fiche-projet-frame-group-dif-improv">

                        <div class="fiche-projet-frame-difficulties-learns">
                            <h2>Difficultés</h2>
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

    <?php include 'footer.php'; ?>

<!-- Inclusion des scripts JavaScript -->
<script src="assets/js/scripts.js"></script>

</body>
</html>
