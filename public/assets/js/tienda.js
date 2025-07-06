// Loader inicial que se muestra solo una vez
document.addEventListener('DOMContentLoaded', function () {
    if (localStorage.getItem('loaderShown')) {
        document.documentElement.classList.remove('loading');
        const loader = document.getElementById('loader');
        if (loader) loader.style.display = 'none';
    } else {
        setTimeout(function () {
            document.documentElement.classList.remove('loading');
            const loader = document.getElementById('loader');
            if (loader) loader.style.display = 'none';
        }, 2000); // Duración en milisegundos
        localStorage.setItem('loaderShown', 'true');
    }

    // Funciones de modales globales
    window.mostrarLogin = function() {
        cerrarModales();
        document.getElementById('modalLogin').classList.add('mostrar');
    };

    window.mostrarRegistro = function() {
        cerrarModales();
        document.getElementById('modalRegistro').classList.add('mostrar');
    };

    window.cerrarModales = function() {
        document.getElementById('modalLogin').classList.remove('mostrar');
        document.getElementById('modalRegistro').classList.remove('mostrar');
    };
});
