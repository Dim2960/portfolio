<?php
session_start();


// recupération de la variable post['fileName'] pour identifier le projet
if (isset($_POST['fileName'])) {

    $_SESSION['fileName'] = $_POST['fileName'];

    header('Location: index.php');
exit;

} 
elseif (isset($_SESSION['fileName'])) {
    $fileName = $_SESSION['fileName'];  
    unset($_SESSION['fileName']);

}




// Génération d'un token CSRF unique s'il n'existe pas déjà
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include '../src/function.php';


//récupération des données pour les balises meta
$filePathDataMeta = '../data/data_meta.xlsx';
$dataMeta = readExcelData($filePathDataMeta);

// récupération des données générales 
$filePathDataAccueil = '../data/data_accueil.xlsx';
$data = readExcelData($filePathDataAccueil);

$folderPathDataProjets = '../data/projets/';
$allDataProject = readAllExcelFilesInFolder($folderPathDataProjets);


include '../src/send_message.php'; 

// Vérifier si une notification suite envoie contact a été définie et la récupérer
$notification = '';
if (isset($_SESSION['notification'])) {
    $notification = $_SESSION['notification'];
}
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
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fiche_projet.css">
    <!-- Feuille de style carousel des projets -->
    <link rel="stylesheet" href="css/carousel-projets.css">
    <!-- Feuille de style pour l'adaptation responsive -->
    <link rel="stylesheet" href="css/responsive_portrait.css">
    <link rel="stylesheet" href="css/responsive_landscape.css">
    <link rel="stylesheet" href="css/fiche_projet_landscape.css">
    
    <!-- Données structurées (JSON-LD) -->
    <script type="application/ld+json">
        <?php echo ($dataMeta['applicationldjson']); ?>
    </script>
</head>

<body>

    <?php 
        include '../src/header.php'; 
        include '../src/menu_hamburger.php'; 

        if (isset($fileName)) {
            include '../src/main_fiche_projet.php';

        } else {
            include '../src/main_index.php';
        }

        include '../src/footer.php'; ?>

    <!-- Inclusion des scripts JavaScript -->
    <script src="js/global.js"></script>
    <script src="js/index.js"></script>
</body>
</html>
