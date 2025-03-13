// Sélection des éléments
const openSidebarBtn = document.getElementById('openSidebarBtn');
const closeSidebarBtn = document.getElementById('closeSidebarBtn');
const sidebar = document.getElementById('sidebar');

const themeToggleButton = document.getElementById('themeToggleBtn');
const iconMoon = document.querySelector('.icon-moon');
const iconSun = document.querySelector('.icon-sun');

const body = document.body;
const header = document.querySelector('header');
const mainContent = document.querySelector('main');
const footer = document.querySelector('footer');

// Fonction pour réinitialiser les animations des éléments de la sidebar
function resetSidebarAnimations() {
    const animatedElements = sidebar.querySelectorAll('.sidebar-menu a, .sidebar-actions, .sidebar-social');
    animatedElements.forEach(el => {
        el.style.animation = 'none';
        // Forcer le reflow pour que l'animation puisse se relancer
        void el.offsetWidth;
        el.style.animation = '';
    });
}

// Fonctions pour ouvrir et fermer la sidebar
function openSidebar() {
    sidebar.classList.add('sidebar--open');
    mainContent.classList.add('blur');
    if (header) {
        header.classList.add('blur');
    }
    if (footer) {
        footer.classList.add('blur');
    }
    
    // Réinitialise les animations pour qu'elles se rejouent
    resetSidebarAnimations();
}

function closeSidebar() {
    sidebar.classList.remove('sidebar--open');
    mainContent.classList.remove('blur');
    if (header) {
        header.classList.remove('blur');
    }
    if (footer) {
        footer.classList.remove('blur');
    }
}

// Ouvrir la sidebar
openSidebarBtn.addEventListener('click', openSidebar);

// Fermer la sidebar avec le bouton dédié
closeSidebarBtn.addEventListener('click', closeSidebar);

// Fermer la sidebar lors d'un clic sur un élément cliquable à l'intérieur
const sidebarClickableItems = document.querySelectorAll('.sidebar a, .sidebar button:not(#closeSidebarBtn)');
sidebarClickableItems.forEach(item => {
    item.addEventListener('click', closeSidebar);
});

// Fermer la sidebar en cliquant en dehors
document.addEventListener('click', (e) => {
    if (sidebar.classList.contains('sidebar--open')) {
        if (!sidebar.contains(e.target) && !openSidebarBtn.contains(e.target)) {
            closeSidebar();
        }
    }
});

// Bascule du mode sombre
themeToggleButton.addEventListener('click', () => {
    body.classList.toggle('clear-mode');

    if (body.classList.contains('clear-mode')) {
        iconMoon.style.display = 'block';
        iconSun.style.display = 'none';
    } else {
        iconMoon.style.display = 'none';
        iconSun.style.display = 'block';
    }
});


// Flèche pour défiler vers le bas
const scrollArrowBottom = document.getElementById('scrollArrowBottom');

scrollArrowBottom.addEventListener('click', (e) => {
    e.preventDefault();
    
    // Récupère toutes les sections de la page
    const sections = document.querySelectorAll("section");
    const currentScroll = window.scrollY;
    
    // Parcourt les sections pour trouver la première dont le offsetTop est supérieur à la position actuelle
    let nextSection = null;
    for (let i = 0; i < sections.length; i++) {
        if (sections[i].offsetTop > currentScroll + 10) { // +10 pour éviter les cas limites
            nextSection = sections[i];
            break;
        }
    }
    
    // Si une section suivante a été trouvée, défiler jusqu'à elle
    if (nextSection) {
        nextSection.scrollIntoView({ behavior: "smooth" });
    }
});

// Flèche pour défiler vers le haut 
const scrollArrowTop = document.getElementById('scrollArrowTop');

scrollArrowTop.addEventListener('click', (e) => {
    e.preventDefault();
    
    // Récupère toutes les sections de la page et les convertit en tableau
    const sections = Array.from(document.querySelectorAll("section"));
    const currentScroll = window.scrollY;
    
    // Parcourt les sections en partant de la fin pour trouver la première dont l'offsetTop est inférieur à la position actuelle moins un petit marge
    let prevSection = null;
    for (let i = sections.length - 1; i >= 0; i--) {
        if (sections[i].offsetTop < currentScroll - 10) { // -10 pour éviter les cas limites
            prevSection = sections[i];
            break;
        }
    }
    
    // Si une section précédente a été trouvée, défiler jusqu'à elle
    if (prevSection) {
        prevSection.scrollIntoView({ behavior: "smooth" });
    } else {
        // Si aucune section précédente n'est trouvée, on peut défiler vers le haut de la page
        window.scrollTo({ top: 0, behavior: "smooth" });
    }
});



// Sélection du conteneur du carrousel et des boutons
const carouselContainer = document.querySelector('.carousel-track');
const prevButton = document.querySelector('.carousel-btn.prev');
const nextButton = document.querySelector('.carousel-btn.next');

let nbFrames  = 4; 

function updateButtonPosition() {
    // Récupère les dimensions du conteneur
    const rect = carouselContainer.getBoundingClientRect();
    // Calcule le centre vertical du conteneur
    const containerCenterY = rect.height / 2;
    
    // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
    prevButton.style.top = `${containerCenterY - prevButton.offsetHeight / 2}px`;
    nextButton.style.top = `${containerCenterY - nextButton.offsetHeight / 2}px`;
    
    // Récupère la largeur de l'écran
    const screenWidth = window.innerWidth;
    
    // Adapte la position horizontale selon la taille de l'écran
    if (screenWidth <= 768) {
        // Pour les écrans de 768px et moins : positionner les boutons plus à l'intérieur
        prevButton.style.left = `5vw`;
        nextButton.style.left = `${rect.width - 45}px`;
        nbFrames  = 1;
    } else if (screenWidth <= 1024) {
        // Pour les écrans jusqu'à 1024px (entre 769px et 1024px) : une position intermédiaire
        prevButton.style.left = `-28px`;
        nextButton.style.left = `${rect.width - 15}px`;
        nbFrames  = 2;
    }  else if (screenWidth <= 1600) {
        // Pour les écrans jusqu'à 1024px (entre 769px et 1024px) : une position intermédiaire
        prevButton.style.left = `-28px`;
        nextButton.style.left = `${rect.width - 15}px`;
        nbFrames  = 3;
    } else {
        // Pour les écrans plus larges : positions par défaut
        prevButton.style.left = `${-28}px`;
        nextButton.style.left = `${rect.width - 15}px`;
        nbFrames  = 4;
    }
}

// Met à jour la position au chargement, au défilement, au redimensionnement et au clic
window.addEventListener('scroll', updateButtonPosition);
window.addEventListener('resize', updateButtonPosition);
window.addEventListener('click', updateButtonPosition);
carouselContainer.addEventListener('scroll', updateButtonPosition);

updateButtonPosition();

nextButton.addEventListener('click', () => {
    carouselContainer.scrollBy({ left: carouselContainer.offsetWidth / nbFrames, behavior: 'smooth' });
});

prevButton.addEventListener('click', () => {
    carouselContainer.scrollBy({ left: -carouselContainer.offsetWidth / nbFrames, behavior: 'smooth' });
});





// Animation du titre de la page d'accueil
    // Pour chaque lettre, dès la fin de l'animation "waveOnce", on passe à l'animation en boucle
    document.querySelectorAll('.wrapper-accueil h1 span').forEach(function(span) {
        span.addEventListener('animationend', function(event) {
            if (event.animationName === 'waveOnce') {
            span.classList.remove('animate-once');
            span.classList.add('animate-loop');
            }
        });
    });


// Sélection des éléments
const openVideoModal = document.getElementById('openVideoModal');
const videoModal = document.getElementById('videoModal');
const closeModal = document.querySelector('.modal .close');

// Ouvrir la modal lors du clic
openVideoModal.addEventListener('click', function(e) {
    e.preventDefault();
    videoModal.style.display = 'block';
});

// Fermer la modal en cliquant sur le bouton de fermeture
closeModal.addEventListener('click', function() {
    videoModal.style.display = 'none';
  // Mettre la vidéo en pause lorsque la modal se ferme
    videoModal.querySelector('video').pause();
});

// Fermer la modal en cliquant en dehors du contenu
window.addEventListener('click', function(e) {
    if (e.target === videoModal) {
    videoModal.style.display = 'none';
    videoModal.querySelector('video').pause();
    }
});



// ***************************************************//
// ************                       ****************//
// ***************************************************//
const mediaQuery = window.matchMedia("(orientation: landscape)");

function initIntersectionObserver() {
    const sectionTitleElement = document.getElementById('sectionTitle');
    const sections = document.querySelectorAll("section");
    
    const options = {
        threshold: 0.2  // La section doit être à 20% visible 
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const h2 = entry.target.querySelector("h2");
                if (h2) {
                    sectionTitleElement.textContent = h2.textContent;
                }
            }
        });
    }, options);
    
    sections.forEach(section => observer.observe(section));
}

// Vérifier l'orientation au chargement
if (mediaQuery.matches) {
    initIntersectionObserver();
}

// Ajouter un écouteur pour détecter les changements d'orientation
mediaQuery.addEventListener('change', (e) => {
    if (e.matches) {
        initIntersectionObserver();
    }
});
