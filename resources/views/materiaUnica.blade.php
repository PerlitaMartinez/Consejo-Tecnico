@extends('layouts.header')

@section('content')
    @if (isset($dataSet))
        @include('usuario_cinta', ['dataSet' => $dataSet])
        <div id="data-set-container" data-data-set="{{ json_encode($dataSet) }}"></div>
    @else
        @include('rpe_cinta', ['admin' => true])
    @endif

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
        <form id="formulario" method="POST"
            @if (isset($admin)) action="{{ route('materiaUnicaAdmin.store') }}">
            @else
            action={{ route('materiaUnica.store', ['dataSet' => $dataSet, 'registered' => true]) }}> @endif
            @csrf <h1>Materia Única</h1>
            <p>Selecciona la materia para registrarla como materia única</p>

            @if (isset($admin))
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <label for="claveUnica" class="mr-2" style="margin-left:15px;">Clave Única</label>
                            <input id="clave_unica" name="clave_unica" class="form-control" type="text"
                                placeholder="Default input">
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex">
                        <label for="materia" class="mr-2">Materia Única</label>
                        @if (isset($materias))
                            @if ($materias == 'all')
                                <select id="materia" name="materia" class="form-control" disabled>
                                    <option value=""> </option>
                                </select>
                            @else
                                <select id="materia" name="materia" class="form-control">
                                    @foreach ($materias as $fila)
                                        <option value="{{ $fila['nombre_materia'] }}">{{ $fila['nombre_materia'] }}</option>
                                    @endforeach
                                </select>
                            @endif
                        @else
                            <input id="materia" name="materia" class="form-control" type="text"
                                placeholder="Default input">
                        @endif

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex">
                        <label for="semestre" class="mr-2" style="margin-left:35px;">Semestre</label>
                        @if (isset($materias))
                            @if ($materias == 'all')
                                <select id="semestre" name="semestre" class="form-control" disabled>
                                    <option value="" disabled> </option>
                                </select>
                            @else
                                <select id="semestre" name="semestre" class="form-control">
                                    <option value="{{ $materias[0]['semestre'] }}">{{ $materias[0]['semestre'] }}
                                    </option>
                                </select>
                            @endif
                        @else
                            <input id="semestre" name="semestre" class="form-control" type="text"
                                placeholder="Default input">
                        @endif

                    </div>
                </div>
            </div>
            <br>
            <div class="form-group">
                @if (isset($registered))
                    @if (!$registered)
                        @if ($materias != 'all')
                            <button class="btn btn-primary mr-2" id="registrar-solicitud" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Registrar Solicitud</button>
                        @endif
                    @else
                        <button class="btn btn-success" id="descargar-formato" data-bs-toggle="modal"
                        data-bs-target="#downloadPDF">Descargar Formato</button>
                    @endif
                @else
                    <button class="btn btn-primary mr-2" id="registrar-solicitud" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Registrar Solicitud</button>
                @endif

            </div>
        </form>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


        <div class="modal fade" id="downloadPDF" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitud Materia Única
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro(a) que deseas descargar el formato?
                        <input type="hidden" id="selectedId" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id= "saveChangesButtonPDF" type="button" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container {
            margin-top: 35px;
            max-width: 60%;

        }

        .form-group {
            display: flex;
            align-items: flex-end;
        }

        .form-group label {
            white-space: nowrap;
        }
    </style>

    <script type="text/javascript">
        @if (!isset($admin))
            var dataSet = @json($dataSet);
            @if (isset($id))
                var id = @json($id);
                var url = "{{ route('materiaUnicaPDF.show') }}?dataSet=" + JSON.stringify(dataSet) + "&id=" + id;
            @endif


            // Agrega un cuadro de diálogo de confirmación al botón "Registrar Solicitud"
            @if (!isset($id))
                document.getElementById('registrar-solicitud').addEventListener('click', function(event) {
                    event.preventDefault();
                    $(document).ready(function() {
                       
                        // Asignar un manejador de clic al botón "saveChangesButton       
                        $('#saveChangesButton').click(function() {
                            document.getElementById('formulario').submit()
                        });
                    });
                });
            @endif
            @if (isset($id))
                // Agrega un cuadro de diálogo de confirmación al botón "Descargar Formato"

                document.getElementById('descargar-formato').addEventListener('click', function(event) {
                    event.preventDefault();
                    $(document).ready(function() {
                       
                        // Asignar un manejador de clic al botón "saveChangesButton       
                        $('#saveChangesButtonPDF').click(function() {
                            window.open(url, "_blank");
                        setTimeout(function() {
                            window.location.href = "{{ route('materiaUnica.show') }}?dataSet=" + JSON
                                .stringify(dataSet) + "&registered=" + Boolean(false);
                        }, 1000);
                        });
                    });
                });
            @endif


            $(document).ready(function() {
                $('#materia ').on('change', function() {
                    var materias = @json($materias);

                    var materiaSeleccionada = $('#materia option:selected').text()

                    $('#semestre').empty();

                    for (var i = 0; i < materias.length; i++) {
                        if (materias[i]['nombre_materia'] == materiaSeleccionada) {


                            $('#semestre').append(
                                '<option value="' + materias[i]["semestre"] + '">' + materias[i][
                                    "semestre"
                                ] + '</option>'
                            );

                        }
                    }
                });
            });
        @else
        
        @endif
    </script>
@endsection
