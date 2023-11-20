@extends('layouts.header')



@section('content')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    @include('usuario_cinta', ['dataSet' => $dataSet])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {!! nl2br(session('success')) !!}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (@isset($mu_info) || @isset($cm_info) || @isset($ot_info))
            <h2>Seguimiento de Solicitudes</h2>
            @if (@isset($mu_info))

                @if ($mu_info != null && count($mu_info) > 0)
                    <div>
                        <p>Materia Única</p>

                        <table class="table">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>Folio</th>
                                    <th>Materia</th>
                                    <th>Semestre</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Formato</th>
                                    <th>Cancelar Solicitud</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mu_info as $item)
                                    <tr class="text-center">
                                        <td>{{ $item['id_solicitud_mu'] }}</td>
                                        <td>{{ $item['materia'] }}</td>
                                        <td>{{ $item['semestre'] }}</td>
                                        <td>{{ $item['fecha_solicitud'] }}</td>
                                        <td>{{ $item['estado_solicitud'] }}</td>

                                        <td>
                                            <a id="{{ $item['id_solicitud_mu'] }}" type="button"
                                                class="btn btn-primary btn-sm px-3 download-mu">
                                                <i class="fas fa-file-arrow-down" style="color: white;"></i> </i>
                                            </a>
                                        </td>
                                        @if ($item['estado_solicitud'] == 'ALTA' || $item['estado_solicitud'] == 'AUTORIZADA')
                                            <td>
                                                <a id="mu_{{ $item['id_solicitud_mu'] }}" type="button"
                                                    class="btn btn-danger btn-sm px-3 cancel-mu" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    onclick="setSelectedId('mu_{{ $item['id_solicitud_mu'] }}')">
                                                    <i class="fas fa-times" style="color: white;"></i>
                                                </a>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                @endif
            @endif

            @if (@isset($cm_info))
                <div>
                    <p>Carga Máxima</p>

                    <table class="table">
                        <thead class="thead-light">
                            <tr td class="text-center">
                                <th>Folio</th>
                                <th>Tipo </th>
                                <th>Semestre</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Formato</th>
                                <th>Cancelar Solicitud</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cm_info as $item)
                                <tr class="text-center">
                                    <td>{{ $item['id_solicitud_cm'] }}</td>
                                    <td class="text-wrap" style="max-width: 200px;">
                                        @if ($item['materias_reprobadas'])
                                            {{ '20 Materias Reprobadas' }}<br>
                                        @endif

                                        @if ($item['duracion_y_media'])
                                            {{ 'Duración y Media' }}
                                        @endif


                                    </td>
                                    <td>{{ $item['semestre'] }}</td>
                                    <td>{{ $item['fecha_solicitud'] }}</td>
                                    <td>{{ $item['estado_solicitud'] }}</td>

                                    <td class="text-center">
                                        <a id="{{ $item['id_solicitud_cm'] }}" type="button"
                                            class="btn btn-primary btn-sm px-3 download-cm">
                                            <i class="fas fa-file-arrow-down" style="color: white;"></i> </i>
                                        </a>
                                    </td>
                                    @if ($item['estado_solicitud'] == 'ALTA' || $item['estado_solicitud'] == 'AUTORIZADA')
                                        <td class="text-center">
                                            <a id="{{ $item['id_solicitud_cm'] }}" type="button"
                                                class="btn btn-danger btn-sm px-3 cancel-cm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                onclick="setSelectedId('cm_{{ $item['id_solicitud_cm'] }}')">
                                                <i class="fas fa-times" style="color: white;"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif



            @if (isset($ot_info))
                <div>
                    <p>Opción Titulación</p>

                    <table class="table">
                        <thead class="thead-light">
                            <tr td class="text-center">
                                <th>Folio</th>
                                <th>Tipo </th>
                                <th>Semestre</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Formato</th>
                                <th>Cancelar Solicitud</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ot_info as $item)
                                <tr class="text-center">
                                    <td>{{ $item['id_solicitud_OT'] }}</td>
                                    <td class="text-wrap" style="max-width: 150px;">
                                        {{ $item['opcion_titulacion'] }}
                                    </td>
                                    <td>{{ $item['semestre'] }}</td>
                                    <td>{{ $item['fecha_solicitud'] }}</td>
                                    <td>{{ $item['estado_solicitud'] }}</td>

                                    <td class="text-center">
                                        @if (
                                            $item['opcion_titulacion'] == 'Trabajo Recepcional' ||
                                                $item['opcion_titulacion'] == 'Tesis' ||
                                                $item['opcion_titulacion'] == 'Memorias de Actividad Profesional')
                                            <a id="{{ $item['id_solicitud_OT'] }}" type="button"
                                                class="btn btn-primary btn-sm px-3 download-fot">
                                                <i class="fas fa-file-arrow-down" style="color: white;"></i> </i>
                                            </a>

                                            <a id="{{ $item['id_solicitud_OT'] }}" type="button"
                                                class="btn btn-primary btn-sm px-3 download-ot">
                                                <i class="fas fas fa-file-arrow-down" style="color: white;"></i> </i>
                                            </a>

                                            <a id="{{ $item['id_solicitud_OT'] }}" type="button"
                                                class="btn btn-primary btn-sm px-3 download-ot">
                                                <i class="fas fa-file-arrow-down" style="color: white;"></i> </i>
                                            </a>
                                        @else
                                            <a id="{{ $item['id_solicitud_OT'] }}" type="button"
                                                class="btn btn-primary btn-sm px-3 download-fot">
                                                <i class="fas fa-download" style="color: white;"></i> </i>
                                            </a>
                                        @endif

                                    </td>
                                    @if ($item['estado_solicitud'] == 'ALTA' || $item['estado_solicitud'] == 'AUTORIZADA')
                                        <td class="text-center">
                                            <a id="{{ $item['id_solicitud_OT'] }}" type="button"
                                                class="btn btn-danger btn-sm px-3 cancel-cm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal"
                                                onclick="setSelectedId('OT_{{ $item['id_solicitud_OT'] }}')">
                                                <i class="fas fa-times" style="color: white;"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cancelar Solicitud</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro que desea cancelar esta solicitud?
                            <input type="hidden" id="selectedId" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id= "saveChangesButton" type="button" class="btn btn-primary">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h2>Sin solicitudes registradas</h2>
        @endif
    </div>




    <style>
        .container {
            margin-top: 35px;
            max-width: 80%;
        }
    </style>


    <script>
        var download_buttons_mu = document.querySelectorAll('.download-mu');
        var download_buttons_cm = document.querySelectorAll('.download-cm');
        var download_buttons_fot = document.querySelectorAll('.download-fot');
        var download_buttons_fotM = document.querySelectorAll('.download-fotM');
        var download_buttons_fotS = document.querySelectorAll('.download-fotS');
        var dataSet = @json($dataSet);
        var token = $("meta[name='csrf-token']").attr("content");
        //----------------------PDF'S--------------------------
        download_buttons_mu.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('id');

                var url = "{{ route('materiaUnicaPDF.show') }}?id=" + id + "&dataSet=" + JSON.stringify(
                    dataSet);
                window.open(url, "_blank"); // Abre en una nueva pestaña
            });
        });


        download_buttons_cm.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('id');

                var url = "{{ route('cargaMaximaPDF.show') }}?id=" + id + "&dataSet=" + JSON.stringify(
                    dataSet);
                window.open(url, "_blank"); // Abre en una nueva pestaña
            });
        });

        download_buttons_fot.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('id');

                var url = "{{ route('opTitulacionPDF.show') }}?id=" + id + "&dataSet=" + JSON.stringify(
                    dataSet);
                window.open(url, "_blank"); // Abre en una nueva pestaña
            });
        });
        download_buttons_fotM.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('id');

                var url = "{{ route('memoriasPDF.show') }}?id=" + id + "&dataSet=" + JSON.stringify(
                    dataSet);
                window.open(url, "_blank"); // Abre en una nueva pestaña
            });
        });
        download_buttons_fotS.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('id');

                var url = "{{ route('memoriasPDF2.show') }}?id=" + id + "&dataSet=" + JSON.stringify(
                    dataSet);
                window.open(url, "_blank"); // Abre en una nueva pestaña
            });
        });


        //----------------------PDF'S--------------------------

        //----------------------Cancelar solicitudes-----------

        function setSelectedId(id) {

            document.getElementById('selectedId').value = id;

            //console.log(id);

        }

        $(document).ready(function() {
            // Asignar un manejador de clic al botón "saveChangesButton"
            $('#saveChangesButton').click(function() {
                var selectedId = $('#selectedId').val();

                if (selectedId) {

                    // Verificar si el botón que se hizo clic tiene la clase "cancel-mu"
                    if (selectedId.startsWith("mu_")) {
                        var idSinPrefijo = selectedId.replace('mu_', '');
                        deleteSolicitudMU(idSinPrefijo); // Llama a la función adecuada según el prefijo
                    }
                    if (selectedId.startsWith("cm_")) {

                        var idSinPrefijo = selectedId.replace('cm_', '');
                        deleteSolicitudCM(idSinPrefijo); // Llama a la función adecuada según el prefijo
                    }
                    if (selectedId.startsWith("OT_")) {
                        console.log(selectedId);
                        var idSinPrefijo = selectedId.replace('OT_', '');
                        deleteSolicitudOT(idSinPrefijo); // Llama a la función adecuada según el prefijo
                    }
                }
            });
        });

        function deleteSolicitudMU(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Realizar una solicitud AJAX para eliminar la solicitud
            $.ajax({
                url: "{{ route('materiaUnica.delete') }}",
                type: 'POST',
                data: {
                    "dataSet": JSON.stringify(dataSet),
                    "id": id,

                },
                success: function(data) {
                    window.location.href = "{{ route('seguimiento.show') }}?success=1&message=" + data
                        .message + "&dataSet=" + JSON.stringify(dataSet);
                },
                error: function(error) {
                    // Maneja cualquier error si es necesario
                }
            });
        };




        function deleteSolicitudCM(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Realizar una solicitud AJAX para eliminar la solicitud
            $.ajax({
                url: "{{ route('cargaMaxima.delete') }}",
                type: 'POST',
                data: {
                    "dataSet": JSON.stringify(dataSet),
                    "id": id,

                },
                success: function(data) {
                    window.location.href = "{{ route('seguimiento.show') }}?success=1&message=" + data
                        .message + "&dataSet=" + JSON.stringify(dataSet);
                },
                error: function(error) {
                    // Maneja cualquier error si es necesario
                }
            });
        };



        function deleteSolicitudOT(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Realizar una solicitud AJAX para eliminar la solicitud
            $.ajax({
                url: "{{ route('opcionTitulacion.delete') }}",
                type: 'POST',
                data: {
                    "dataSet": JSON.stringify(dataSet),
                    "id": id,

                },
                success: function(data) {
                    window.location.href = "{{ route('seguimiento.show') }}?success=1&message=" + data
                        .message + "&dataSet=" + JSON.stringify(dataSet);
                },
                error: function(error) {
                    // Maneja cualquier error si es necesario
                }
            });
        };




        //----------------------Cancelar solicitudes-----------
    </script>
@endsection
