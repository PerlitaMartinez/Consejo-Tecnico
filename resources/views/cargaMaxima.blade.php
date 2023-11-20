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
            @if (!isset($admin)) action={{ route('cargaMaxima.store', ['dataSet' => $dataSet]) }}>@else action={{ route('cargaMaximaAdmin.store') }}> @endif
            @csrf <h1>Carga Máxima</h1>
            @if (!isset($admin))
                <p>El sistema seleccionará el motivo inicial de la carga máxima</p>
            @endif

            @if (!isset($admin))
                <div class="row">
                    <div class="col-md-8">
                        @if ($matRep == 'SI')
                            <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox1" disabled checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox1" disabled>
                        @endif
                        <label>Reprobé más de 20 materias</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        @if ($duracion == 'SI')
                            <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox2" disabled checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox2" disabled>
                        @endif
                        <label>Inscribí una vez y media la duración de la carrera</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2">Semestre</label>
                            <input class="form-control" type="text" id="semestre" name="semestre"
                                value="{{ $semestre }}" disabled>
                        </div>
                    </div>
                </div>

                <br>

                <div class="form-group">
                    @if ($exists)
                        <a class="btn btn-success text-white" id="descargar-formato" data-bs-toggle="modal"
                            data-bs-target="#downloadPDF">Descargar Formato</a>
                    @else
                        <button class="btn btn-primary mr-2" id="registrar-solicitud" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Registrar Solicitud</button>
                    @endif
                </div>
            @else
                <div class="row">
                    <div class="col-md-8">
                        <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox1" checked>
                        <label>Reprobé más de 20 materias</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox2" checked>
                        <label>Inscribí una vez y media la duración de la carrera</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="margin-left:0px;">clave Única</label>
                            <input class="form-control" name = "clave_unica" type="text" id="semestre" name="semestre">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2">Semestre</label>
                            <input class="form-control" name = "semestre" type="text" id="semestre" name="semestre">
                        </div>
                    </div>
                </div>


                <button class="btn btn-primary mr-2" id="registrar-solicitud" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Registrar Solicitud</button>
            @endif
        </form>




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
                var url = "{{ route('cargaMaximaPDF.show') }}?dataSet=" + JSON.stringify(dataSet) + "&id=" + id;
            @endif

            @if (!isset($id))
                // Agrega un cuadro de diálogo de confirmación al botón "Registrar Solicitud"
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
                        });
                    });
                });
            @endif
        @else
        @endif
    </script>
@endsection
