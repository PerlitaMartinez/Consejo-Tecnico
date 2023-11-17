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
    <h2>Consulta Solicitudes De Materia Unica</h2>
    <hr style="border: 0px solid #DCDCDC; margin: 10px 0;">
    <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h6> Clave Unica</h6>
            <input type="text" class="form-control" id="campoTexto">
            <button class="btn btn-primary" id="descargar-respuesta"> Consultar</button>

          </div>
          <div class="col-md-4">
            <h6> Estado Solictud </h6>
            <select class="form-select btn btn-primary">
              <!-- Opciones del segundo select -->
              <option selected>ALTA</option>
              <option selected>ENTREGADO</option>
            </select>
          </div>
          <div class="col-md-4">
            <h6> Sesion HCTC </h6>
            <select class="form-select btn btn-primary">
              <!-- Opciones del tercer select -->
              <option selected>10/12/2023</option>
              <option selected>01/03/2021</option>
            </select>
          </div>
       
        </div>
      </div>
       

</div>

<div class="mt-4">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th class="text-center">Id_solicitud</th>
                <th class="text-center">Fecha Solicitud</th>
                <th class="text-center">Semestre</th>
                <th class="text-center">Clave Unica</th>
                <th class="text-center">Alumno</th>
                <th class="text-center">Carrera</th>
                <th class="text-center">Fecha Sesión</th>
                <th class="text-center">Materia</th>
                <th class="text-center">Asesor</th>
                <th class="text-center">Estado Solicitud</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>10/10/2023</td>
                <td>2022-2023/I</td>
                <td>9999</td>
                <td>Martinez Juan</td>
                <td>Ingenieria en Computacion</td>
                <td>18/10/2023</td>
                <td>Algebra A</td>
                <td>Nuñez Varela Ignacio</td>
                <td>Alta</td>
            </tr>
          
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <button class="btn btn-success" id="descargar-respuesta"> Exportar XLSX</button>
      </div>
      
    

</div>

</div>



<!-- Contenedor para la alerta -->
<div id="mensajeContainer" class="row mt-4 justify-content-center"></div>

<!-- Contenedor para la tabla -->
<div id="tablaContainer" class="row mt-4 justify-content-center"></div>

<div id="tablaMateriaUnica" class="tabla-container" style="display:none;">
    @include('tabla_consulta_materia_unica')
</div>

<!-- Tabla carga maxima -->
<div id="tablaCargaMaxima" class="tabla-container" style="display:none;">
    @include('tabla_consulta_carga_maxima')
</div>

<!-- Tabla opcion titulación -->
<div id="tablaOpcionTitulacion" class="tabla-container" style="display:none;">
    @include('tabla_consulta_opcion_titulacion')
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