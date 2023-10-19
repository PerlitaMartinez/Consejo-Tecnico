<link rel="stylesheet" href="{{asset('assets/stylesForms.css')}}">

    <!-- Separador -->
    <hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

    <div style="display: flex; justify-content: center;">
        <div style="display: flex; justify-content: center;">
            <img src="{{ asset('assets/images/usuario.png') }}" alt="Imagen" class="img-fluid" style="width: 100px; height: 120px;">
        </div>
        <!-- Contenedor de la lista con fondo azul -->
        <div style="background-color: #B0E0E6; text-align: right; padding: 5px; width: 160px; height: 130px;">
            <ul style="list-style: none; color: #004a98;">
                <li>Clave única</li>
                <li>Nombre</li>
                <li>Carrera</li>
                <li>Tutor académico</li>
                <li>Coordinador</li>
            </ul>
        </div>
        <div style="background-color: #dfecde; padding: 5px; width: 480px; height: 130px;">
            <ul style="list-style: none; color: #0d2607;">
                <li>039999</li>
                <li>PATERNO MATERNO NOMBRES</li>
                <li>INGENIERIA EN SISTEMAS INTELIGENTES</li>
                <li>NUÑEZ VARELA JOSE IGNACIO</li>
                <li>PUENTE MONTEJANO CESAR AUGUSTO</li>
            </ul>
        </div>

    </div>

    <!-- Separador -->
    <hr style="border: 0px solid #DCDCDC; margin: 10px 0;">    

    <nav class="navbar navbar-expand-lg navbar-light" >
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded" href="/hctc/inicio"> <i class="fas fa-home-alt" id="icono_casa"></i> Inicio</a>
                </li> 
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded" href="/hctc/materia_unica">Materia Única</a>
                </li> 
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded" href="/hctc/carga_maxima">Carga Máxima</a>
                </li> 
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded" href="/hctc/formato_opcion_titulacion">Titulación</a>
                </li> 
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded" href="#">Seguimiento de Solicitudes</a>
                </li>
                <li class="nav-item mr-5" >
                    <a class="nav-link btn btn-primary rounded"  href="#"> <i class="fas fa-sign-out-alt" id="icono_salir"></i> Salir</a>
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

        #icono_salir
        {
            color: red;
        }

        #icono_casa
        {
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