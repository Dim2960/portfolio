<?php
session_start();

// Génération d'un token CSRF unique s'il n'existe pas déjà
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Vérifier si une notification a été définie et la récupérer
$notification = '';
if (isset($_SESSION['notification'])) {
    $notification = $_SESSION['notification'];
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

    <?php 
        include 'header.php'; 

        include 'menu_hamburger.php'; 
    ?>

    <main>
        
        <div class="wrapper-accueil">

            <section id="accueil">

                <h1>
                    <span class="animate-once">D</span>
                    <span class="animate-once">i</span>
                    <span class="animate-once">m</span>
                    <span class="animate-once">i</span>
                    <span class="animate-once">t</span>
                    <span class="animate-once">r</span>
                    <span class="animate-once">i</span>
                    <span class="animate-once">&nbsp;</span>
                    <span class="animate-once">L</span>
                    <span class="animate-once">e</span>
                    <span class="animate-once">f</span>
                    <span class="animate-once">e</span>
                    <span class="animate-once">b</span>
                    <span class="animate-once">v</span>
                    <span class="animate-once">r</span>
                    <span class="animate-once">e</span>
                </h1>
                <h2></h2>
                <h3>Data Analyst</h3>
                <p>J’allie expertise technique et vision stratégique pour transformer vos données en performance. Mon expérience passée fait la différence.</p>
                <div>
                    <button >
                        <a href="#contact" class="relative block px-4 py-2">
                            <span>Me contacter</span>
                        </a>
                    </button>

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
                    
                    <a href="#contact" class="sidebar-link">
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
            </section>
        </div>
        

        <!-- Section Projets -->
        <div class="wrapper-projets">
            <section id="projets">
                <h2>Mes Projets</h2>
                <div class="projet-list">

                    <div class="carousel-container">
                    
                        <div class="carousel-track">  

                            <div class="carousel-controls">
                                <button class="carousel-btn prev">‹</button>
                                <button class="carousel-btn next">›</button>
                            </div>

                            <?php
                            // On considère que la première ligne contient les en-têtes, on la saute
                            $firstRow = true;
                            foreach ($rows as $row) {
                                if ($firstRow) {
                                    $firstRow = false;
                                    continue;
                                }

                                if (!isset($row[0])) {
                                    break;
                                }
                                
                                // Adapter les indices en fonction de votre fichier Excel
                                $id       = isset($row[0]) ? $row[0] : 0;
                                $titre       = isset($row[1]) ? $row[1] : 'Titre non défini';
                                $description = isset($row[2]) ? $row[2] : 'Description non disponible';
                                $image_url = isset($row[3]) ? $row[3] : 'url image non disponible';
                                $image_alt = isset($row[4]) ? $row[4] : 'alt image non disponible';
                                $tags = isset($row[5]) ? $row[5] : 'tags image non disponible';

                                ?>
                                <div class="projet-card-frame">
                                    <form action="fiche_projet.php" method="POST" style="display:inline;">
                                        <div class="projet-card" onclick="this.closest('form').submit();" style="cursor: pointer;">

                                            <!-- Zone d'image -->
                                            <div class="card-image">
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                                    <input type="hidden" name="theme" class="hidden-theme" value="<?php echo $_COOKIE['theme']; ?>">
                                                    <input type="image" src="assets/images/projets/global/<?php echo htmlspecialchars($image_url); ?>" alt="<?php echo htmlspecialchars($image_alt); ?>" />
                                            </div>

                                            <!-- Zone de contenu texte -->
                                            <div class="card-content">
                                                <div class="title-frame">
                                                    <h3><?php echo htmlspecialchars($titre); ?></h3>
                                                    
                                                </div>
                                                <p>
                                                    <?php echo nl2br(htmlspecialchars($description)); ?>
                                                </p>

                                                <!-- Zone des tags -->
                                                <div class="tags">
                                                <?php 
                                                // Convertir la chaîne de tags en tableau, en séparant par la virgule
                                                $tagsArray = explode(',', $tags); 
                                                
                                                // Parcourir chaque tag et l'afficher dans une balise <span>
                                                foreach($tagsArray as $tag) {
                                                    echo '<span>' . trim(htmlspecialchars($tag)) . '</span>';
                                                }
                                                ?>
                                                </div>
                                            </div>


                                        </div>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                
            </section>
        </div>
        
        <!-- Section À propos -->
        <div class="wrapper-a-propos">
            <section id="a-propos">
                <h2>À mon propos</h2>
                <p>
                    En tant que Data Analyst certifié, j'incarne la convergence entre expertise 
                    technique, vision stratégique et un attrait fort pour l'innovation. 
                    <br/>
                    Grâce à mes récentes certifications (Data Analyst RNCP n°37429, 
                    <a href="https://learn.microsoft.com/api/credentials/share/fr-fr/DimitriLefebvre-3676/83B77277C8C2C256?sharingId=D0EBFEA893B7DB06" target="_blank">
                        Power BI Data Analyst</a> et 
                    <a href="https://learn.microsoft.com/api/credentials/share/fr-fr/DimitriLefebvre-3676/2E989F00F493B5A2?sharingId=D0EBFEA893B7DB06" target="_blank">
                        AZ-900</a>) et à mon engagement dans le développement continu de mes compétences, j'ai acquis une solide expertise.
                    <br/>
                    Actuellement, je travaille sur mes compétences en computer vision, un domaine que je découvre avec 
                    enthousiasme. Ainsi, je transforme la donnée en un levier puissant pour propulser la performance et 
                    l'innovation dans divers secteurs.
                    <br/>
                    <br/>
                    Mon parcours s'est construit sur 17 ans d'expérience au sein de l'industrie chimique, où
                    j'ai évolué de Technicien Méthodes et Procédés à Responsable d'Atelier, en passant par des
                    postes de Chargé de Projets et de Responsable QHSE. Ces rôles m'ont permis de développer un
                    sens aigu de l'optimisation, de l'analyse et du leadership, tout en m'offrant une perspective 
                    globale qui intègre à la fois la dimension industrielle et les défis organisationnels et humains.
                    <br/>
                    <br/>
                    Aujourd'hui, je mets cette riche expérience au service d'une approche alliant data analytics,
                    automatisation des processus et innovation technologique. 
                    <br/>
                    <br/>
                    Convaincu que la synergie entre compétences techniques et vécu professionnel est la clé pour relever des défis complexes, je 
                    m'engage à créer des solutions novatrices et pérennes, au-delà des seules applications industrielles.
                </p>
            </section>
        </div>
                
        <!-- Section Contact -->
        <div class="wrapper-contact">
            <section id="contact">  
                <div class="container-contact">
                    
                    <div class="image-contact">
                        <img src="assets/images/illustrations/contact.webp" alt="image d'illustration contact">
                    </div>

                    <div class="form-container">
                        <h2>Contactez-moi</h2>
                        <form action="contact.php" method="post">
                            <select id="titre" name="titre" required>
                                <option value="">Sélectionnez votre titre *</option>
                                <option value="monsieur">Monsieur</option>
                                <option value="madame">Madame</option>
                                <option value="non précisé">Ne souhaite pas préciser</option>
                            </select>
                            
                            <!-- Champs prénom et nom sur la même ligne, avec astérisque dans les placeholder -->
                            <div class="input-row">
                            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom *" required>
                            <input type="text" id="nom" name="nom" placeholder="Votre nom *" required>
                            </div>
                            
                            <input type="email" id="email" name="email" placeholder="Votre email *" required>
                            <textarea id="message" name="message" placeholder="Votre message *" required></textarea>
                            
                            <div style ="text-align: left;">* champs obligatoires</div>
                            <br/>

                            <button type="submit">Envoyer</button>
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        </form>

                        <?php  if (!empty($notification)): ?>
                            <div class="notification <?php echo (strpos($notification, 'succès') !== false) ? 'success' : 'error'; ?>">
                            <?php echo htmlspecialchars($notification); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </section>
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

    <?php include 'footer.php'; ?>

    <!-- Inclusion des scripts JavaScript -->
    <script src="assets/js/scripts.js"></script>
</body>
</html>
