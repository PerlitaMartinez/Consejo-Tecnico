@extends('layouts.header')

@section('content')

    <!-- Agrega el enlace al archivo de estilo de Bootstrap si aún no está incluido -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <script>
        var texto="Prueba"
        document.addEventListener('DOMContentLoaded', function() {
            // Verifica si hay un rol almacenado en la sesión
            var rolAlmacenado = sessionStorage.getItem('rolActual');
            var claveUnicaValor;
            if (rolAlmacenado) {
                document.getElementById('rol-actual-value').innerText = rolAlmacenado;
            }

            // Agrega un evento de cambio al combo box
            var comboBox = document.getElementById('criterioSelect');
            var claveUnicaInput = document.getElementById('claveUnicaInput');

            comboBox.addEventListener('change', function() {
                // Habilita o deshabilita el cuadro de texto según la opción seleccionada
                claveUnicaInput.disabled = (comboBox.value !== 'clave_unica');
            });

            // Obtén una referencia al botón de consultar
            var consultarBtn = document.getElementById('consultarBtn');

            consultarBtn.addEventListener('click', function() {
                // Obtén el valor seleccionado en el combo box
                var criterioSeleccionado = comboBox.value;

                // Verifica si se ha seleccionado alguna opción en el combo box
                if (criterioSeleccionado === '') {
                    // Muestra una alerta de Bootstrap
                    var alertaBootstrap = document.createElement('div');
                    alertaBootstrap.classList.add('alert', 'alert-danger', 'mt-3');
                    alertaBootstrap.innerText = 'Por favor, selecciona un criterio antes de consultar.';
                    document.getElementById('mensajeContainer').appendChild(alertaBootstrap);

                    // Después de 3 segundos (3000 milisegundos), elimina la alerta
                    setTimeout(function() {
                        alertaBootstrap.remove();
                    }, 3000);

                    return; // Detén la ejecución si no se ha seleccionado ninguna opción
                }

                // Si la opción seleccionada es 'clave_unica', verifica el campo de clave única
                if (criterioSeleccionado === 'clave_unica') {
                    claveUnicaValor = claveUnicaInput.value.trim();

                    // Verifica si el campo de clave única está vacío
                    if (claveUnicaValor === '') {
                        // Muestra una alerta de Bootstrap indicando que se debe introducir algo
                        var alertaClaveUnicaVacia = document.createElement('div');
                        alertaClaveUnicaVacia.classList.add('alert', 'alert-danger', 'mt-3');
                        alertaClaveUnicaVacia.innerText = 'Por favor, introduce la clave única.';
                        document.getElementById('mensajeContainer').appendChild(alertaClaveUnicaVacia);

                        // Después de 3 segundos (3000 milisegundos), elimina la alerta
                        setTimeout(function() {
                            alertaClaveUnicaVacia.remove();
                        }, 3000);

                        return; // Detén la ejecución si el campo está vacío
                    }
                    //----------------Aqui se debería mandar llamar al servicio web Para consultar si la clave única Existe o no.

                }

                // Muestra la tabla correspondiente según la opción del radio seleccionada
                var tablaContainer = document.getElementById('tablaContainer');
                tablaContainer.innerHTML = ''; // Limpia el contenido actual

                var tablaMateriaUnica = document.getElementById('tablaMateriaUnica');
                var tablaCargaMaxima = document.getElementById('tablaCargaMaxima');
                var tablaOpcionTitulacion = document.getElementById('tablaOpcionTitulacion');

                // Oculta todas las tablas antes de mostrar la seleccionada
                tablaMateriaUnica.style.display = 'none';
                tablaCargaMaxima.style.display = 'none';
                tablaOpcionTitulacion.style.display = 'none';

                if (document.getElementById('cargaMaximaCheckbox').checked) {

                    if (criterioSeleccionado === 'clave_unica') {
                        $.ajax({
                            url: '{{ route('cargaMaximaReg') }}',
                            method: 'GET',
                            data: {
                                "clave_unica": claveUnicaValor
                            },
                            success: function(data) {


                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaCargaMaxima').html(data.html);
                                $('#tablaCargaMaxima').show();
                                //tablaMateriaUnica.style.display = 'block';
                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    } else if (criterioSeleccionado === 'todos') {
                        $.ajax({
                            url: '{{ route('cargaMaximaRegAll') }}',
                            method: 'GET',
                            data: {},
                            success: function(data) {


                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaCargaMaxima').html(data.html);
                                $('#tablaCargaMaxima').show();
                                //tablaMateriaUnica.style.display = 'block';
                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    }

                } else if (document.getElementById('materiaUnicaCheckbox').checked) {
                    if (criterioSeleccionado === 'clave_unica') {
                        $.ajax({
                            url: '{{ route('materiaUnicaReg') }}',
                            method: 'GET',
                            data: {
                                "clave_unica": claveUnicaValor
                            },
                            success: function(data) {


                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaMateriaUnica').html(data.html);
                                $('#tablaMateriaUnica').show();;
                                //tablaMateriaUnica.style.display = 'block';
                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    } else if (criterioSeleccionado === 'todos') {
                        $.ajax({
                            url: '{{ route('materiaUnicaAllReg') }}',
                            method: 'GET',
                            data: {

                            },
                            success: function(data) {


                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaMateriaUnica').html(data.html);
                                $('#tablaMateriaUnica').show();;
                                //tablaMateriaUnica.style.display = 'block';
                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    }

                    //console.log("materia unica");
                } else if (document.getElementById('opcionTitulacionCheckbox').checked) {
                    if (criterioSeleccionado === 'clave_unica') {
                        $.ajax({
                            url: '{{ route('opcionTitulacionReg') }}',
                            method: 'GET',
                            data: {
                                "clave_unica": claveUnicaValor
                            },
                            success: function(data) {


                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaOpcionTitulacion').html(data.html);
                                $('#tablaOpcionTitulacion').show();;
                                //tablaMateriaUnica.style.display = 'block';
                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    } else if (criterioSeleccionado === 'todos') {
                        $.ajax({
                            url: '{{ route('opcionTitulacionAllReg') }}',
                            method: 'GET',
                            data: {},
                            success: function(data) {

                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaOpcionTitulacion').html(data.html);
                                $('#tablaOpcionTitulacion').show();;
                                //tablaMateriaUnica.style.display = 'block';
                            },
                            error: function(error) {

                            }
                        });
                    }
                }
            });
        });
    </script>

    <script>
        function validarClaveUnica(event) {
            // Obtiene el valor actual del input
            var inputValue = event.target.value;

            // Reemplaza cualquier caracter no numérico por una cadena vacía
            var numericValue = inputValue.replace(/\D/g, '');

            // Actualiza el valor del input con solo números
            event.target.value = numericValue;
        }
    </script>


    @include('rpe_datos')

    @include('rpe_cinta')

    <div class="custom-container mt-4">
        <h2>Consultar solicitudes</h2>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-3">
                <select id="criterioSelect" class="form-select" aria-label="Default select example"
                    style="height: 100%; width: 100%">
                    <option value="" disabled selected hidden>Seleccionar criterio</option>
                    <option value="clave_unica">Clave única</option>
                    <option value="todos">Todos</option>
                </select>
            </div>
            <div class="col-md-3">
                <input id="claveUnicaInput" type="text" class="form-control" placeholder="Clave única"
                    oninput="validarClaveUnica(event)" disabled style="height: 100%; width: 100%">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary" id="consultarBtn"
                    style="height: 100%; width: 80%">Consultar</button>
            </div>
        </div>

        <!-- Nuevos radio buttons -->
        <div class="row mt-4 justify-content-center">
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="opciones" id="cargaMaximaCheckbox" checked>
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
        max-width: 70%;
        /* Ajusta el valor según tus necesidades */
        margin-right: auto;
        margin-left: auto;
    }

    .row {
        max-width: 95%;
        /* Ajusta el valor según tus necesidades */
        margin-right: auto;
        margin-left: auto;
    }
</style>
