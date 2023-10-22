@extends('layouts.header')

@section('content')

{{-- @include('usuario_cinta') --}}

<div class="container">
        <h1>Registro para Aspirantes al Programa de Titulacion</h1>

        <h3>Memorias de Actividad Profesional</h3>

        <br>

        <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" >Generación</label>
                            <input type="text" id="fecha_examen_aprobado" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Direccion Particular </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Teléfono Particular </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Empresa donde labora </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Dirección </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Teléfono </label>
                            <input type="text" id="promedio" class="form-control">
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Ext. </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Ciudad </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
                    <form id="formulario" method="GET" action="{{ route('materiaUnicaPdf.show') }}" target="_blank">
                    <button class="btn btn-success" id="descargar-formato">Descargar Formato</button>
                    </form>
                </div>
</div>

<style>

    .container {
        margin-top: 35px;
        max-width: 70%;
    }

    .form-group {
        display: flex;
        align-items: flex-end;
    }

    .form-group label {
        white-space: nowrap;
        width: 280px;
        text-align: right;
    }

</style>

@endsection