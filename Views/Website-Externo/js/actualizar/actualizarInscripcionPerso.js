document.addEventListener('DOMContentLoaded', function () {
    const actualizarInscripcionPersoForm = document.querySelector("form[name='actualizarInscripcionPersoForm']");
    const btnActualizarInscripcionPerso = actualizarInscripcionPersoForm.querySelector(".btnActualizarInscripcionPerso");

    btnActualizarInscripcionPerso.addEventListener('click', async (e) => {
        e.preventDefault();

        const formData = new FormData(actualizarInscripcionPersoForm);

        try {
            const response = await fetch(actualizarInscripcionPersoForm.action, {
                method: actualizarInscripcionPersoForm.method,
                body: formData
            });

            if (response.ok) {
                const data = await response.json();

                if (data.success) {
                    // Muestra la alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Inscripcion de actividad actualizada con exito',
                        confirmButtonText: 'Aceptar',
                        timer: 2000
                    }).then(() => {
                        // Redirige a la página deseada después de cerrar la alerta
                        window.location.href = '../../Views/Administrador/verInscripcionesPerso.php';
                    });
                } else {
                    // Muestra la alerta de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en la actualizacion',
                        text: data.message || 'Ocurrió un error en el servidor.'
                    });
                }
            } else {
                throw new Error('Error en la solicitud al servidor.');
            }
        } catch (error) {
            console.error('Error:', error);
            // Muestra la alerta de error si hay un problema con la solicitud
            Swal.fire({
                icon: 'error',
                title: 'Error, por favor complete los campos para realizar la actualizacion',
                text: 'Ocurrió un error en la solicitud al servidor.'
            });
        }
    });
});