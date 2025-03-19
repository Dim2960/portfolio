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


//Chargement des donnees de projet
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


//Chargement des données pour les meta données
// Charger le fichier Excel
$spreadsheet = IOFactory::load('../data/data_meta.xlsx');
$sheet = $spreadsheet->getActiveSheet();
$dataMeta = [];

// Lire les données du fichier Excel
foreach ($sheet->getRowIterator() as $row) {
    $cells = $row->getCellIterator();
    $cells->setIterateOnlyExistingCells(true);
    $values = [];
    foreach ($cells as $cell) {
        $values[] = $cell->getValue();
    }
    if (!empty($values[0]) && !empty($values[1])) {
        $dataMeta[$values[0]] = $values[1];
    }
}

include '../src/send_message.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Titre et Meta Description pour le SEO -->
    <title><?php echo htmlspecialchars($dataMeta['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($dataMeta['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($dataMeta['keywords']); ?>">
    
    <!-- URL canonique -->
    <link rel="canonical" href="<?php echo htmlspecialchars($dataMeta['canonical url']); ?>">
    
    <!-- Favicon -->
    <link rel="icon" href="<?php echo htmlspecialchars($dataMeta['icon']); ?>">
    
    <!-- Open Graph / Réseaux Sociaux -->
    <meta property="og:title" content="<?php echo htmlspecialchars($dataMeta['open Graph Réseaux Sociaux og:title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($dataMeta['open Graph Réseaux Sociaux og:description']); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($dataMeta['open Graph Réseaux Sociaux og:image']); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($dataMeta['open Graph Réseaux Sociaux og:url']); ?>">
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
        <?php echo ($dataMeta['applicationldjson']); ?>
    </script>
</head>

<body>

    <?php 
        include '../src/header.php'; 
        include '../src/menu_hamburger.php'; 
    ?>

    <main>
        
        <div class="wrapper-accueil"><?php echo ('rr' . $data['title']); ?>
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
