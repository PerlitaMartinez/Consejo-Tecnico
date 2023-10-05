@extends('layouts.header')

@section('description')
<div class="user-info">
    <span>Nombre del Usuario</span> <br>
    <span>Tipo de Usuario</span> <br>
    <button class="btn btn-danger btn-sm">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </button>
</div>
@endsection

@section('content')
    <link rel="stylesheet" href="{{asset('assets/stylesForms.css')}}">
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded" href="/hctc/inicio">Formatos para solicitudes</a>
                </li> 
                <li class="nav-item mr-5">
                    <a class="nav-link btn btn-primary rounded" href="#">Seguimiento de solicitudes</a>
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
        .btn.btn-danger.btn-sm {
            background-color: #004a98;
            color: white;
            border: none;
        }

        .btn.btn-danger.btn-sm:hover {
            background-color: white;
            color: #004a98;
        }

        .btn.btn-primary.rounded {
            background-color: white;
            color: #004a98;
            border: none;
        }

        .btn-primary.rounded:hover {
            background-color: #004a98 !important;
            color: white !important;
        }

       
        .btn-large-container {
            display: flex;
            justify-content: center;
            margin-top: 40px; 
        }

        .btn-large {
            width: 25%; /* Ancho de los botones */
            height: 120px; /* Altura de los botones */
            font-size: 20px; /* Tamaño de fuente de los botones */
            margin: 20px 30px; /* Espacio entre los botones */
            text-align: center; /* Centra el texto horizontalmente */
            display: flex;
            align-items: center; /* Centra el texto verticalmente */
            justify-content: center;
        }
    </style>
    
    <!-- Botones grandes en línea -->
    <div class="btn-large-container">
        <a class="btn btn-large btn-primary" href="/hctc/materia_unica">Materia Única</a>
        <a class="btn btn-large btn-primary" href="{{ route('cargaMaxima.show')}}">Carga Máxima</a>
        <a class="btn btn-large btn-primary" href="/hctc/solicitudes/titulacion">Opciones de Titulación</a>
    </div>
@endsection
