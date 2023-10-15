@extends('layouts.header')

@section('content')

    @include('usuario_cinta')

    <div class="container">
        <form id="formulario" method="GET" action="{{ route('materiaUnicaPdf.show') }}" target="_blank">
                <h1>Materia Única</h1>
                <p>Selecciona la materia para registrarla como materia única</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <label for="materia" class="mr-2">Materia Única</label>
                            <select id="materia" class="form-control">
                                <!-- Opciones para el combo box de Materia Única -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="margin-left:35px;">Semestre</label>
                            <select id="semestre" class="form-control">
                                <!-- Opciones para el combo box de Semestre -->
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
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

<script>
    // Agrega un cuadro de diálogo de confirmación al botón "Registrar Solicitud"
    document.getElementById('registrar-solicitud').addEventListener('click', function() {
        if (confirm('¿Estás seguro(a) de que deseas registrar la solicitud?')) {
            // código para registrar la solicitud si se hace clic en "Aceptar"
        }
    });

    // Agrega un cuadro de diálogo de confirmación al botón "Descargar Formato"
    document.getElementById('descargar-formato').addEventListener('click', function() {
        if (confirm('¿Estás seguro(a) de que deseas descargar el formato?')) {
            // código para descargar el formato si se hace clic en "Aceptar"
            document.getElementById('formulario').submit();
        }
    });
</script>

@endsection
