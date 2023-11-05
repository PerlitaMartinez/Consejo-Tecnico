@extends('layouts.header')

@section('content')
    @include('usuario_cinta', ['dataSet' => $dataSet])

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
        <form id="formulario" method="POST" action="{{ route('opcionTitulacion.store', ['dataSet' => $dataSet]) }}">
            @csrf
            <h1>Opciones de Titulación</h1>
            <p>Seleccionar la opción de titulación, de acuerdo a la opción seleccionada, el sistema solicitará la captura de
                los datos necesarios para realizar el trámite</p>
            @if (!$exists)
                @foreach ($opciones as $item)
                    <div class="row">
                        <div class="col-md-8">
                            @if ($loop->first)
                                <input class="form-check-input" type="radio" name="opcion_titulacion"
                                    id="opcion_{{ $item->id_opcion_titulacion }}" value="{{ $item->id_opcion_titulacion }}"
                                    checked>
                            @else
                                <input class="form-check-input" type="radio" name="opcion_titulacion"
                                    id="opcion_{{ $item->id_opcion_titulacion }}" value="{{ $item->id_opcion_titulacion }}"
                                    >
                            @endif
                            <label>{{ $item->opcion_titulacion }}</label>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($opciones as $item)
                    <div class="row">
                        <div class="col-md-8">
                            <input class="form-check-input" type="radio" name="opcion_titulacion"
                                id="opcion_{{ $item->id_opcion_titulacion }}" value="{{ $item->id_opcion_titulacion }}"
                                disabled>
                            <label>{{ $item->opcion_titulacion }}</label>
                        </div>
                    </div>
                @endforeach
            @endif
            <br>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group d-flex">
                        <label for="semestre" class="mr-2">Fecha del examen en que aprobó su ultima materia </label>
                        <input type="text" id="fecha_examen_aprobado" class="form-control"
                            value="{{ $dataAlumno[0]['ultima_materia'] }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group d-flex">
                        <label for="semestre" class="mr-2" style="margin-left:175px;">Promedio general aprobatorio
                        </label>
                        <input type="text" id="promedio" class="form-control"
                            value="{{ $dataAlumno[0]['promedio_ap'] }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group d-flex">
                        <label for="ano_ingreso" class="mr-2" style="margin-left:165px;">Año de ingreso a la
                            licenciatura</label>
                        <input type="text" id="ano_ingreso" class="form-control" value="{{ $dataAlumno[0]['ingreso'] }}"
                            readonly>
                    </div>
                </div>
            </div>
            <br>

            <div class="form-group">
                @if ($exists)
                    <a class="btn btn-success" id="descargar-formato">Descargar Formato</a>
                @else
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
                @endif
            </div>
        </form>
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
        var dataSet = @json($dataSet);
        @if (isset($id))
            var id = @json($id);
            var url = "{{ route('opTitulacionPDF.show') }}?dataSet=" + JSON.stringify(dataSet) + "&id=" + id;;
        @endif

        @if (!isset($id))
            // Agrega un cuadro de diálogo de confirmación al botón "Registrar Solicitud"
            document.getElementById('registrar-solicitud').addEventListener('click', function(event) {
                event.preventDefault();
                if (confirm('¿Estás seguro(a) que deseas registrar la solicitud?')) {
                    // código para registrar la solicitud si se hace clic en "Aceptar"
                    document.getElementById('formulario').submit()
                }
            });
        @endif


        @if (isset($id))
            // Agrega un cuadro de diálogo de confirmación al botón "Descargar Formato"
            document.getElementById('descargar-formato').addEventListener('click', function(event) {
                event.preventDefault();
                if (confirm('¿Estás seguro(a) de que deseas descargar el formato?')) {
                    window.open(url, "_blank");
                }
            });
        @endif
    </script>
@endsection
