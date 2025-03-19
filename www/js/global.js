//*********************************************************//
// Gestion de la sidebar et du thème sombre/clair ********//
//*********************************************************//

// Sélection des éléments
const openSidebarBtn = document.getElementById('openSidebarBtn');
const closeSidebarBtn = document.getElementById('closeSidebarBtn');
const sidebar = document.getElementById('sidebar');

const themeToggleButton = document.getElementById('themeToggleBtn');
const iconMoon = document.querySelector('.icon-moon');
const iconSun = document.querySelector('.icon-sun');
const hiddenTheme = document.querySelector('.hidden-theme');

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


//**********************************************//
// Gestion du thème sombre et clair avec les cookies //
//**********************************************

function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
    const value = "; " + document.cookie;
    const parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
    return null;
}

// Appliquer la classe au body dès que le DOM est chargé
document.addEventListener("DOMContentLoaded", function() {
    var theme = getCookie("theme");
    // On suppose que pour le thème clair, le cookie a la valeur "light"
    if (theme === "light") {
        document.body.classList.add("clear-mode");
    }
});

// Bascule du mode sombre
themeToggleButton.addEventListener('click', () => {
    body.classList.toggle('clear-mode');

    if (body.classList.contains('clear-mode')) {
        iconMoon.style.display = 'block';
        iconSun.style.display = 'none';
        setCookie("theme", "light", 30);
    } else {
        iconMoon.style.display = 'none';
        iconSun.style.display = 'block';
        setCookie("theme", "dark", 30);
    }
});