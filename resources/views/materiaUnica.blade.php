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
        <form id="formulario" method="POST" action={{ route('materiaUnica.store', ['dataSet' => $dataSet]) }}>
            @csrf
            <h1>Materia Única</h1>
            <p>Selecciona la materia para registrarla como materia única</p>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex">
                        <label for="materia" class="mr-2">Materia Única</label>
                        <select id="materia" name="materia" class="form-control">
                            @foreach ($materias as $fila)
                                <option value="{{ $fila['nombre_materia'] }}">{{ $fila['nombre_materia'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex">
                        <label for="semestre" class="mr-2" style="margin-left:35px;">Semestre</label>
                        <select id="semestre" name="semestre" class="form-control">
                            <option value="{{ $materias[0]['semestre'] }}">{{ $materias[0]['semestre'] }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <br>

            <div class="form-group">
                @if ($registrado)
                    <button class="btn btn-primary mr-2" id="registrar-solicitud" disabled>Registrar Solicitud</button>
                @else
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
                @endif
                <button class="btn btn-success" id="descargar-formato">Descargar Formato</button>
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
        // Agrega un cuadro de diálogo de confirmación al botón "Registrar Solicitud"
        document.getElementById('registrar-solicitud').addEventListener('click', function() {
            event.preventDefault();
            if (confirm('¿Estás seguro(a) que deseas registrar la solicitud?')) {
                // código para registrar la solicitud si se hace clic en "Aceptar"
                document.getElementById('formulario').submit()
            }
        });

        // Agrega un cuadro de diálogo de confirmación al botón "Descargar Formato"
        document.getElementById('descargar-formato').addEventListener('click', function() {
            if (confirm('¿Estás seguro(a) de que deseas descargar el formato?')) {
                // código para descargar el formato si se hace clic en "Aceptar"
                ;
            }
        });



        $(document).ready(function() {
            $('#materia ').on('change', function() {
                var materias = @json($materias);
                var materiaSeleccionada = $('#materia option:selected').text()
                $('#semestre').empty();
                //console.log(materias);
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
    </script>
@endsection
