@extends('layouts.header')

@section('content')

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
    <h2>Consultar solicitudes</h2>
    <div class="row mt-4 justify-content-center">
        <div class="col-md-3">
            <select id="criterioSelect" class="form-select" aria-label="Default select example" style="height: 100%; width: 100%">
                <option value="" disabled selected hidden>Seleccionar criterio</option>
                <option value="clave_unica">Clave única</option>
                <option value="todos">Todos</option>
            </select>
        </div>
        <div class="col-md-3">
            <input id="claveUnicaInput" type="text" class="form-control" placeholder="Clave única" disabled style="height: 100%; width: 100%">
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" style="height: 100%; width: 80%">Consultar</button>
        </div>
    </div>

    <!-- Nuevos radio buttons -->
    <div class="row mt-4 justify-content-center">
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opciones" id="cargaMaximaCheckbox">
                <label class="form-check-label" for="cargaMaximaCheckbox">
                    Carga Máxima
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opciones" id="materiaUnicaCheckbox">
                <label class="form-check-label" for="materiaUnicaCheckbox">
                    Materia Única
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opciones" id="opcionTitulacionCheckbox">
                <label class="form-check-label" for="opcionTitulacionCheckbox">
                    Opción de Titulación
                </label>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="mt-4">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">Folio</th>
                    <th class="text-center">Materia</th>
                    <th class="text-center">Semestre</th>
                    <th class="text-center">Formato</th>
                    <th class="text-center">Aprobar</th>
                    <th class="text-center">Detalles</th>
                    <th class="text-center">Descargar</th>
                    <th class="text-center">Cancelar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>Materia A</td>
                    <td>3</td>
                    <td>Formato X</td>
                    <td class="text-center"><button class="btn btn-success"><i class="fas fa-check"></i></button></td>
                    <td class="text-center"><button class="btn btn-info"><i class="fas fa-circle-info"></i></button></td>
                    <td class="text-center"><button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button></td>
                    <td class="text-center"><button class="btn btn-danger"><i class="fas fa-x"></i></button></td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Materia B</td>
                    <td>5</td>
                    <td>Formato Y</td>
                    <td class="text-center"><button class="btn btn-success"><i class="fas fa-check"></i></button></td>
                    <td class="text-center"><button class="btn btn-info"><i class="fas fa-circle-info"></i></button></td>
                    <td class="text-center"><button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button></td>
                    <td class="text-center"><button class="btn btn-danger"><i class="fas fa-x"></i></button></td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Materia C</td>
                    <td>2</td>
                    <td>Formato Z</td>
                    <td class="text-center"><button class="btn btn-success"><i class="fas fa-check"></i></button></td>
                    <td class="text-center"><button class="btn btn-info"><i class="fas fa-circle-info"></i></button></td>
                    <td class="text-center"><button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button></td>
                    <td class="text-center"><button class="btn btn-danger"><i class="fas fa-x"></i></button></td>
                </tr>
            </tbody>
        </table>
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
