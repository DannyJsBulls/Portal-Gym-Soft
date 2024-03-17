// Función para cerrar sesión por inactividad
function startTimer() {
    // Definir tiempo de inactividad en milisegundos (por ejemplo, 5 minutos)
    const inactivityTime = 8 * 60 * 1000; // 8 minutos
    let timer;
    let logoutPending = false;

    // Reiniciar el temporizador si hay actividad
    function resetTimer() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            logoutPending = true;
        }, inactivityTime);
    }

    // Cerrar sesión si hay un cierre pendiente y hay actividad
    function logoutIfPending() {
        if (logoutPending) {
            logout();
        }
    }

    // Cerrar sesión
    function logout() {
        // Redirigir al usuario a la página de inicio de sesión
        window.location.href = '../../Controller/cerrarSesion.php';
    }

    // Detectar eventos de actividad del usuario
    function handleActivity() {
        resetTimer();
        if (logoutPending) {
            logoutPending = false;
            logout();
        }
    }

    // Iniciar temporizador al cargar la página
    window.onload = resetTimer;
    document.addEventListener("click", handleActivity);
    document.addEventListener("mousemove", handleActivity);
    document.addEventListener("keypress", handleActivity);

    // Verificar si hay un cierre pendiente al enfocar la ventana
    window.addEventListener("focus", logoutIfPending);
}

// Iniciar temporizador al cargar la página
startTimer();


