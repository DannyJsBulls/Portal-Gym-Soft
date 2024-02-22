document.addEventListener('DOMContentLoaded', function () {
    const registroClienteForm = document.querySelector("form[name='registroClienteForm']");
    const btnRegistroCliente = registroClienteForm.querySelector(".btnRegistroCliente");

    btnRegistroCliente.addEventListener('click', async (e) => {
        e.preventDefault();

        const formData = new FormData(registroClienteForm);

        try {
            const response = await fetch(registroClienteForm.action, {
                method: registroClienteForm.method,
                body: formData
            });

            if (response.ok) {
                const data = await response.json();

                if (data.success) {
                    // Muestra la alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente registrado con exito',
                        confirmButtonText: 'Aceptar',
                        timer: 2000
                    }).then(() => {
                        // Redirige a la página deseada después de cerrar la alerta
                        window.location.href = '../../Views/Administrador/verTablaClientes.php';
                    });
                } else {
                    // Muestra la alerta de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en el registro',
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
                title: 'Error, por favor complete los campos para realizar el registro',
                text: 'Ocurrió un error en la solicitud al servidor.'
            });
        }
    });
});