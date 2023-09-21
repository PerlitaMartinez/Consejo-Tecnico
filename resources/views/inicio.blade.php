
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
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown mr-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Alumno</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Trámite A</a>
                        <a class="dropdown-item" href="#">Trámite B</a>
                    </div>
                </li>
                <li class="nav-item dropdown mr-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Profesor</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Trámite C</a>
                        <a class="dropdown-item" href="#">Trámite D</a>
                    </div>
                </li>
                <li class="nav-item dropdown mr-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Tutor</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Trámite E</a>
                        <a class="dropdown-item" href="#">Trámite F</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Staff</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Trámite G</a>
                        <a class="dropdown-item" href="#">Trámite H</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>




    <!-- FontAwesome (para el ícono del botón) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection

