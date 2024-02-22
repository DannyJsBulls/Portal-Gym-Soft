document.addEventListener('DOMContentLoaded', function () {
    const actualizarProveedorForm = document.querySelector("form[name='actualizarProveedorForm']");
    const btnActualizarProveedor = actualizarProveedorForm.querySelector(".btnActualizarProveedor");

    btnActualizarProveedor.addEventListener('click', async (e) => {
        e.preventDefault();

        const formData = new FormData(actualizarProveedorForm);

        try {
            const response = await fetch(actualizarProveedorForm.action, {
                method: actualizarProveedorForm.method,
                body: formData
            });

            if (response.ok) {
                const data = await response.json();

                if (data.success) {
                    // Muestra la alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Proveedor actualizado con exito',
                        confirmButtonText: 'Aceptar',
                        timer: 2000
                    }).then(() => {
                        // Redirige a la página deseada después de cerrar la alerta
                        window.location.href = '../../Views/Administrador/verTablaProveedores.php';
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