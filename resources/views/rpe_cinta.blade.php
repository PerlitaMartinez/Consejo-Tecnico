<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Separador -->
<hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">

            <li class="nav-item mr-5" id="btnInicio" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="/hctc/rol"> <i class="fas fa-home-alt"
                        id="icono_casa"></i> Inicio</a>
            </li>

<!-- Botones que le pertenecen a todos los roles -->
            <li class="nav-item mr-5" id="btnSolicitudes" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href='{{ route("consultar_solicitudes") }}'>Consulta de Solicitudes</a>
            </li>

<!-- Botones para el rol Tutor Academico -->
            <li class="nav-item mr-5" id="btnTutorados" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="/tutorados" onclick="#">Tutorados</a>
            </li>

<!-- Botones para el rol Administrador -->
            <li class="nav-item mr-5" id="btnUsuarios" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="#">Usuarios</a>
            </li>
            <li class="nav-item mr-5" id="btnSesionesHCTC" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href='{{ route("admin_sesiones_hctc") }}' onclick="#">Sesiones HCTC</a>
            </li>

<!-- Botones para el rol Staff -->
    

            <li class="nav-item mr-5" id="btnCrearSolicitudes" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="#">Crear Solicitudes</a>
            </li>

            <li class="nav-item mr-5" id="btnSesionesHCTC" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href={{ route("admin_sesiones_hctc") }}'>Sesiones del HCTC</a>
            </li>



            <li class="nav-item mr-5" id="btnSalir" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#"> <i class="fas fa-sign-out-alt"
                        id="icono_salir"></i> Salir</a>
            </li>

        </ul>
    </div>
</nav>

<style>
    .navbar {
        background-color: #DCDCDC;
    }

    #icono_salir {
        color: red;
    }

    #icono_casa {
        color: #00b2e3;
    }

    .btn.btn-primary.rounded {
        background-color: #DCDCDC;
        color: black !important;
        border: none;
    }

    .btn-primary.rounded:hover {
        background-color: #004a98 !important;
        color: white !important;
    }
</style>

<!-- FontAwesome (para el ícono del botón) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<script>
    if (typeof jQuery == 'undefined') {
        // console.error('jQuery no está cargado.');
    } else {
        // console.error('jQuery está cargado.');
        document.addEventListener('DOMContentLoaded', function () {
            // Verifica si hay un rol almacenado en la sesión
            var rolAlmacenado = sessionStorage.getItem('rolActual');

            if (rolAlmacenado) {
                document.getElementById('rol-actual-value').innerText = rolAlmacenado;

                // Mapeo de roles a clases de opciones de la cinta
                var rolesYClases = {
                    'Tutor Académico': ['btnInicio', 'btnSalir', 'btnSolicitudes', 'btnTutorados'],
                    'Coordinador': ['btnInicio', 'btnSalir', 'btnSolicitudes'],
                    'Jefe de Área': ['btnInicio', 'btnSalir', 'btnSolicitudes'],
                    'Administrador': ['btnInicio', 'btnSalir', 'btnSolicitudes', 'btnUsuarios', 'btnSesionesHCTC'],
                    'Director y secretario': ['btnInicio', 'btnSalir', 'btnSolicitudes'],
                    'Staff': ['btnInicio', 'btnSalir', 'btnSolicitudes'],
                };

                // Muestra u oculta elementos específicos usando css()
                if (rolesYClases.hasOwnProperty(rolAlmacenado)) {
                    // Ocultar todos los elementos primero
                    $('[id^=btn]').css('display', 'none');

                    // Mostrar los elementos específicos para el rol actual
                    rolesYClases[rolAlmacenado].forEach(function (clase) {
                        $('#' + clase).css('display', 'block');
                    });
                }
            }
        });
    }

</script>