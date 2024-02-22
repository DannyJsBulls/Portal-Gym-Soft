document.addEventListener('DOMContentLoaded', function () {
    const actualizarPerfilForm = document.querySelector("form[name='actualizarPerfilForm']");
    const btnActualizarPerfil = actualizarPerfilForm.querySelector(".btnActualizarPerfil");

    btnActualizarPerfil.addEventListener('click', async (e) => {
        e.preventDefault();

        const formData = new FormData(actualizarPerfilForm);

        try {
            const response = await fetch(actualizarPerfilForm.action, {
                method: actualizarPerfilForm.method,
                body: formData
            });

            if (response.ok) {
                const data = await response.json();

                if (data.success) {
                    // Muestra la alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario actualizado con exito',
                        confirmButtonText: 'Aceptar',
                        timer: 2000
                    }).then(() => {
                        // Redirige a la página deseada después de cerrar la alerta
                        window.location.href = '../../Views/Administrador/verUsuarios.php';
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