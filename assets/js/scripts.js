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
const carouselContainer = document.querySelector('.carousel-container');
const prevButton = document.querySelector('.carousel-btn.prev');
const nextButton = document.querySelector('.carousel-btn.next');

function updateButtonPosition() {
  // Récupère la position et la hauteur du conteneur par rapport à la fenêtre
  const rect = carouselContainer.getBoundingClientRect();
  // Calcule le centre vertical du conteneur
  const containerCenter = rect.top + rect.height / 2;
  // Place les boutons à cette position
  prevButton.style.top = `${containerCenter}px`;
  nextButton.style.top = `${containerCenter}px`;
}

// Met à jour la position au chargement, au défilement et au redimensionnement
window.addEventListener('scroll', updateButtonPosition);
window.addEventListener('resize', updateButtonPosition);
updateButtonPosition();



nextButton.addEventListener('click', () => {
  carouselContainer.scrollBy({ left: carouselContainer.offsetWidth, behavior: 'smooth' });
});

prevButton.addEventListener('click', () => {
  carouselContainer.scrollBy({ left: -carouselContainer.offsetWidth, behavior: 'smooth' });
});

