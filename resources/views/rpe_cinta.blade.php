<link rel="stylesheet" href="{{ asset('assets/stylesForms.css') }}">

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
    @if (isset($admin))
        <label class="btn btn-primary rounded mr-3" style="width: 150px; display: flex; align-items: center;">
            <input type="checkbox" id="adminCheckbox" onchange="showAdminOptions(this)" style="margin: 0;" checked>
            <span style="margin-left: 5px;">Administrador</span>
        </label>
    @else
        <label class="btn btn-primary rounded mr-3" style="width: 150px; display: flex; align-items: center;">
            <input type="checkbox" id="adminCheckbox" onchange="showAdminOptions(this)" style="margin: 0;">
            <span style="margin-left: 5px;">Administrador</span>
        </label>
    @endif
</div>

<!-- Separador -->
<hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item mr-5">
                <a class="nav-link btn btn-primary rounded" href="#"> <i class="fas fa-home-alt"
                        id="icono_casa"></i> Inicio</a>
            </li>

            <!-- Opciones Tutor -->

            <li class="nav-item tutor-option mr-5" style="display: none;">
                <!-- ALEXHD - en esta parte se tendría que pasar el id del usuarios autentificado para poder mostrar específicamente ciertas solicitudes que le correspondan -->
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesCargaMaxima()">Solicitudes Carga Máxima</a>
            </li>
            <li class="nav-item tutor-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesMateriaUnica()">Solicitudes Materia Única</a>
            </li>
            <li class="nav-item tutor-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesOpcionTitulacion()">Solicitudes Opción de Titulación</a>
            </li>  
            <!-- estas dos partes no se ven por que no existen aún controladores, ya que en el sprint los estuvieron haciendo -->
            <li class="nav-item tutor-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesRegistroTema()">Solicitudes Registro de Tema</a>
            </li> 
            <li class="nav-item tutor-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesAutorizacionTemario()">Solicitudes Autorización de Temario</a>
            </li> 
            <li class="nav-item tutor-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarTutorados()">Tutorados</a>
            </li>
            <!-- Fin de opciones Tutor -->



            <!-- Opciones Jefe de área -->
            
            <li class="nav-item jefeArea-option mr-5" style="display: none;">
                <!-- ALEXHD - en esta parte se tendría que pasar el id del usuarios autentificado para poder mostrar específicamente ciertas solicitudes que le correspondan -->
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesCargaMaxima()">Solicitudes Carga Máxima</a>
            </li>
            <li class="nav-item jefeArea-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesMateriaUnica()">Solicitudes Materia Única</a>
            </li>
            <li class="nav-item jefeArea-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesOpcionTitulacion()">Solicitudes Opción de Titulación</a>
            </li>  
            <!-- estas dos partes no se ven por que no existen aún controladores, ya que en el sprint los estuvieron haciendo -->
            <li class="nav-item jefeArea-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesRegistroTema()">Solicitudes Registro de Tema</a>
            </li> 
            <li class="nav-item jefeArea-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarSolicitudesAutorizacionTemario()">Solicitudes Autorización de Temario</a>
            </li> 
            <li class="nav-item jefeArea-option mr-5" style="display: none;">
                <!-- ALEXHD - en esta parte se tendría que pasar el id del usuarios autentificado para poder mostrar específicamente ciertas solicitudes que le correspondan -->
                <a class="nav-link btn btn-primary rounded" href="#" onclick="mostrarAlumnosArea()">Alumnos del Área</a>
            </li>
            <!-- Fin de opciones Jefe de área -->




            <!-- Opciones Administrador -->
            <li class="nav-item admin-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="#">Solicitudes</a>
            </li>

            <li class="nav-item admin-option mr-5" style="display: none;">
                <a class="nav-link btn btn-primary rounded" href="{{ route('agregarSolicitud.show') }}">Nueva
                    solicitud</a>
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
                <a class="nav-link btn btn-primary rounded" href="#"> <i class="fas fa-sign-out-alt"
                        id="icono_salir"></i> Salir</a>
            </li>
        </ul>
    </div>
</nav>


<!-- ALEXHD - card para que se muestre la lista de solicitudes entrantes, se tendría que enviar el id del tutor 
o jefe de área para que se entre a la base de datos y muestre las solicitudes específicas de el usuario --> 

<!-- esta parte hace una lista, pero se hacen muy pequeñas las columnas -->
{{-- <div id="cargaMax" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Solicitudes de Carga Máxima</h2></center><br><br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Solicitud</th>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Semestre</th>
                    <th scope="col">Materias Reprobadas</th>
                    <th scope="col">Duración y Media</th>
                    <th scope="col">Fecha Impresión</th>
                    <th scope="col">Fecha y Hora Tutor</th>
                    <th scope="col">Estado Solicitud</th>
                    <th scope="col">Clave Única</th>
                    <th scope="col">RPE Tutor</th>
                    <th scope="col">RPE Staff</th>
                    <th scope="col">ID Sesión HCTC</th>
                </tr>
            </thead>
            <tbody>
              @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id_solicitud_cm }}</td>
                    <td>{{ $solicitud->fecha_solicitud }}</td>
                    <td>{{ $solicitud->semestre }}</td>
                    <td>{{ $solicitud->materias_reprobadas }}</td>
                    <td>{{ $solicitud->duracion_y_media }}</td>
                    <td>{{ $solicitud->fecha_impresion }}</td>
                    <td>{{ $solicitud->fecha_hora_tutor }}</td>
                    <td>{{ $solicitud->estado_solicitud }}</td>
                    <td>{{ $solicitud->clave_unica }}</td>
                    <td>{{ $solicitud->rpe_tutor }}</td>
                    <td>{{ $solicitud->rpe_staff }}</td>
                    <td>{{ $solicitud->id_sesion_hctc }}</td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="MateriaUnica" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Solicitudes de Materia Única</h2></center><br><br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Solicitud</th>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Semestre</th>
                    <th scope="col">Fecha Impresión</th>
                    <th scope="col">Fecha y Hora Tutor</th>
                    <th scope="col">Estado Solicitud</th>
                    <th scope="col">Clave Única</th>
                    <th scope="col">RPE Tutor</th>
                    <th scope="col">RPE Staff</th>
                    <th scope="col">ID Sesión HCTC</th>
                    <th scope="col">Clave Materia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id_solicitud_mu }}</td>
                    <td>{{ $solicitud->fecha_solicitud }}</td>
                    <td>{{ $solicitud->semestre }}</td>
                    <td>{{ $solicitud->fecha_impresion }}</td>
                    <td>{{ $solicitud->fecha_hora_tutor }}</td>
                    <td>{{ $solicitud->estado_solicitud }}</td>
                    <td>{{ $solicitud->clave_unica }}</td>
                    <td>{{ $solicitud->rpe_tutor }}</td>
                    <td>{{ $solicitud->rpe_staff }}</td>
                    <td>{{ $solicitud->id_sesion_hctc }}</td>
                    <td>{{ $solicitud->clave_materia }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="OpcionTitulacion" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Solicitudes de Opción de Titulación</h2></center><br><br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Solicitud</th>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Semestre</th>
                    <th scope="col">Fecha y Hora Coordinador</th>
                    <th scope="col">Fecha Impresión</th>
                    <th scope="col">Estado Solicitud</th>
                    <th scope="col">Clave Única</th>
                    <th scope="col">RPE Staff</th>
                    <th scope="col">RPE Coordinador</th>
                    <th scope="col">ID Opción Titulación</th>
                    <th scope="col">ID Sesión HCTC</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id_solicitud_OT }}</td>
                    <td>{{ $solicitud->fecha_solicitud }}</td>
                    <td>{{ $solicitud->semestre }}</td>
                    <td>{{ $solicitud->fecha_hora_coordinador }}</td>
                    <td>{{ $solicitud->fecha_impresion }}</td>
                    <td>{{ $solicitud->estado_solicitud }}</td>
                    <td>{{ $solicitud->clave_unica }}</td>
                    <td>{{ $solicitud->rpe_staff }}</td>
                    <td>{{ $solicitud->rpe_coordinador }}</td>
                    <td>{{ $solicitud->id_opcion_titulacion }}</td>
                    <td>{{ $solicitud->id_sesion_hctc }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="RegistroTema" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Solicitudes de Registro de Tema</h2></center><br><br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Solicitud</th>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Trabajo Recepcional</th>
                    <th scope="col">Tema</th>
                    <th scope="col">RPE Asesor</th>
                </tr>
            </thead>
            <tbody>
                <!-- @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id_solicitud_OT }}</td>
                    <td>{{ $solicitud->fecha_solicitud }}</td>
                    <td>{{ $solicitud->trabajo_recepcional }}</td>
                    <td>{{ $solicitud->tema }}</td>
                    <td>{{ $solicitud->rpe_asesor }}</td>
                </tr>
                @endforeach -->
            </tbody>
        </table>
    </div>
</div>

<div id="temarioAutorizacion" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Autorizaciones de Temario</h2></center><br><br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Temario</th>
                    <th scope="col">ID Sección</th>
                    <th scope="col">Nombre Sección</th>
                    <th scope="col">ID Solicitud OT</th>
                </tr>
            </thead>
            <tbody>
                <!-- @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id_temario }}</td>
                    <td>{{ $solicitud->id_seccion }}</td>
                    <td>{{ $solicitud->nombre_seccion }}</td>
                    <td>{{ $solicitud->id_solicitud_OT }}</td>
                </tr>
                @endforeach -->
            </tbody>
        </table>
    </div>
</div>

<!-- ALEX HD - card para que se muestre la lista de los tutorados, se tendría que enviar el id del tutor 
para que se entre a la base de datos y muestre sus tutorados -->
<div id="tutorados" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Tutorados</h2></center><br><br>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Clave Única</th>
          <th scope="col">Nombre</th>
          <th scope="col">Generación</th>
          <!-- <th scope="col">Solicitudes</th> -->
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">12345</th>
          <td>Mark</td>
          <td>2020</td>
          <!-- <td>
            aquí se pondría un foreach para poner todas las solcitudes que tiene ese usuario
            lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
            lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
          </td> -->
        </tr>
        <tr>
          <th scope="row">23456</th>
          <td>Jacob</td>
          <td>2019</td>
          <!-- <td>
            aquí se pondría un foreach para poner todas las solcitudes que tiene ese usuario
            lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
            lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
          </td>         -->
        <tr>
          <th scope="row">34567</th>
          <td>Larry</td>
          <td>2022</td>
          <!-- <td>
            aquí se pondría un foreach para poner todas las solcitudes que tiene ese usuario
            lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
            lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
          </td>   -->
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div id="alumnosArea" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Alumnos del Área</h2></center><br><br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Clave Única</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Generación</th>
                    <!-- <th scope="col">Solicitudes</th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">A12345</th>
                    <td>John Doe</td>
                    <td>2021</td>
                    <!-- <td>
                        Aquí se pondría un foreach para poner todas las solicitudes que tiene ese usuario
                        Lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
                        Lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
                    </td> -->
                </tr>
                <tr>
                    <th scope="row">B23456</th>
                    <td>Jane Doe</td>
                    <td>2020</td>
                    <!-- <td>
                        Aquí se pondría un foreach para poner todas las solicitudes que tiene ese usuario
                        Lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
                        Lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
                    </td> -->
                </tr>
                <tr>
                    <th scope="row">C34567</th>
                    <td>Mario Rossi</td>
                    <td>2022</td>
                    <!-- <td>
                        Aquí se pondría un foreach para poner todas las solicitudes que tiene ese usuario
                        Lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
                        Lista de solicitudes <a href="#" class="btn btn-link btn-sm">Ver detalles</a><br>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </div>
</div>




<!-- aquí hace cada solicitud como en una card, se ven mejor los datos, y se podría poner el botón de cancelar 
solicitud, un poco más senciila, sin tener que hacer otra vista de detalles de solicitud -->
<!-- <div id="cargaMax" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Solicitudes de Carga Máxima</h2></center><br><br>

    <div class="card-deck">
        @foreach($solicitudes as $solicitud)
            <div class="card" style=" box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title">ID Solicitud: {{ $solicitud->id_solicitud_cm }}</h5>
                    <p class="card-text">Fecha Solicitud: {{ $solicitud->fecha_solicitud }}</p>
                    <p class="card-text">Semestre: {{ $solicitud->semestre }}</p>
                    <p class="card-text">Materias Reprobadas: {{ $solicitud->materias_reprobadas }}</p>
                    <p class="card-text">Duración y Media: {{ $solicitud->duracion_y_media }}</p>
                    <p class="card-text">Fecha Impresión: {{ $solicitud->fecha_impresion }}</p>
                    <p class="card-text">Fecha y Hora Tutor: {{ $solicitud->fecha_hora_tutor }}</p>
                    <p class="card-text">Estado Solicitud: {{ $solicitud->estado_solicitud }}</p>
                    <p class="card-text">Clave Única: {{ $solicitud->clave_unica }}</p>
                    <p class="card-text">RPE Tutor: {{ $solicitud->rpe_tutor }}</p>
                    <p class="card-text">RPE Staff: {{ $solicitud->rpe_staff }}</p>
                    <p class="card-text">ID Sesión HCTC: {{ $solicitud->id_sesion_hctc }}</p>
                    <a href="#" class="btn btn-danger btn-sm">Cancelar Solicitud</a>
                </div>
            </div>
        @endforeach
    </div>
</div> -->
<!-- esta es con cards de materia única -->
<!-- 
<div id="MateriaUnica" class="container-fluid" style="padding: 50px; display: none;">
    <center><h2>Solicitudes de Materia Única</h2></center><br><br>

    <div class="card-deck">
        @foreach($solicitudes as $solicitud)
            <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title">ID Solicitud: {{ $solicitud->id_solicitud_mu }}</h5>
                    <p class="card-text">Fecha Solicitud: {{ $solicitud->fecha_solicitud }}</p>
                    <p class="card-text">Semestre: {{ $solicitud->semestre }}</p>
                    <p class="card-text">Materias Reprobadas: {{ $solicitud->materias_reprobadas }}</p>
                    <p class="card-text">Duración y Media: {{ $solicitud->duracion_y_media }}</p>
                    <p class="card-text">Fecha Impresión: {{ $solicitud->fecha_impresion }}</p>
                    <p class="card-text">Fecha y Hora Tutor: {{ $solicitud->fecha_hora_tutor }}</p>
                    <p class="card-text">Estado Solicitud: {{ $solicitud->estado_solicitud }}</p>
                    <p class="card-text">Clave Única: {{ $solicitud->clave_unica }}</p>
                    <p class="card-text">RPE Tutor: {{ $solicitud->rpe_tutor }}</p>
                    <p class="card-text">RPE Staff: {{ $solicitud->rpe_staff }}</p>
                    <p class="card-text">ID Sesión HCTC: {{ $solicitud->id_sesion_hctc }}</p>
                    <p class="card-text">Clave Materia: {{ $solicitud->clave_materia }}</p>
                    <a href="#" class="btn btn-danger btn-sm">Cancelar Solicitud</a>
                </div>
            </div>
        @endforeach
    </div>
</div> --> --}}











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
            document.querySelectorAll('.jefeArea-option, .admin-option').forEach(option => option.style.display =
                'none');
        } else {
            // Si se desmarca el checkbox, ocultar todas las opciones
            document.querySelectorAll('.tutor-option, .jefeArea-option, .admin-option').forEach(option => option.style
                .display = 'none');
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
            document.querySelectorAll('.tutor-option, .jefeArea-option, .admin-option').forEach(option => option.style
                .display = 'none');
        }
    }

    function showAdminOptions(checkbox) {
        if (checkbox.checked) {
            // Mostrar opciones de Administrador
            document.querySelectorAll('.admin-option').forEach(option => option.style.display = 'block');
            // Ocultar opciones de Tutor y Jefe de área
            document.querySelectorAll('.tutor-option, .jefeArea-option').forEach(option => option.style.display =
                'none');
        } else {
            // Si se desmarca el checkbox, ocultar todas las opciones
            document.querySelectorAll('.tutor-option, .jefeArea-option, .admin-option').forEach(option => option.style
                .display = 'none');
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



    // ALEX HD - funciones para mostrar los cards correspondientes a lo seleccionado
    // me parece que aquí habría que enviar el id del usuario para sacar la info necesaria, hay que checarlo bien bien  
    function mostrarSolicitudesCargaMaxima() {
        document.getElementById('cargaMax').style.display = 'block';
        document.getElementById('MateriaUnica').style.display = 'none';
        document.getElementById('OpcionTitulacion').style.display = 'none';
        document.getElementById('RegistroTema').style.display = 'none'; //falta hacer la ruta, controlador y modelo
        document.getElementById('temarioAutorizacion').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('tutorados').style.display = 'none';
        document.getElementById('alumnosArea').style.display = 'none';
    }

    function mostrarSolicitudesMateriaUnica() {
        // Mostrar la card al hacer clic en "Solicitudes entrantes"
        document.getElementById('cargaMax').style.display = 'none';
        document.getElementById('MateriaUnica').style.display = 'block';
        document.getElementById('OpcionTitulacion').style.display = 'none';
        document.getElementById('RegistroTema').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('temarioAutorizacion').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('tutorados').style.display = 'none';
        document.getElementById('alumnosArea').style.display = 'none';
    }

    function mostrarSolicitudesOpcionTitulacion() {
        // Mostrar la card al hacer clic en "Solicitudes entrantes"
        document.getElementById('cargaMax').style.display = 'none';
        document.getElementById('MateriaUnica').style.display = 'none';
        document.getElementById('OpcionTitulacion').style.display = 'block';
        document.getElementById('RegistroTema').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('temarioAutorizacion').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('tutorados').style.display = 'none';
        document.getElementById('alumnosArea').style.display = 'none';
    }

    function mostrarSolicitudesRegistroTema() {
        // Mostrar la card al hacer clic en "Solicitudes entrantes"
        document.getElementById('cargaMax').style.display = 'none';
        document.getElementById('MateriaUnica').style.display = 'none';
        document.getElementById('OpcionTitulacion').style.display = 'none';
        document.getElementById('RegistroTema').style.display = 'block';//falta hacer la ruta, controlador y modelo
        document.getElementById('temarioAutorizacion').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('tutorados').style.display = 'none';
        document.getElementById('alumnosArea').style.display = 'none';
    }

    function mostrarSolicitudesAutorizacionTemario() {
        // Mostrar la card al hacer clic en "Solicitudes entrantes"
        document.getElementById('cargaMax').style.display = 'none';
        document.getElementById('MateriaUnica').style.display = 'none';
        document.getElementById('OpcionTitulacion').style.display = 'none';
        document.getElementById('RegistroTema').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('temarioAutorizacion').style.display = 'block';//falta hacer la ruta, controlador y modelo
        document.getElementById('tutorados').style.display = 'none';
        document.getElementById('alumnosArea').style.display = 'none';
    }


    function mostrarTutorados() {
        // Mostrar la card al hacer clic en "tutorados"
        document.getElementById('cargaMax').style.display = 'none';
        document.getElementById('MateriaUnica').style.display = 'none';
        document.getElementById('OpcionTitulacion').style.display = 'none';
        document.getElementById('RegistroTema').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('temarioAutorizacion').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('tutorados').style.display = 'block';
        document.getElementById('alumnosArea').style.display = 'none';
    }

    function mostrarAlumnosArea() {
        // Mostrar la card al hacer clic en "tutorados"
        document.getElementById('cargaMax').style.display = 'none';
        document.getElementById('MateriaUnica').style.display = 'none';
        document.getElementById('OpcionTitulacion').style.display = 'none';
        document.getElementById('RegistroTema').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('temarioAutorizacion').style.display = 'none';//falta hacer la ruta, controlador y modelo
        document.getElementById('tutorados').style.display = 'none';
        document.getElementById('alumnosArea').style.display = 'block';

    }

</script>
