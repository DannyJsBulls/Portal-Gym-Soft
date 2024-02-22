document.addEventListener('DOMContentLoaded', function () {
    const formRegistroUser = document.querySelector("form[name='registerUserForm']");
    const btnRegisterUser = formRegistroUser.querySelector(".btnRegisterUser");

    btnRegisterUser.addEventListener('click', async (e) => {
        e.preventDefault();

        const formData = new FormData(formRegistroUser);

        try {
            const response = await fetch(formRegistroUser.action, {
                method: formRegistroUser.method,
                body: formData
            });

            if (response.ok) {
                const data = await response.json();

                if (data.success) {
                    // Muestra la alerta de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Exitoso',
                        confirmButtonText: 'Aceptar',
                        timer: 2000
                    }).then(() => {
                        // Redirige a la página deseada después de cerrar la alerta
                        window.location.href = '../../Views/Extras/iniciarSesion.php';
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
                title: 'Error, por favor complete los campos para registrarse en el sistema',
                text: 'Ocurrió un error en la solicitud al servidor.'
            });
        }
    });
});