<?php
session_start();

// Inclusion de l'autoloader de Composer pour charger PhpSpreadsheet
require '../vendor/autoload.php'; // Assurez-vous que PhpSpreadsheet est installé
use PhpOffice\PhpSpreadsheet\IOFactory;

// Génération d'un token CSRF unique s'il n'existe pas déjà
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Vérifier si une notification a été définie et la récupérer
$notification = '';
if (isset($_SESSION['notification'])) {
    $notification = $_SESSION['notification'];
}

// Définir le chemin vers le fichier Excel
$inputFileName = '../data/data_projets.xlsx';

try {
    // Charger le fichier Excel
    $spreadsheet = IOFactory::load($inputFileName);
    $worksheet = $spreadsheet->getActiveSheet();
    // Conversion de la feuille en tableau PHP
    $rows = $worksheet->toArray();
} catch(Exception $e) {
    die('Erreur lors de la lecture du fichier Excel : ' . $e->getMessage());
}

include '../src/send_message.php'; 
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
    <link rel="icon" href="images/icones/favicon.ico">
    
    <!-- Open Graph / Réseaux Sociaux -->
    <meta property="og:title" content="Portfolio – Dimitri Lefebvre">
    <meta property="og:description" content="Data Analyst certifié RNCP, certifié PL300, spécialisé en dataviz, computer vision et SQL. Découvrez mes projets et mon parcours professionnel.">
    <meta property="og:image" content="https://www.portfolio-dimitri-lefebvre.fr/images/og-image.jpg">
    <meta property="og:url" content="https://www.portfolio-dimitri-lefebvre.fr/">
    <meta property="og:type" content="website">
    
    
    <!-- Feuille de style principale -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Feuille de style carousel des projets -->
    <link rel="stylesheet" href="css/carousel-projets.css">
    <!-- Feuille de style pour l'adaptation responsive -->
    <link rel="stylesheet" href="css/responsive_portrait.css">
    <link rel="stylesheet" href="css/responsive_landscape.css">
    
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
        include '../src/header.php'; 
        include '../src/menu_hamburger.php'; 
    ?>

    <main>
        
        <div class="wrapper-accueil">
            <?php  include '../src/accueil.php'; ?>
        </div>
        

        <!-- Section Projets -->
        <div class="wrapper-projets">
            <?php include '../src/projets.php'; ?>
        </div>
        
        <!-- Section À propos -->
        <div class="wrapper-a-propos">
            <?php include '../src/a_propos.php'; ?>
        </div>
                
        <!-- Section Contact -->
        <div class="wrapper-contact">
            <?php include '../src/contact.php'; ?>
        </div>

        <a href="#" id="scrollArrowTop" class="scroll-arrow scroll-arrow-top">
            <svg    xmlns="http://www.w3.org/2000/svg" 
                    width="24" 
                    height="24" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    stroke-linecap="round" 
                    stroke-linejoin="round">
                <polyline points="6 15 12 9 18 15"></polyline>
            </svg>
        </a>

        <a href="#" id="scrollArrowBottom" class="scroll-arrow scroll-arrow-bottom">
            <svg    xmlns="http://www.w3.org/2000/svg" 
                    width="24" 
                    height="24" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="2" 
                    stroke-linecap="round" 
                    stroke-linejoin="round">
                    <polyline points="6 11 12 17 18 11"></polyline>
            </svg>
        </a>


        
    </main>

    <?php include '../src/footer.php'; ?>

    <!-- Inclusion des scripts JavaScript -->
    <script src="js/global.js"></script>
    <script src="js/index.js"></script>
</body>
</html>
