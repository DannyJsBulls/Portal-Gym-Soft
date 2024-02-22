document.addEventListener('DOMContentLoaded', function () {
    const actualizarEntrenadorForm = document.querySelector("form[name='actualizarEntrenadorForm']");
    const btnActualizarEntrenador = actualizarEntrenadorForm.querySelector(".btnActualizarEntrenador");

    btnActualizarEntrenador.addEventListener('click', async (e) => {
        e.preventDefault();

        const formData = new FormData(actualizarEntrenadorForm);

        try {
            const response = await fetch(actualizarEntrenadorForm.action, {
                method: actualizarEntrenadorForm.method,
                body: formData
            });

            if (response.ok) {
                const data = await response.json();

                if (data.success) {
                    // Muestra la alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Entrenador actualizado con exito',
                        confirmButtonText: 'Aceptar',
                        timer: 2000
                    }).then(() => {
                        // Redirige a la página deseada después de cerrar la alerta
                        window.location.href = '../../Views/Administrador/verTablaEntrenadores.php';
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