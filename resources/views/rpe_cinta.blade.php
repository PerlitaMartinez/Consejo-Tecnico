<link rel="stylesheet" href="{{asset('assets/stylesForms.css')}}">

<!-- Separador -->
<hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

<div style="display: flex; justify-content: center;">
    <!-- Contenedor de la lista con fondo azul -->
    <div style="background-color: #B0E0E6; text-align: right; padding: 5px; width: 160px; height: 55px;">
        <ul style="list-style: none; color: #004a98;">
            <li>RPE</li>
            <li>Nombre</li>
        </ul>
    </div>
    <div style="background-color: #dfecde; padding: 5px; width: 480px; height: 55px;">
        <ul style="list-style: none; color: #0d2607;">
            <li>039999</li>
            <li>PATERNO MATERNO NOMBRES</li>
        </ul>
    </div>
</div>

<!-- Separador -->
<hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

<!-- Cinta de opciones con botones y checkbox -->
<div style="display: flex; justify-content: center;">
    <label class="btn btn-primary rounded mr-3" style="width: 150px; display: flex; align-items: center;">
        <input type="checkbox" id="tutorCheckbox" onchange="showTutorOptions(this)" style="margin: 0;">
        <span style="margin-left: 5px;">Tutor</span>
    </label>
    <label class="btn btn-primary rounded mr-3" style="width: 150px; display: flex; align-items: center;">
        <input type="checkbox" id="jefeAreaCheckbox" onchange="showJefeAreaOptions(this)" style="margin: 0;">
        <span style="margin-left: 5px;">Jefe de área</span>
    </label>
    <label class="btn btn-primary rounded mr-3" style="width: 150px; display: flex; align-items: center;">
        <input type="checkbox" id="adminCheckbox" onchange="showAdminOptions(this)" style="margin: 0;">
        <span style="margin-left: 5px;">Administrador</span>
    </label>
</div>

<!-- Separador -->
<hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item mr-5">
                <a class="nav-link btn btn-primary rounded" href="#"> <i class="fas fa-home-alt" id="icono_casa"></i> Inicio</a>
            </li>

            <!-- Opciones Tutor -->
            <li class="nav-item tutor-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Solicitudes en proceso</a>
            </li>
            <li class="nav-item tutor-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Solicitudes entrantes</a>
            </li>
            <li class="nav-item tutor-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Tutorados</a>
            </li>
            <!-- Fin de opciones Tutor -->

            <!-- Opciones Jefe de área -->
            <li class="nav-item jefeArea-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Solicitudes en proceso</a>
            </li>
            <li class="nav-item jefeArea-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Solicitudes entrantes</a>
            </li>
            <!-- Fin de opciones Jefe de área -->

            <!-- Opciones Administrador -->
            <li class="nav-item admin-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Solicitudes</a>
            </li>
            <li class="nav-item admin-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Nueva solicitud</a>
            </li>
            <li class="nav-item admin-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Usuarios</a>
            </li>
            <li class="nav-item admin-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Procedimientos</a>
            </li>
            <li class="nav-item admin-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Sesiones HCTC</a>
            </li>
            <!-- Fin de opciones Administrador -->           



            <li class="nav-item mr-5">
                <a class="nav-link btn btn-primary rounded" href="#"> <i class="fas fa-sign-out-alt" id="icono_salir"></i> Salir</a>
            </li>
        </ul>
    </div>
</nav>

<!-- FontAwesome (para el ícono del botón) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

<script>
    function showTutorOptions(checkbox) {
        if (checkbox.checked) {
            // Mostrar opciones de Tutor
            document.querySelectorAll('.tutor-option').forEach(option => option.style.display = 'block');
            // Ocultar opciones de Jefe de área y Administrador
            document.querySelectorAll('.jefeArea-option, .admin-option').forEach(option => option.style.display = 'none');
        } else {
            // Si se desmarca el checkbox, ocultar todas las opciones
            document.querySelectorAll('.tutor-option, .jefeArea-option, .admin-option').forEach(option => option.style.display = 'none');
        }
    }

    function showJefeAreaOptions(checkbox) {
        if (checkbox.checked) {
            // Mostrar opciones de Jefe de área
            document.querySelectorAll('.jefeArea-option').forEach(option => option.style.display = 'block');
            // Ocultar opciones de Tutor y Administrador
            document.querySelectorAll('.tutor-option, .admin-option').forEach(option => option.style.display = 'none');
        } else {
            // Si se desmarca el checkbox, ocultar todas las opciones
            document.querySelectorAll('.tutor-option, .jefeArea-option, .admin-option').forEach(option => option.style.display = 'none');
        }
    }

    function showAdminOptions(checkbox) {
        if (checkbox.checked) {
            // Mostrar opciones de Administrador
            document.querySelectorAll('.admin-option').forEach(option => option.style.display = 'block');
            // Ocultar opciones de Tutor y Jefe de área
            document.querySelectorAll('.tutor-option, .jefeArea-option').forEach(option => option.style.display = 'none');
        } else {
            // Si se desmarca el checkbox, ocultar todas las opciones
            document.querySelectorAll('.tutor-option, .jefeArea-option, .admin-option').forEach(option => option.style.display = 'none');
        }
    }

    // Asegurarse de que solo se pueda seleccionar un checkbox a la vez
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            checkboxes.forEach(otherCheckbox => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        });
    });
</script>
