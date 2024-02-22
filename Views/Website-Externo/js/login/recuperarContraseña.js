document.addEventListener('DOMContentLoaded', function () {
    const resetPassWordUserForm = document.querySelector("form[name='resetPassWordUserForm']");

    resetPassWordUserForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(resetPassWordUserForm);

        try {
            const response = await axios.post(resetPassWordUserForm.action, formData);
            console.log(response.data); // Verifica la respuesta del servidor en la consola

            if (response.data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Contraseña restablecida',
                    text: response.data.message,
                }).then(() => {
                    window.location.href = '../Extras/iniciarSesion.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.data.message || 'Ocurrió un error en el servidor.',
                });
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al procesar la solicitud. Por favor, inténtalo de nuevo.',
            });
        }
    }); 
});






