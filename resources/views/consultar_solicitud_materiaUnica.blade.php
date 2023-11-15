@extends('layouts.header')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un rol almacenado en la sesión
        var rolAlmacenado = sessionStorage.getItem('rolActual');
        
        if (rolAlmacenado) {
            document.getElementById('rol-actual-value').innerText = rolAlmacenado;
        }

        // Agrega un evento de cambio al combo box
        var comboBox = document.getElementById('criterioSelect');
        var claveUnicaInput = document.getElementById('claveUnicaInput');

        comboBox.addEventListener('change', function () {
            // Habilita o deshabilita el cuadro de texto según la opción seleccionada
            claveUnicaInput.disabled = (comboBox.value !== 'clave_unica');
        });
    });
</script>

@include('rpe_datos')

@include('rpe_cinta')

<div class="custom-container mt-4">
    <h2>Consultar solicitud De Materia Unica</h2>
    <hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

    
    <div class="row mt-4 justify-content-center">
        @include('rpe_datos')
        <hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

    <h5>Seleccionar materia para registrarla como única</h5>
    <hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

  

    <div class="mt-4">

        <select id="criterioSelect" class="form-select" aria-label="Default select example" style="height: 100%; width: 100%">
            <option value="" disabled selected hidden>Seleccionar criterio</option>
            <option value="clave_unica">Clave única</option>
            <option value="todos">Todos</option>
        </select>
      
      </div>  
    </div>

</div>





@endsection

<style>
    /* Agrega un estilo personalizado para el contenedor */
    .custom-container {
        max-width: 70%; /* Ajusta el valor según tus necesidades */
        margin-right: auto;
        margin-left: auto;
    }

    .row {
        max-width: 95%; /* Ajusta el valor según tus necesidades */
        margin-right: auto;
        margin-left: auto;
    }
</style>