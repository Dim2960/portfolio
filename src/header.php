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
            <a href="index.php#accueil">Accueil</a>
            <a href="index.php#projets">Projets</a>
            <a href="index.php#a-propos">À propos</a>
            <a href="index.php#contact">Contact</a>
        </div>
        <span id="sectionTitle"></span>
        
        <div class="nav-right">
            <button id="themeToggleBtn" class="btn btn-theme-toggle">
                <!-- Icône de lune (mode sombre ) -->
                <svg    class="icon icon-moon" 
                        xmlns="http://www.w3.org/2000/svg" 
                        width="24" height="24" 
                        viewBox="0 0 24 24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round"
                        <?php if ($_COOKIE['theme'] === 'dark' or !isset($_COOKIE['theme'])) { ?>style="display: none;" <?php } else { ?>style="display: block;" <?php } ?>>
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                </svg>
                <!-- Icône de soleil (mode clair) -->
                <svg    class="icon icon-sun" 
                        xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        fill="none" 
                        stroke="currentColor" 
                        stroke-width="2" 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        <?php if ($_COOKIE['theme'] === 'light') { ?>style="display: none;" <?php }  else { ?>style="display: block;" <?php } ?>>
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