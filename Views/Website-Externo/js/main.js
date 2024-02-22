let lastScrollPosition = 0; // Variable para almacenar la posición del último desplazamiento

window.addEventListener("scroll", function() { // Evento que se dispara al desplazarse la página
    applyNavbarStyle(); // Aplicar estilo al menú de navegación
});

document.querySelector(".navbar-toggler").addEventListener("click", function() {
    let navbar = document.querySelector(".navbar");
    let heroSection = document.querySelector("#scroll");
    let currentScrollPosition = window.pageYOffset;

    if (currentScrollPosition >= heroSection.offsetTop) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
    navbar.classList.toggle("scrolled-dark"); // Toggle: añadir si no está presente, eliminar si está presente
});

function applyNavbarStyle() {
    let navbar = document.querySelector(".navbar"); // Selecciona el elemento con la clase "navbar"
    let heroSection = document.querySelector("#scroll"); // Selecciona el elemento con el id "hero"
    let navbarHeight = navbar.offsetHeight; // Obtiene la altura del elemento de navegación (navbar)
    let currentScrollPosition = window.pageYOffset; // Obtiene la posición actual del desplazamiento vertical de la página

    // Comprueba si la posición actual del desplazamiento es mayor o igual a la posición superior de la sección hero
    if (currentScrollPosition >= heroSection.offsetTop) {
        navbar.classList.add("scrolled"); // Agrega la clase "scrolled" al elemento de navegación
    } else {
        navbar.classList.remove("scrolled"); // Elimina la clase "scrolled" del elemento de navegación
    }

    // Comprueba si la posición actual del desplazamiento es menor que la última posición de desplazamiento y está dentro de la sección hero
    if (currentScrollPosition < lastScrollPosition && currentScrollPosition <= heroSection.offsetTop) {
        navbar.classList.remove("scrolled"); // Elimina la clase "scrolled" del elemento de navegación
    }
    
    lastScrollPosition = currentScrollPosition; // Actualiza la última posición de desplazamiento con la posición actual
}


// Este evento abre el link en la misma pagina o pestaña
// document.getElementById("ingresarLogin").addEventListener("click", function() {
//     window.location.href = "Views/Extras/iniciarSesion.php";
// });

// Este evento abre el link en una pestaña nueva
document.getElementById("ingresarLogin").addEventListener("click", function() {
    window.open("Views/Extras/iniciarSesion.php", "_blank");
});

// Este evento abre el link en una pestaña nueva
document.getElementById("registrarLogin").addEventListener("click", function() {
    window.open("Views/Extras/registrarSesion.php", "_blank");
});







