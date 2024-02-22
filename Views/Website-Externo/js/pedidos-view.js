$(document).ready(function () {
    // Inicializa las variables
    var currentSection = 1;
    var totalSections = 4;

    // Muestra la primera sección
    showSection(currentSection);

    // Maneja el clic en el botón "Siguiente"
    $("#next-btn").click(function () {
        // Validar campos antes de avanzar a la siguiente sección
        if (currentSection === 1 && !validateFirstSection()) {
            return; // Si la validación falla, detener el avance
        }

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

    // Función para validar los campos de la primera sección
    function validateFirstSection() {
        var formaEntrega = $("input[name='forma_entrega']:checked").val(); // Obtener el valor del radio de forma de entrega seleccionado
        var clienteSeleccionado = $("#cliente").val(); // Obtener el valor del campo de selección de cliente

        // Verificar si se ha seleccionado una forma de entrega
        if (!formaEntrega) {
            // Mostrar un mensaje de error
            $("#liveAlertPlaceholder").html('<div class="alert alert-danger" role="alert">Por favor elija una forma de entrega.</div>');
            return false; // Bloquear el avance si no se ha seleccionado ninguna forma de entrega
        }

        // Verificar si se ha seleccionado un cliente
        if (!clienteSeleccionado) {
            // Mostrar un mensaje de error
            $("#liveAlertPlaceholder").html('<div class="alert alert-danger" role="alert">Por favor seleccione un cliente.</div>');
            return false; // Bloquear el avance si no se ha seleccionado ningún cliente
        }

        // Limpiar el mensaje de error si la forma de entrega y el cliente han sido seleccionados
        $("#liveAlertPlaceholder").empty();

        // Validación exitosa
        return true;
    }

    // Maneja el clic en el botón "Siguiente"
    $("#next-btn").click(function () {
        // Si estamos en la última sección, envía el formulario
        if (currentSection === totalSections) {
            // Verificar la validez de la primera sección antes de enviar el formulario
            if (!validateFirstSection()) {
                // Si la validación falla, no enviar el formulario
                return;
            }
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


});










