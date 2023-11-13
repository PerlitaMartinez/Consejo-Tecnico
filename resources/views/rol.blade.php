@extends('layouts.header')

@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un rol almacenado en la sesión
        var rolAlmacenado = sessionStorage.getItem('rolActual');
        
        if (rolAlmacenado) {
            // Si no hay un rol almacenado, establece un rol por defecto
            var rolPorDefecto = ''; 
            document.getElementById('rol-actual-value').innerText = rolPorDefecto;
            sessionStorage.setItem('rolActual', rolPorDefecto);
        }
    });
</script>

@include('rpe_datos')

<!-- Separador -->
<hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">

            <li class="nav-item mr-5" id="btnInicio">
                <a class="nav-link btn btn-primary rounded" href="/hctc/rol"> <i class="fas fa-home-alt"
                        id="icono_casa"></i> Inicio</a>
            </li>

            <li class="nav-item mr-5" id="btnSalir">
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

@include('rpe_botones_roles')

@endsection
