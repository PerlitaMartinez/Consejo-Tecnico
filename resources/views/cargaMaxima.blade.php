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
        <form id="formulario" method="POST" action={{route('cargaMaxima.store',['dataSet' => $dataSet]) }}>
            @csrf
            <h1>Carga Máxima</h1>
            <p>El sistema seleccionará el motivo inicial de la carga máxima</p>

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
                    <button class="btn btn-primary mr-2" id="registrar-solicitud" disabled>Registrar Solicitud</button>
                    <a class="btn btn-success" id="descargar-formato">Descargar Formato</a>
                @else
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
                    <button class="btn btn-success" id="descargar-formato" disabled>Descargar
                        Formato</button>
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
        var url = "{{ route('cargaMaximaPDF.show') }}?dataSet=" + JSON.stringify(dataSet);

        // Agrega un cuadro de diálogo de confirmación al botón "Registrar Solicitud"
        document.getElementById('registrar-solicitud').addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('¿Estás seguro(a) que deseas registrar la solicitud?')) {
                // código para registrar la solicitud si se hace clic en "Aceptar"
                document.getElementById('formulario').submit()
            }
        });


        // Agrega un cuadro de diálogo de confirmación al botón "Descargar Formato"
        document.getElementById('descargar-formato').addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('¿Estás seguro(a) de que deseas descargar el formato?')) {
                window.open(url, "_blank");
            }
        });
    </script>
@endsection
