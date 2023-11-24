@extends('layouts.header')

@section('content')
    @include('rpe_datos')

    @include('rpe_cinta')

    <script>
        var claveActual;
        var registrada = false;
        document.addEventListener('DOMContentLoaded', function() {
            // Obtén referencias a los elementos que deseas mostrar/ocultar
            var materiaUnicaContainer = document.getElementById('materia-unica-view');
            var cargaMaximaContainer = document.getElementById('cs-carga-maxima');
            var opcionTitulacionContainer = document.getElementById('cs-opcion-titulacion');

            // Agrega un evento de cambio a los radio buttons
            var cargaMaximaCheckbox = document.getElementById('cargaMaximaCheckbox');
            var materiaUnicaCheckbox = document.getElementById('materiaUnicaCheckbox');
            var opcionTitulacionCheckbox = document.getElementById('opcionTitulacionCheckbox');

            cargaMaximaCheckbox.addEventListener('change', function() {
                // Oculta los elementos que no deben mostrarse
                materiaUnicaContainer.style.display = 'none';
                opcionTitulacionContainer.style.display = 'none';
                cargaMaximaContainer.style.display = 'block';
            });

            materiaUnicaCheckbox.addEventListener('change', function() {
                // Oculta los elementos que no deben mostrarse
                cargaMaximaContainer.style.display = 'none';
                opcionTitulacionContainer.style.display = 'none';
                materiaUnicaContainer.style.display = 'block';
            });

            opcionTitulacionCheckbox.addEventListener('change', function() {
                // Oculta ambos elementos en el caso de que estén visibles
                cargaMaximaContainer.style.display = 'none';
                materiaUnicaContainer.style.display = 'none';
                opcionTitulacionContainer.style.display = 'block';
            });

            // Verifica si hay un rol almacenado en la sesión
            var rolAlmacenado = sessionStorage.getItem('rolActual');
            var claveUnicaValor;
            if (rolAlmacenado) {
                document.getElementById('rol-actual-value').innerText = rolAlmacenado;
            }

            // Obtén una referencia al botón de consultar
            var consultarBtn = document.getElementById('consultarBtn');

            consultarBtn.addEventListener('click', function() {
                //verifica el campo de clave única
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

            });


        });

        $(document).ready(function() {
            var consultaEnProceso = false;

            $('#consultarBtn').click(function() {
          
                    consultaEnProceso = true;

                    var claveUnicaValor = $('#claveUnicaInput').val().trim();
                    var materiaUnicaCheckbox = $('#materiaUnicaCheckbox');
                    var opcionTitulacionCheckbox = $('#opcionTitulacionCheckbox');
                    var cargaMaximaCheckbox = $('#cargaMaximaCheckbox');
                    var solicitud;
                    var vista1;
                    var vista2;

                    if (claveUnicaValor == claveActual)
                        return;
                    else
                        claveActual = claveUnicaValor;


                    if (materiaUnicaCheckbox.prop('checked')) {
                        solicitud = "mu";
                        fetchDatosAlumnoAjax(claveUnicaValor, solicitud, false);
                        registrada = false;

                    }else if(opcionTitulacionCheckbox.prop('checked')){
                        solicitud = "ot";
                        fetchDatosAlumnoAjax(claveUnicaValor, solicitud, false);
                        registrada = false;
                    }else if(cargaMaximaCheckbox.prop('checked')){
                        solicitud = "cm";
                        fetchDatosAlumnoAjax(claveUnicaValor, solicitud, false);
                        registrada = false;
                    }
      
            });
        });

        var dataSet;

        function fetchDatosAlumnoAjax(claveUnicaValor, solicitud, pdf) {

            $.get('{{ route('AlumnoGet') }}', {
                clave_unica: claveUnicaValor,
                solicitud: solicitud
            }, function(data) {
                vista = data.infoAlumno;
                vista2 = data.infoAlumnoTramite;
                dataSet = data.dataSet;

                $('#infoAlumno').html(vista);
                $('#infoAlumno').show();
                if (solicitud == "mu") {
                    $('#materia-unica-view').html(vista2);
                    $('#materia-unica-view').show();

                }else if(solicitud == "ot"){
  
                    $('#cs-opcion-titulacion').html(vista2);
                    $('#cs-opcion-titulacion').show();
                }else if(solicitud == "cm"){
                    $('#cs-carga-maxima').html(vista2);
                    $('#cs-carga-maxima').show();
                }
            }, 'json');

        }
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



    <div class="custom-container mt-4">
        <h2>Crear Solicitud</h2>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-3 text-center">
                <label class="col-form-label">Clave única:</label>
            </div>
            <div class="col-md-3">
                <input id="claveUnicaInput" type="text" class="form-control" oninput="validarClaveUnica(event)"
                    style="height: 100%; width: 100%">
            </div>

            <div class="col-md-3">
                <button type="button" class="btn btn-primary" id="consultarBtn"
                    style="height: 100%; width: 80%">Consultar</button>
            </div>
        </div>


        <!-- Contenedor para la alerta -->
        <div id="mensajeContainer" class="row mt-4 justify-content-center"></div>

        <!-- CUADRO CON LOS DATOS DEL ALUMNO -->

        <div id="infoAlumno">
            {{-- @include('alumnos_tabla_datos') --}}
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

        <!-- Separador -->
        <hr style="border: 0px solid #DCDCDC; margin: 50px 0;">


        <div id="cs-carga-maxima" style="display: none;">
            <!-- Contenido de Carga Máxima aquí -->
            {{-- @include('cs_carga_maxima') --}}
        </div>


        <div id="materia-unica-view">
            <!-- Contenido de Materia Única aquí -->
            {{-- @include('cs_materia_unica') --}}
        </div>

        <div id="cs-opcion-titulacion" style="display: none;">
            <!-- Contenido de Materia Única aquí -->
            {{-- @include('cs_opcion_titulacion') --}}
        </div>


        <div class="contenedor-btns">
            <!-- Botones "Registrar Solicitud" y "Descargar Formato" -->
            <div class="row mt-4 justify-content-start">
                <div class="col-md-5">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="registrar-solicitud"
                        data-bs-target="#exampleModal" style="width: 100%">Registrar Solicitud</button>
                </div>
                {{-- <div class="col-md-5">
                    <button type="button" class="btn btn-success" style="width: 100%">Descargar Formato</button>
                </div> --}}
            </div>
        </div>

        <!-- Separador -->
        <hr style="border: 0px solid #DCDCDC; margin: 50px 0;">

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" data-backdrop="false" data-dismiss="modal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitud Materia Única
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro(a) que deseas registrar la solicitud?
                        <input type="hidden" id="selectedId" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id= "saveChangesButton" type="button" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

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

        .contenedor-btns {
            max-width: 75%;
            /* Ajusta el ancho máximo según tus necesidades */
            margin: 0 auto;
            /* Centra el contenedor horizontalmente */
            /* Otros estilos que desees aplicar */
        }
    </style>
@endsection
