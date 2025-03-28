
//****************************************************************//
//************** Défilement de la page ***************************//
//****************************************************************//

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



// *************************************************//
//* Carrousel de la page d'accueil  ***************//
//*************************************************//

// Sélection du conteneur du carrousel et des boutons
const carouselContainer = document.querySelector('.carousel-track');
const imgCarouselContainer = document.querySelector('.carousel-track img');
const prevButton = document.querySelector('.carousel-btn.prev');
const nextButton = document.querySelector('.carousel-btn.next');

let nbFrames = 4; 

function updateButtonPosition() {
    // Récupère les dimensions du conteneur
    const rect = carouselContainer.getBoundingClientRect();
    const containerCenterY = rect.height;
    
    // Récupère la largeur et hauteur de l'écran
    const screenWidth = window.innerWidth;
    const screenHeight = window.innerHeight;
    let containerCenterYAjust = containerCenterY / 2;
    

    // Adapte la position horizontale et vertical selon la taille de l'écran
    if (screenHeight <= 480 && screenWidth > 768) {
        prevButton.style.left = `7vw`;
        nextButton.style.left = `${rect.width + 65}px`;
        nbFrames = 2;

        // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
        prevButton.style.top = `${containerCenterYAjust - prevButton.offsetHeight / 2}px`;
        nextButton.style.top = `${containerCenterYAjust - nextButton.offsetHeight / 2}px`;

    } else if (screenWidth <= 768) {
        prevButton.style.left = `2.5vw`;
        nextButton.style.left = `${rect.width - 28}px`;
        nbFrames = 1;

        if (screenHeight <= 500) {
            containerCenterYAjust = 37;
            
            // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
            prevButton.style.top = `${containerCenterYAjust - prevButton.offsetHeight / 2}px`;
            nextButton.style.top = `${containerCenterYAjust - nextButton.offsetHeight / 2}px`;
        }
        else if (screenHeight <= 600) {
            containerCenterYAjust = 10;
            
            // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
            prevButton.style.top = `${containerCenterYAjust}vh`;
            nextButton.style.top = `${containerCenterYAjust}vh`;
        }
        else if (screenHeight <= 780) {
            containerCenterYAjust = 18;
            
            // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
            prevButton.style.top = `${containerCenterYAjust}vh`;
            nextButton.style.top = `${containerCenterYAjust}vh`;
        }
        else  {
            containerCenterYAjust = 20;
            
            // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
            prevButton.style.top = `${containerCenterYAjust}vh`;
            nextButton.style.top = `${containerCenterYAjust}vh`;
        }
    
    } else if (screenWidth <= 1024) {
        prevButton.style.left = `-28px`;
        nextButton.style.left = `${rect.width - 15}px`;
        nbFrames = 2;

        // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
        prevButton.style.top = `${containerCenterYAjust - prevButton.offsetHeight / 2}px`;
        nextButton.style.top = `${containerCenterYAjust - nextButton.offsetHeight / 2}px`;
    } else if (screenWidth <= 1600) {
        prevButton.style.left = `-28px`;
        nextButton.style.left = `${rect.width - 15}px`;
        nbFrames = 3;

        // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
        prevButton.style.top = `${containerCenterYAjust - prevButton.offsetHeight / 2}px`;
        nextButton.style.top = `${containerCenterYAjust - nextButton.offsetHeight / 2}px`;
    } else {
        prevButton.style.left = `-28px`;
        nextButton.style.left = `${rect.width - 15}px`;
        nbFrames = 4;

        // Centre verticalement les boutons en soustrayant la moitié de leur hauteur
        prevButton.style.top = `${containerCenterYAjust - prevButton.offsetHeight / 2}px`;
        nextButton.style.top = `${containerCenterYAjust - nextButton.offsetHeight / 2}px`;
    }


    
}

// Met à jour la position au chargement, au défilement, au redimensionnement et au clic
window.addEventListener('scroll', updateButtonPosition);
window.addEventListener('resize', updateButtonPosition);
window.addEventListener('click', updateButtonPosition);
carouselContainer.addEventListener('scroll', updateButtonPosition);

updateButtonPosition();

// --- Nouveaux gestionnaires de clic pour un scroll "snap" sur la première carte visible ---

// Fonction utilitaire pour récupérer toutes les cartes du carrousel
function getCards() {
    // Ici, on suppose que chaque carte est un enfant direct de carouselContainer
    return Array.from(carouselContainer.children);
}

// Bouton "prev" : cherche la dernière carte dont l'offsetLeft est inférieur à scrollLeft courant
nextButton.addEventListener('click', () => {
    const cards = getCards();
    const currentScroll = carouselContainer.scrollLeft ;
    const decalage = window.innerWidth * 0.025;

    let targetCard = null;
    
    // Fonction de comparaison selon le mode nbFrames
    const isAfterScroll = (cardOffset) => {
        if (nbFrames === 1) {
            return cardOffset > currentScroll + decalage + 1;
        }
        return cardOffset > currentScroll + 1;
    };
    
    // Recherche de la dernière carte dont l'offsetLeft est inférieur à la position de scroll actuelle (avec décalage si nbFrames === 1)
    for (let i = 0; i< cards.length ; i++) {
        if (isAfterScroll(cards[i].offsetLeft)) {
            targetCard = cards[i+nbFrames-1];
            break;
        }
    }
    
    // Calcul de la position de scroll à appliquer
    const newScroll = targetCard 
        ? (nbFrames === 1 ? targetCard.offsetLeft - decalage : targetCard.offsetLeft)
        : carouselContainer.scrollWidth;

    carouselContainer.scrollTo({ left: newScroll, behavior: 'smooth' });
});


// Bouton "prev" : cherche la dernière carte dont l'offsetLeft est inférieur à scrollLeft courant
prevButton.addEventListener('click', () => {
    const cards = getCards();
    const currentScroll = carouselContainer.scrollLeft ;
    const decalage = window.innerWidth * 0.025;

    let targetCard = null;
    
    // Fonction de comparaison selon le mode nbFrames
    const isBeforeScroll = (cardOffset) => {
        if (nbFrames === 1) {
            return cardOffset < currentScroll + decalage - 1;
        }
        return cardOffset < currentScroll ;
    };
    
    // Recherche de la dernière carte dont l'offsetLeft est inférieur à la position de scroll actuelle (avec décalage si nbFrames === 1)
    for (let i = cards.length - 1; i >= 0; i--) {
        if (isBeforeScroll(cards[i].offsetLeft)) {
            targetCard = cards[i-nbFrames+1];
            break;
        }
    }
    
    // Calcul de la position de scroll à appliquer
    const newScroll = targetCard 
        ? (nbFrames === 1 ? targetCard.offsetLeft - decalage : targetCard.offsetLeft)
        : 0;

    carouselContainer.scrollTo({ left: (newScroll), behavior: 'smooth' });
});







//*************************************************************//
// Animation des éléments de la page d'accueil  ***************//
//*************************************************************//

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


// ***************************************************//
// ************* Intersection Observer ***************//
// ***************************************************//
const mediaQuery = window.matchMedia("(orientation: landscape)");

let observer = null;

function initIntersectionObserver() {
    if (observer) observer.disconnect();

    const sectionTitleElement = document.getElementById('sectionTitle');
    const sections = document.querySelectorAll("section");
    const options = { threshold: 0.4 }; // Réduis le seuil à 10% pour être sûr

    observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const h2 = entry.target.querySelector("h2");
                if (h2 && sectionTitleElement) {
                    sectionTitleElement.textContent = h2.textContent;
                }
            }
        });
    }, options);

    sections.forEach(section => observer.observe(section));
}

// Active l'observer dès que la page est prête (même en cas de redimensionnement)
window.addEventListener('load', () => {
    if (mediaQuery.matches) initIntersectionObserver();
});

// Gère dynamiquement les changements d’orientation
mediaQuery.addEventListener('change', (e) => {
    if (e.matches) {
        initIntersectionObserver();
    } else if (observer) {
        observer.disconnect();
    }
});








// ************************************************-***************************//
// *****recup de la carte active pour animationdu cliquez-ici ****************//
// ***************************************************************************//
function updateAnimatedCard() {
    // Récupère toutes les cartes du carrousel
    const cards = Array.from(carouselContainer.querySelectorAll('.projet-card-frame'));
    // Récupère la position et la taille du conteneur du carrousel
    const containerRect = carouselContainer.getBoundingClientRect();
    // Calcule la position horizontale du centre du conteneur
    const containerCenter = containerRect.left + containerRect.width / 2;
    
    let activeCard = null;
    let minDistance = Infinity;
    
    // Parcourt chaque carte et calcule la distance entre le centre de la carte et le centre du conteneur
    cards.forEach(card => {
        const cardRect = card.getBoundingClientRect();
        const cardCenter = cardRect.left + cardRect.width / 2;
        const distance = Math.abs(cardCenter - containerCenter);
        if (distance < minDistance) {
            minDistance = distance;
            activeCard = card;
        }
    });

    // Retire la classe 'animate' de toutes les cartes
    cards.forEach(card => card.classList.remove('animate'));
    // Ajoute la classe 'animate' à la carte dont le centre est le plus proche du centre du conteneur
    if (activeCard) {
        activeCard.classList.add('animate');
    }
}

// Met à jour la carte active lors du scroll du carrousel
carouselContainer.addEventListener('scroll', updateAnimatedCard);
// Met à jour lors du chargement et du redimensionnement
window.addEventListener('load', updateAnimatedCard);
window.addEventListener('resize', updateAnimatedCard);
// Pour les clics sur les boutons, utilisation d'un délai pour laisser le scroll se terminer
prevButton.addEventListener('click', () => setTimeout(updateAnimatedCard, 500));
nextButton.addEventListener('click', () => setTimeout(updateAnimatedCard, 500));
