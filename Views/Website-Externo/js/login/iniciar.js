document.addEventListener('DOMContentLoaded', function () {
    const inicioUserForm = document.querySelector("form[name='inicioUserForm']");
    const btnIniciarUser = inicioUserForm.querySelector(".btnIniciarUser");

    btnIniciarUser.addEventListener('click', async (e) => {
        e.preventDefault();

        const formData = new FormData(inicioUserForm);

        try {
            const response = await fetch(inicioUserForm.action, {
                method: inicioUserForm.method,
                body: formData
            });

            if (response.ok) {
                try {
                    const data = await response.json();

                    if (data.success) {
                        // Muestra la alerta de éxito según el rol del usuario
                        let mensajeBienvenida = `Bienvenido Usuario ${data.rol_usuario}`;

                        Swal.fire({
                            icon: 'success',
                            title: mensajeBienvenida,
                            confirmButtonText: 'Aceptar',
                            timer: 2000
                        }).then(() => {
                            // Realiza la redirección según el rol del usuario
                            window.location.href = data.redirect_url || 'ruta_por_defecto.php';
                        });
                    } else {
                        // Muestra la alerta de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error en el inicio de sesión',
                            text: data.message || 'Ocurrió un error en el servidor.'
                        });
                    }
                } catch (jsonError) {
                    console.error('Error al procesar la respuesta JSON:', jsonError);
                    throw new Error('Error en la respuesta JSON.');
                }
            } else {
                throw new Error('Error en la solicitud al servidor.');
            }
        } catch (error) {
            console.error('Error:', error);
            // Muestra la alerta de error si hay un problema con la solicitud
            Swal.fire({
                icon: 'error',
                title: 'Error, por favor complete los campos para iniciar sesión',
                text: 'Ocurrió un error en la solicitud al servidor.'
            });
        }
    });
});










