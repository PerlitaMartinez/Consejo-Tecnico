@extends('layouts.header')

@section('content')

    <!-- Agrega el enlace al archivo de estilo de Bootstrap si aún no está incluido -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <script>
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

            var datos =
                {
                    'MateriaUnica': null,
                    'CargaMaxima': null,
                    'OpcionTitulacion': null,
                };

            var tabs = {
                'materia_unica': 'none',
                'carga_maxima': 'block',
                'titulacion': 'none',
                'active': 'cargaMaximaCheckbox'
            };

            function exportarAExcel(datos, label) {
                /* generate worksheet and workbook */
                const worksheet = XLSX.utils.json_to_sheet(datos);
                const workbook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(workbook, worksheet, label);

                // /* fix headers */
                // XLSX.utils.sheet_add_aoa(worksheet, [["Name", "Birthday"]], { origin: "A1" });

                /* calculate column width */
                // const max_width = datos.reduce((w, r) => Math.max(w, r.name.length), 10);
                // worksheet["!cols"] = [ { wch: max_width } ];

                XLSX.writeFile(workbook, label + ".xlsx", { compression: true });
            }

            function ShowExportButton() {
                var botonExportar = document.getElementById('exportar');
                botonExportar.style.display = 'none';

                showButtonForCheckbox('materiaUnicaCheckbox', datos.MateriaUnica, 'MateriaUnica');
                showButtonForCheckbox('cargaMaximaCheckbox', datos.CargaMaxima, 'CargaMaxima');
                showButtonForCheckbox('opcionTitulacionCheckbox', datos.OpcionTitulacion, 'OpcionTitulacion');
            }

            function showButtonForCheckbox(checkboxId, data, label) {
                var active = tabs.active == checkboxId;
                console.log(tabs.active);
                if (active && data != null && data.length > 0) {
                    var botonExportar = document.getElementById('exportar');

                    // Crea un nuevo manejador de eventos
                    var handleExportClick = function (event) {
                        exportarAExcel(data, label);
                    };

                    // Remueve el manejador de eventos anterior si existe
                    botonExportar.removeEventListener('click', handleExportClick);

                    // Agrega el nuevo manejador de eventos
                    botonExportar.style.display = 'block';
                    botonExportar.addEventListener('click', handleExportClick);
                }
            }

            ShowExportButton();

            var filtros = document.getElementById('filtros');
            var checkboxContainer = document.getElementById('checkboxContainer');
            // filtros.style.display = 'none';
            checkboxContainer.addEventListener('change', function (event) {
                // Verifica si el evento se originó desde un checkbox
                if (event.target.type === 'radio') {
                    var tablaContainer = document.getElementById('tablaContainer');
                    tablaContainer.innerHTML = ''; // Limpia el contenido actual

                    // Oculta todas las tablas antes de mostrar la seleccionada
                    tablaMateriaUnica.style.display = 'none';
                    tablaCargaMaxima.style.display = 'none';
                    tablaOpcionTitulacion.style.display = 'none';
                    if (document.getElementById('cargaMaximaCheckbox').checked) {
                        tabs.active = 'cargaMaximaCheckbox';
                        tablaCargaMaxima.style.display = 'block';
                    } else if (document.getElementById('materiaUnicaCheckbox').checked) {
                        tablaMateriaUnica.style.display = 'block';
                        tabs.active = 'materiaUnicaCheckbox';

                    } else if (document.getElementById('opcionTitulacionCheckbox').checked) {
                        tablaOpcionTitulacion.style.display = 'block';
                        tabs.active = 'opcionTitulacionCheckbox';

                    }

                    console.log('en container: ' + tabs.active);
                    ShowExportButton();
                }
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
                var estadoSolicitud = document.getElementById('estadoSolicitud');
                var hctc = document.getElementById('hctc');
                if (document.getElementById('cargaMaximaCheckbox').checked) {
                    tabs.active = 'cargaMaximaCheckbox';

                    if (criterioSeleccionado === 'clave_unica') {
                        $.ajax({
                            url: '/cargaMaxima-getRegistros/' + claveUnicaValor + '/RPE',
                            method: 'GET',
                            data: {
                                "clave": claveUnicaValor,
                                "origenVista": "RPE",
                                "solicitud": estadoSolicitud.value,
                                "hctc": hctc.value
                            },
                            success: function(data) {
                                datos.CargaMaxima = data.json ?? null;
                                console.log(datos.CargaMaxima, data.json);
                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaCargaMaxima').html(data.html);
                                $('#tablaCargaMaxima').show();
                                //tablaMateriaUnica.style.display = 'block';
                                ShowExportButton();

                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    } else if (criterioSeleccionado === 'todos') {
                        $.ajax({
                            url: '{{ route('cargaMaximaRegAll') }}',
                            method: 'GET',
                            data: {
                                "solicitud": estadoSolicitud.value,
                                "hctc": hctc.value
                            },
                            success: function(data) {

                                datos.CargaMaxima = data.json ?? null;

                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaCargaMaxima').html(data.html);
                                $('#tablaCargaMaxima').show();
                                //tablaMateriaUnica.style.display = 'block';
                                ShowExportButton();

                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    }

                } else if (document.getElementById('materiaUnicaCheckbox').checked) {
                    tabs.active = 'materiaUnicaCheckbox';

                    if (criterioSeleccionado === 'clave_unica') {

                        $.ajax({
                            url: '/materiaUnica-getRegistros/' + claveUnicaValor + '/RPE',
                            method: 'GET',
                            data: {
                                "clave_unica": claveUnicaValor,
                                "solicitud": estadoSolicitud.value,
                                "hctc": hctc.value
                            },
                            success: function(data) {
                                datos.MateriaUnica = data.json ?? null;

                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaMateriaUnica').html(data.html);
                                $('#tablaMateriaUnica').show();;
                                //tablaMateriaUnica.style.display = 'block';
                                ShowExportButton();

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
                                "solicitud": estadoSolicitud.value,
                                "hctc": hctc.value
                            },
                            success: function(data) {

                                console.log(data.html, data.json);
                                datos.MateriaUnica = data.json ?? null;

                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaMateriaUnica').html(data.html);
                                $('#tablaMateriaUnica').show();;
                                //tablaMateriaUnica.style.display = 'block';
                                ShowExportButton();
                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    }

                    //console.log("materia unica");
                } else if (document.getElementById('opcionTitulacionCheckbox').checked) {
                    tabs.active = 'opcionTitulacionCheckbox';

                    if (criterioSeleccionado === 'clave_unica') {
                        $.ajax({
                            url: '/opTitulacion-getRegistros/' + claveUnicaValor + '/RPE',
                            method: 'GET',
                            data: {
                                "clave_unica": claveUnicaValor,
                                "solicitud": estadoSolicitud.value,
                                "hctc": hctc.value
                            },
                            success: function(data) {
                                datos.OpcionTitulacion = data.json ?? null;

                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaOpcionTitulacion').html(data.html);
                                $('#tablaOpcionTitulacion').show();
                                //tablaMateriaUnica.style.display = 'block';
                                ShowExportButton();

                            },
                            error: function(error) {
                                // Manejar cualquier error si es necesario
                            }
                        });
                    } else if (criterioSeleccionado === 'todos') {
                        $.ajax({
                            url: '{{ route('opcionTitulacionAllReg') }}',
                            method: 'GET',
                            data: {
                                "solicitud": estadoSolicitud.value,
                                "hctc": hctc.value
                            },
                            success: function(data) {
                                datos.OpcionTitulacion = data.json ?? null;

                                // Actualizar el contenido del contenedor div con el HTML recibido
                                $('#tablaOpcionTitulacion').html(data.html);
                                $('#tablaOpcionTitulacion').show();;
                                ShowExportButton();
                                //tablaMateriaUnica.style.display = 'block';
                            },
                            error: function(error) {

                            }
                        });
                    }
                }
                console.log('datos: ' +
                    'titulacion: '+ datos.OpcionTitulacion +
                    'unica: ' +  datos.MateriaUnica +
                    'cargamaxima: ' + datos.CargaMaxima);
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

        <div class="row mt-4 justify-content-center align-items-end">
            <div id="filtros" style="display: flex;">
                <div class="col-md-6">
                    <!-- style="width: 100%" -->
                    <h6> Estado Solictud </h6>
                    <select class="form-select btn btn-primary"  name="estadoSolicitud" id="estadoSolicitud">
                        <option value="" disabled selected hidden>Seleccione...</option>
                        <option >ALTA</option>
                        <option >ENTREGADO</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <h6> Sesion HCTC </h6>
                    <select class="form-select btn btn-primary" name="hctc" id="hctc">
                        <option value="" disabled selected hidden>Seleccione...</option>
                        <option >11/03/2023</option>
                        <option >10/12/2023</option>
                        <option >01/03/2021</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <a href="#" class="btn btn-success" id="exportar">
                    Exportar a Excel
                </a>
            </div>
        </div>

        <!-- Nuevos radio buttons -->
        <div class="row mt-4 justify-content-center" id="checkboxContainer">
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
