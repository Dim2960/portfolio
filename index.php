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
    <link rel="canonical" href="https://www.portfolio-dimitri-lefebvre.com/">
    
    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.ico">
    
    <!-- Open Graph / Réseaux Sociaux -->
    <meta property="og:title" content="Portfolio – Dimitri Lefebvre">
    <meta property="og:description" content="Data Analyst certifié RNCP, certifié PL300, spécialisé en dataviz, computer vision et SQL. Découvrez mes projets et mon parcours professionnel.">
    <meta property="og:image" content="https://www.portfolio-dimitri-lefebvre.com/assets/images/og-image.jpg">
    <meta property="og:url" content="https://www.portfolio-dimitri-lefebvre.com/">
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
        "url": "https://www.portfolio-dimitri-lefebvre.com",
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
            "https://www.linkedin.com/in/votreprofil"
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
                <a href="#accueil">Accueil</a>
                <a href="#projets">Projets</a>
                <a href="#a-propos">À propos</a>
                <a href="#contact">Contact</a>
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
            <a href="#accueil" class="sidebar-link">
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
            <a href="#projets" class="sidebar-link">
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
            <a href="#a-propos" class="sidebar-link">
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
            <a href="#contact" class="sidebar-link">
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
        </div>

    </aside>


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

                            <div class="projet-card-frame">
                                <div class="projet-card">
                                    
                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <a href="https://app.powerbi.com/view?r=eyJrIjoiMjZiNmQ5YWQtNTQxNS00OWY1LWE2ZmItODQyYmJlODg4OGE4IiwidCI6IjQ0OTFmMGVlLWY1MDMtNDcyNi1hNWViLTFmMGM0ZGFjODJhOSJ9" target="_blank">
                                            <img src="assets/images/projets/pilotage_atelier.webp" alt="Pilotage d'un atelier" />   
                                        </a>
                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">
                                        <div class="title-frame">
                                            <h3>Pilotage d'Un Atelier</h3>
                                            
                                            <div class="card-github-icon">
                                                <a href="https://app.powerbi.com/view?r=eyJrIjoiMjZiNmQ5YWQtNTQxNS00OWY1LWE2ZmItODQyYmJlODg4OGE4IiwidCI6IjQ0OTFmMGVlLWY1MDMtNDcyNi1hNWViLTFmMGM0ZGFjODJhOSJ9" target="_blank">
                                                    <img src="assets/images/icons/icons8-power-bi-2021-48.png" alt="pwrBi">
                                                </a>
                                            </div>
                                        </div>
                                        <p>
                                            Création de rapports analytiques pour suivre TRS, cadences, arrêts, volumes et performances d’un atelier de conditionnement.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Power BI</span>
                                            <span>DAX</span>
                                            <span>Data Analysis</span>
                                            <span>Python</span>
                                            <span>Time Series</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="projet-card-frame">

                                <div class="projet-card">

                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <a href="https://app.powerbi.com/view?r=eyJrIjoiMGFlZjQ3N2EtYjI1ZC00N2Y3LWI1ZmYtMzg4M2FhZmIzMTJiIiwidCI6IjQ0OTFmMGVlLWY1MDMtNDcyNi1hNWViLTFmMGM0ZGFjODJhOSJ9" target="_blank">
                                            <img src="assets/images/projets/analyse_facteurs_influence.webp" alt="Facteurs d'influence de conditionnement" />
                                        </a>
                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">
                                        <div class="title-frame">
                                            <h3>Recherche de Facteurs d'Influence</h3>

                                            <div class="card-github-icon">
                                                <a href="https://app.powerbi.com/view?r=eyJrIjoiMGFlZjQ3N2EtYjI1ZC00N2Y3LWI1ZmYtMzg4M2FhZmIzMTJiIiwidCI6IjQ0OTFmMGVlLWY1MDMtNDcyNi1hNWViLTFmMGM0ZGFjODJhOSJ9" target="_blank">
                                                    <img src="assets/images/icons/icons8-power-bi-2021-48.png" alt="pwrBi">
                                                </a>
                                            </div>
                                        </div>
                                        <p>
                                            Étude des facteurs d'influence de la performance d’une ligne de conditionnement pour optimiser son efficacité.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Power BI</span>
                                            <span>DAX</span>
                                            <span>Data Analysis</span>
                                            <span>Python</span>
                                            <span>Time Series</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="projet-card-frame">

                                <div class="projet-card">
                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <img src="assets/images/projets/Taxi_NYC.webp" alt="Analyse de NYC Taxi" />
                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">
                                        <div class="title-frame">
                                            <h3>Analyse de NYC Taxi</h3>

                                            <div class="card-github-icon">
                                                <a href="https://github.com/Dim2960/nyc-taxi-data-analysis" target="github">
                                                    <img src="assets/images/icons/icons8-github-48.png" alt="pwrBi">
                                                </a>
                                            </div>

                                            <div class="card-pwrBi-icon">
                                                <a href="https://app.powerbi.com/view?r=eyJrIjoiY2MxNjcxZjItMDJiMC00OTJiLWIxNDEtMDE3MjI3ZjZmOWU2IiwidCI6IjQ0OTFmMGVlLWY1MDMtNDcyNi1hNWViLTFmMGM0ZGFjODJhOSJ9" target="_blank">
                                                    <img src="assets/images/icons/icons8-power-bi-2021-48.png" alt="pwrBi">
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <p>
                                            Analyse des données des courses NYC Taxi Services pour optimiser la répartition des taxis, la rentabilité et l'efficacité opérationnelle.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Power BI</span>
                                            <span>DAX</span>
                                            <span>Data Analysis</span>
                                            <span>Python</span>
                                            <span>geocoding</span>
                                            <span>PostGre SQL</span>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            
                            <div class="projet-card-frame">

                                <div class="projet-card">
                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <img src="assets/images/projets/etude_marche_vin.webp" alt="Étude du Marché US des Vins" />
                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">

                                        <div class="title-frame">
                                                <h3>Étude du Marché US des Vins</h3>

                                            <div class="card-github-icon">
                                                <a href="https://github.com/Dim2960/market-analysis-wine" target="_blank">
                                                    <img src="assets/images/icons/icons8-github-48.png" alt="github">
                                                </a>
                                            </div>

                                            <div class="card-pwrBi-icon">
                                                <a href="https://app.powerbi.com/view?r=eyJrIjoiOTk3NGU5MTYtZjE5Ny00ZmYxLWIzYzUtNTRiZmQ1NGU0ZDliIiwidCI6IjQ0OTFmMGVlLWY1MDMtNDcyNi1hNWViLTFmMGM0ZGFjODJhOSJ9" target="_blank">
                                                    <img src="assets/images/icons/icons8-power-bi-2021-48.png" alt="pwrBi">
                                                </a>
                                            </div>
                                        </div>

                                        <p>
                                            Étude du marché US et analyse comparative des vins pour recommander un prix optimal avec une visualisation simple et complète.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Power BI</span>
                                            <span>DAX</span>
                                            <span>Data Analysis</span>
                                            <span>Python</span>
                                            <span>Panda</span>
                                            <span>seaborn</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            
                            <div class="projet-card-frame">

                                <div class="projet-card">
                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <img src="assets/images/projets/AI_Judo.webp" alt="Analyse IA Judo" />

                                        <!-- Fenêtre modale pour la vidéo -->
                                        <div id="videoModal" class="modal">
                                            <div class="modal-content">
                                            <span class="close">&times;</span>
                                            <video width="100%" controls autoplay muted>
                                                <source src="assets/videos/judo_tracking.webm" type="video/webm">
                                                <!-- <source src="assets/videos/ma_video.webm" type="video/webm"> -->
                                                Votre navigateur ne supporte pas la lecture de cette vidéo.
                                            </video>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">
                                        <div class="title-frame">
                                            <h3>Analyse IA Judo</h3>

                                            <div class="card-video-icon">
                                                <a href="#" id="openVideoModal">
                                                    <img src="assets/images/icons/icons8-video-48.png" alt="video">
                                                </a>
                                            </div>
    
                                            <div class="card-github-icon">
                                                <a href="https://github.com/Dim2960/mvt_analyses" target="_blank">
                                                    <img src="assets/images/icons/icons8-github-48.png" alt="github">
                                                </a>
                                            </div>
                                        </div>

                                        <p>
                                            Détection et analyse des mouvements en judo via Computer Vision avec YOLO, DeepSORT et MediaPipe pour optimiser le suivi.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Computer vision</span>
                                            <span>Python</span>
                                            <span>Ultralytics YOLO</span>
                                            <span>MediaPipe</span>
                                            <span>DeepSort</span>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            
                            <div class="projet-card-frame">

                                <div class="projet-card">
                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <img src="assets/images/projets/image_classification.webp" alt="Image classification" />
                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">
                                        <div class="title-frame">
                                            <h3>Classification d'Images</h3>

                                            <div class="card-github-icon">
                                                <a href="https://github.com/Dim2960/lego_classification" target="_blank">
                                                    <img src="assets/images/icons/icons8-github-48.png" alt="github">
                                                </a>
                                            </div>
                                        </div>
                                        <p>
                                            Entraînement d’un modèle de deep learning avec Keras pour classifier des images de LEGO en différentes catégories.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Python</span>
                                            <span>Computer vision</span>
                                            <span>Image Classification</span>
                                            <span>Deep Learning</span>
                                            <span>Data Augmentation</span>
                                            <span>Scikit-learn</span>
                                            <span>TensorFlow</span>
                                            <span>Keras</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            
                            <div class="projet-card-frame">

                                <div class="projet-card">
                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <img src="assets/images/projets/ML_recommandation.webp" alt="Recommendation de film" />
                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">
                                        <div class="title-frame">
                                            <h3>Recommandation de film par ML</h3>

                                            <div class="card-streamlit-icon">
                                                <a href="https://flixoucreuse.streamlit.app/" target="_blank">
                                                    <img src="assets/images/icons/icons8-streamlit-48.png" alt="streamlit">
                                                </a>
                                            </div>
    
                                            <div class="card-github-icon">
                                                <a href="https://github.com/Dim2960/flixoucreuse" target="_blank">
                                                    <img src="assets/images/icons/icons8-github-48.png" alt="github">
                                                </a>
                                            </div>
                                        </div>

                                        <p>
                                            Création d’un système de recommandation de films basé sur le machine learning et l’analyse de données IMDB/TMDB.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Data Analysis</span>
                                            <span>API</span>
                                            <span>Python</span>
                                            <span>Machine Learning</span>
                                            <span>Scikit-learn</span>
                                            <span>Pandas</span>
                                            <span>Streamlit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            
                            <div class="projet-card-frame">

                                <div class="projet-card">
                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <img src="assets/images/projets/process_industry_data_simulation.webp" alt="Génération de données artificielles" />
                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">
                                        <div class="title-frame">
                                            <h3>Simulation de données</h3>
                                        
                                            <div class="card-github-icon">
                                                <a href="https://github.com/Dim2960/filling_simulation" target="_blank">
                                                    <img src="assets/images/icons/icons8-github-48.png" alt="github">
                                                </a>
                                            </div>
                                        </div>

                                        <p>
                                            Script de génération de données pour simuler le fonctionnement d'une ligne de conditionnement automatisée.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Process Optimization</span>
                                            <span>Industrial Analytics</span>
                                            <span>Data Simulation</span>
                                            <span>Python</span>
                                            <span>Pandas</span>
                                            <span>Numpy</span>
                                            <span>Time Series</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            
                            <div class="projet-card-frame">

                                <div class="projet-card">
                                    <!-- Zone d'image -->
                                    <div class="card-image">
                                        <img src="assets/images/projets/judo_app_projet.webp" alt="WebApp présence" />
                                    </div>

                                    <!-- Zone de contenu texte -->
                                    <div class="card-content">
                                        <div class="title-frame">
                                            <h3>WebApp présence</h3>
                                        
                                            <div class="card-github-icon">
                                                <a href="https://github.com/Dim2960/Presence_Judo" target="_blank">
                                                    <img src="assets/images/icons/icons8-github-48.png" alt="github">
                                                </a>
                                            </div>
                                        </div>

                                        <p>
                                            Application web pour suivre la présence des judokas, gérer les cours et analyser les fréquentations avec Flask et MySQL.
                                        </p>

                                        <!-- Zone des tags -->
                                        <div class="tags">
                                            <span>Python</span>
                                            <span>Flask API</span>
                                            <span>MySQL</span>
                                            <span>SQLAlchemy</span>
                                            <span>Docker</span>
                                            <span>Web App</span>
                                            <span>HTML</span>
                                            <span>CSS</span>
                                            <span>JavaScript</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  

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
            <a href="mailto:dimitri.lefebvre@datadriven-dynamix.fr" target="_blank">
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
