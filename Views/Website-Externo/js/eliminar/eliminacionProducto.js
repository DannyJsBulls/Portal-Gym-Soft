// Función para asignar el evento de eliminación a los botones
function asignarEventoEliminacion() {
    // Agrega un evento de clic al contenedor padre de los botones
    document.addEventListener('click', function(e) {
        // Verifica si el clic ocurrió en un botón de eliminación
        const btnEliminacionProducto = e.target.closest('.btnEliminacionProducto');
        if (btnEliminacionProducto) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro de eliminar el producto?',
                text: '¡No podrás revertir esto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realiza la solicitud al servidor para eliminar el cliente
                    fetch(btnEliminacionProducto.getAttribute('href'))
                        .then(response => response.json())
                        .then(data => {
                            // Verifica la propiedad 'success' en la respuesta JSON
                            if (data.success) {
                                // Muestra la alerta de éxito
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    confirmButtonText: 'Aceptar',
                                    timer: 2000
                                }).then(() => {
                                    // Redirige a la página de productos después de cerrar la alerta
                                    window.location.href = '../../Views/Administrador/verProductos.php';
                                });
                            } else {
                                // Muestra la alerta de error
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error al eliminar el producto',
                                    text: data.message
                                });
                            }
                        })
                        .catch(error => {
                            // Muestra la alerta de error si hay un problema con la solicitud
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al eliminar el producto',
                                text: 'Ocurrió un error en la solicitud al servidor.'
                            });
                        });
                }
            });
        }
    });
}

// Llama a la función para asignar el evento cuando se carga la página inicialmente
asignarEventoEliminacion();