$(document).ready(function () {
    // Inicializa las variables
    var currentSection = 1;
    var totalSections = 4;

    // Muestra la primera sección
    showSection(currentSection);

    // Maneja el clic en el botón "Siguiente"
    $("#next-btn").click(function () {
        // Si estamos en la última sección, envía el formulario
        if (currentSection === totalSections) {
            $("form").submit();
            return;
        }

        // Oculta la sección actual
        hideSection(currentSection);

        // Muestra la siguiente sección
        currentSection++;
        showSection(currentSection);

        // Oculta el botón de "Continuar" si estamos en la última sección
        if (currentSection === totalSections) {
            $("#next-btn").hide();
        }
    });

    // Función para mostrar una sección
    function showSection(sectionNumber) {
        $("#art-content article").removeClass("d-flex").addClass("d-none");
        $("#art-content article:nth-child(" + sectionNumber + ")").removeClass("d-none").addClass("d-flex");
        updateProgressBar(sectionNumber);
    }

    // Función para ocultar una sección
    function hideSection(sectionNumber) {
        $("#art-content article:nth-child(" + sectionNumber + ")").removeClass("d-flex").addClass("d-none");
    }

    // Función para actualizar la barra de progreso
    function updateProgressBar(sectionNumber) {
        var progress = (sectionNumber - 1) / (totalSections - 1) * 100;
        $("#progress-one, #progress-two").css("width", progress + "%");
    }
});