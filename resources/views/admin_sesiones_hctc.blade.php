@extends('layouts.header')

@section('content')

@include('rpe_datos')

@include('rpe_cinta')
    
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif



<div class="custom-container mt-4">
    <h2>Sesiones Honorable Consejo Técnico Consultivo</h2>


    <!-- Botón "Nueva Sesión" 
    <button class="btn btn-primary mt-4" data-toggle="modal" data-target="#nuevaSesionModal">Nueva Sesión</button>-->

    <form action="{{route('admin_sesiones_crear')}}"method="POST">
        @csrf
        <input type="text" name = "fecha_sesion" placeholder="Fecha 0000-00-00" class="form-control mb-2">
        <input type="text" name = "tipo_sesion" placeholder="Tipo (Normal-Extraordinaria)" class="form-control mb-2">
        <button class="btn btn-primary btn-block" type="submit" > Agregar Sesion </button>

    </form>

    <!-- Lista de sesiones existentes (si las hay) -->
    <div class="mt-4">
        <table class="table">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se mostrarán las sesiones -->
                @foreach ($sesiones as $sesion )
                <tr>
                    <td> {{ $sesion->id_sesion_hctc }} </td>   
                    <td> {{ $sesion->fecha_sesion }} </td>  
                    <td> {{ $sesion->tipo_sesion }} </td>                
                @endforeach
            </tbody>
        </table>
    </div>
</div>





<!-- Modal para agregar nueva sesión 
<div class="modal fade" id="nuevaSesionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="nuevaSesionForm">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="text" name="fecha_sesion" class="form-control datepicker" id="fecha" placeholder="Seleccione la fecha">
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select class="form-control" id="tipo" name="tipo_sesion">
                            <option value="normal">Normal</option>
                            <option value="extraordinaria">Extraordinaria</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="guardarSesionButton" class="btn btn-primary">Guardar Sesión</button>
            </div>
        </div>
    </div>
</div> -->


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(function() {
        // Inicializa el DatePicker en el campo con clase 'datepicker'
        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy', // Formato de la fecha
            changeMonth: true,     // Permite cambiar el mes
            changeYear: true       // Permite cambiar el año
        });

        // Lista simulada de sesiones
        var sesionesSimuladas = [];

        // Función para agregar una sesión simulada
        function agregarSesionSimulada(fecha, tipo) {
            sesionesSimuladas.push({ fecha: fecha, tipo: tipo });
            actualizarSesionesList();
        }

        // Función para actualizar la lista de sesiones
        function actualizarSesionesList() {
            var sesionesList = $('#sesionesList');
            sesionesList.empty(); // Limpiar la lista

            sesionesSimuladas.forEach(function(sesion, index) {
                var row = $('<tr class="text-center">');
                row.append($('<td>').text(sesion.fecha));
                row.append($('<td>').text(sesion.tipo));

                // Agregar columnas de acciones con botones
                var accionesColumn = $('<td>');
                var eliminarButton = $('<button class="btn btn-danger"><i class="fas fa-x"></i></button>');

                eliminarButton.on('click', function() {
                    eliminarSesion(index);
                });

                accionesColumn.append(eliminarButton);
                row.append(accionesColumn);

                sesionesList.append(row);
            });
        }


        // Función para eliminar una sesión
        function eliminarSesion(index) {
            sesionesSimuladas.splice(index, 1);
            actualizarSesionesList();
        }

        // Agregar un manejador de eventos al botón "Guardar Sesión"
        $('#guardarSesionButton').on('click', function() {
            var fecha = $('#fecha').val();
            var tipo = $('#tipo').val();

            agregarSesionSimulada(fecha, tipo);

            // Cerrar el modal de nueva sesión
            $('#nuevaSesionModal').modal('hide');
        });

        // Inicializar la lista de sesiones
        actualizarSesionesList();
    });
</script>

@endsection

<style>
    .custom-container {
        max-width: 70%; /* Ajusta el valor según tus necesidades */
        margin-right: auto;
        margin-left: auto;
    }
</style>
