@php
    $lista = $dataSet[0];
    $dataSetSerializado = serialize($dataSet);
@endphp



{{-- <link rel="stylesheet" href="{{ asset('assets/stylesForms.css') }}"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<!-- Separador -->
<hr style="border: 0px solid #DCDCDC; margin: 5px 0;">

<div style="display: flex; justify-content: center;">
    <div style="display: flex; justify-content: center;">
        <img src="{{ asset('assets/images/usuario.png') }}" alt="Imagen" class="img-fluid"
            style="width: 100px; height: 120px;">
    </div>
    <!-- Contenedor de la lista con fondo azul -->
    <div style="background-color: #B0E0E6;  text-align: right; padding: 5px; width: 190px; height: 130px;">
        <ul style="list-style: none; color: #004a98;">
            <li>Clave única</li>
            <li>Nombre</li>
            <li>Carrera</li>
            <li>Tutor académico</li>
            <li>Coordinador</li>
        </ul>
    </div>
    <div style="background-color: #dfecde; width: 480px; height: 130px;">
        <ul style="list-style: none;  padding: 5px 5px 5px 5px; color: #0d2607;">
            <li>{{ $dataSet[0]['clave_unica'] }}</li>
            <li>{{ $dataSet[0]['nombre_alumno'] }}</li>
            <li>--</li>
            <li>--</li>
            <li>--</li>
        </ul>
    </div>

</div>

<!-- Separador -->
<hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item mr-5">
                <a class="nav-link btn btn-primary rounded" href={{ route('inicio.index', ['dataSet' => $dataSet]) }}>
                    <i class="fas fa-home-alt" id="icono_casa"></i> Inicio</a>
            </li>
            {{-- $lista->tiene_materia_única->__toString() == 'si' --}}
            @if (true)
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded"
                        href={{ route('materiaUnica.show', ['dataSet' => $dataSet, 'registered' => false, 'admin' => true ]) }}>Materia
                        Única</a>
                </li>
            @endif
            {{-- $lista->esta_car<ga_máxima->__toString() == 'si' --}}
            @if (true)
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded"
                        href={{ route('cargaMaxima.show', ['dataSet' => $dataSet]) }}>Carga Máxima</a>
                </li>
            @endif
            <li class="nav-item mr-5">
                <a class="nav-link btn btn-primary rounded"
                    href={{ route('titulacion.show', ['dataSet' => $dataSet]) }}>Titulación</a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link btn btn-primary rounded"
                    href={{ route('seguimiento.show', ['dataSet' => $dataSet]) }}>Seguimiento de Solicitudes</a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link btn btn-primary rounded" href="#"> <i class="fas fa-sign-out-alt"
                        id="icono_salir"></i> Salir</a>
            </li>
        </ul>
    </div>
</nav>

<!-- FontAwesome (para el ícono del botón) -->



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
