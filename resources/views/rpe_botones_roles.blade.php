<div class="container mt-4" style="max-width: 900px;">
    <div class="d-flex flex-wrap justify-content-between">

        <div class="col-md-4 mb-3">
            <button id="btn-tutor-academico" class="btn btn-outline-custom btn-square" style="width: 100%; height:100%; margin-bottom: 10px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <i class="fas fa-user-tie" style="margin-top: 20px;"></i>
                <p style="margin-bottom: 20px; margin-top: 8px;">Tutor Académico</p>
            </button>
        </div>

        <div class="col-md-4 mb-3">
            <button id="btn-coordinador" class="btn btn-outline-custom btn-square" style="width: 100%; height:100%; margin-bottom: 10px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <i class="fas fa-users" style="margin-top: 20px;"></i>
                <p style="margin-bottom: 20px; margin-top: 8px;">Coordinador</p>
            </button>
        </div>

        <div class="col-md-4 mb-3">
            <button id="btn-jefe-de-area" class="btn btn-outline-custom btn-square" style="width: 100%; height:100%; margin-bottom: 10px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <i class="fas fa-user-cog" style="margin-top: 20px;"></i>
                <p style="margin-bottom: 20px; margin-top: 8px;">Jefe de Área</p>
            </button>
        </div>

        <div class="col-md-4 mb-3">
            <button id="btn-administrador" class="btn btn-outline-custom btn-square" style="width: 100%; height:100%; margin-bottom: 10px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <i class="fas fa-user-shield" style="margin-top: 20px;"></i> 
                <p style="margin-bottom: 20px; margin-top: 8px;">Administrador</p>
            </button>
        </div>

        <div class="col-md-4 mb-3">
            <button id="btn-director-secretario" class="btn btn-outline-custom btn-square" style="width: 100%; height:100%; margin-bottom: 10px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <i class="fas fa-users-cog" style="margin-top: 20px;"></i>
                <p style="margin-bottom: 20px; margin-top: 8px;">Director y Secretario</p>
            </button>
        </div>

        <div class="col-md-4 mb-3">
            <button id="btn-staff" class="btn btn-outline-custom btn-square" style="width: 100%; height:100%; margin-bottom: 10px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <i class="fas fa-users" style="margin-top: 20px;"></i>
                <p style="margin-bottom: 20px; margin-top: 8px;">Staff</p>
            </button>
        </div>

    </div>
</div>

<style>
    /* Cambiar el color del botón */
    .btn-outline-custom {
        color: #004a98;
        border-color: #004a98;
    }

    /* Cambiar el color al pasar el cursor sobre el botón */
    .btn-outline-custom:hover {
        background-color: #004a98;
        color: #fff;
    }
</style>

<!-- <style>
    /* Cambiar el color del botón */
    .btn-outline-custom {
        color: #fff;
        border-color: #004a98;
        background-color: #004a98;
        
    }

    /* Cambiar el color al pasar el cursor sobre el botón */
    .btn-outline-custom:hover {
        background-color: #fff;
        color: #004a98;
    }
</style> -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var btnTutorAcademico = document.getElementById('btn-tutor-academico');
        var btnCoordinador = document.getElementById('btn-coordinador');
        var btnJefeArea = document.getElementById('btn-jefe-de-area');
        var btnAdministrador = document.getElementById('btn-administrador');
        var btnDirectorSecretario = document.getElementById('btn-director-secretario');
        var btnStaff = document.getElementById('btn-staff');
        
        btnTutorAcademico.addEventListener('click', function () {
            actualizarRol('Tutor Académico');
        });

        btnCoordinador.addEventListener('click', function () {
            actualizarRol('Coordinador');
        });

        btnJefeArea.addEventListener('click', function () {
            actualizarRol('Jefe de Área');
        });

        btnAdministrador.addEventListener('click', function () {
            actualizarRol('Administrador');
        });

        btnDirectorSecretario.addEventListener('click', function () {
            actualizarRol('Director y secretario');
        });

        btnStaff.addEventListener('click', function () {
            actualizarRol('Staff');
        });
    });

    function actualizarRol(nuevoRol) {
        document.getElementById('rol-actual-value').innerText = nuevoRol;

        sessionStorage.setItem('rolActual', nuevoRol);
        
        // Lógica para redirigir a nuevas pantalla u otras acciones
        switch (nuevoRol) {

        case 'Administrador':
            // Redirigir a la página correspondiente al Administrador
            window.location.href = '{{ route("administrador") }}'; // Reemplaza con la ruta correcta
            break;

        case 'Tutor Académico':
            // Redirigir a la página correspondiente al Administrador
            window.location.href = '{{ route("tutor") }}'; // Reemplaza con la ruta correcta
            break;

        case 'Coordinador':
            // Redirigir a la página correspondiente al Administrador
            window.location.href = '{{ route("coordinador") }}'; // Reemplaza con la ruta correcta
            break;

        case 'Jefe de Área':
            // Redirigir a la página correspondiente al Administrador
            window.location.href = '{{ route("jefe_area") }}'; // Reemplaza con la ruta correcta
            break;

        case 'Director y secretario':
            // Redirigir a la página correspondiente al Administrador
            window.location.href = '{{ route("director_secretario") }}'; // Reemplaza con la ruta correcta
            break;
                    case 'Staff':
        //Redirigir a la pagina de Staff
            window.location.href = '{{ route("staff") }}';
            break;

        default:
            // Lógica predeterminada si no coincide con ningún caso
            window.location.href = '{{ route("rol") }}'; 
            break;
    }
        
    }
</script>