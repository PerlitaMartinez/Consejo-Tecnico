@extends('layouts.header')

@section('content')

    @include('usuario_cinta', ['dataSet' => $dataSet])

    <div class="container">
        <form id="formulario" method="GET" action="{{ route('materiaUnicaPdf.show') }}" target="_blank">
            <h1>Carga Máxima</h1>
            <p>El sistema seleccionará el motivo inicial de la carga máxima</p>

            <div class="row">
                <div class="col-md-8">
                    <input class="form-check-input" type="radio" name="checkbox" id="checkbox1" checked>
                    <label>Reprobé más de 20 materias</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                    <label>Inscribí una vez y media la duración de la carrera</label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex">
                        <label for="semestre" class="mr-2">Semestre</label>
                        <select id="semestre" class="form-control">
                            <!-- Opciones para el combo box de Semestre -->
                        </select>
                    </div>
                </div>
            </div>

            <br>

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
@endsection



