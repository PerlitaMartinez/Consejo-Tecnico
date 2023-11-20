@extends('layouts.header')

@section('content')

@include('rpe_datos')

@include('rpe_cinta')

<!-- Tabla materia unica -->



<div class="custom-container mt-4">
    <h1>Consultar Solicitud Materia Única</h1>
    
    <!-- tabla de datos del alumno -->
    <hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

    <div style="display: flex; justify-content: center;">
        <div style="background-color: #B0E0E6; text-align: right; padding: 5px; width: 150px; min-height: 70px;">
            <ul style="list-style: none; color: #004a98;">
                <li>Clave única</li>
                <li>Nombre</li>
                <li>Carrera</li>
                <li>Tutor Académico</li>
                <li>Coordinador</li>
            </ul>
        </div>
        <div id="rol-actual" style="background-color: #dfecde; padding: 5px; width: 480px; min-height: 70px;">
            <ul style="list-style: none; color: #0d2607;">
                <li>{{$data->clave_unica}}</li>
                <li>PATERNO MATERNO NOMBRES</li>
                <li>NOMBRE CARRERA</li>
                <li>PATERNO MATERNO NOMBRES</li>
                <li>PATERNO MATERNO NOMBRES</li>
            </ul>
        </div>
    </div><br>

<!-- detalles de la solicitud -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group d-flex">
                <label for="claveUnica" class="mr-2 custom-label" style="margin-left:15px;">Folio:</label>
                <span id="clave_unica" name="clave_unica" class="form-control">{{$data->id_solicitud_OT}}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group d-flex">
                <label for="claveUnica" class="mr-2 custom-label" style="margin-left:15px;">Fecha Solicitud:</label>
                <span id="clave_unica" name="clave_unica" class="form-control">{{$data->fecha_solicitud}}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group d-flex">
                <label for="claveUnica" class="mr-2 custom-label" style="margin-left:15px;">Semestre:</label>
                <span id="clave_unica" name="clave_unica" class="form-control">{{$data->semestre}}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group d-flex">
                <label for="claveUnica" class="mr-2 custom-label" style="margin-left:15px;">Estado:</label>
                <span id="clave_unica" name="clave_unica" class="form-control">{{$data->estado_solicitud}}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group d-flex">
                <label for="claveUnica" class="mr-2 custom-label" style="margin-left:15px;">ID opción de titulación:</label>
                <span id="clave_unica" name="clave_unica" class="form-control">{{$data->id_opcion_titulacion}}</span>
            </div>
        </div>
    </div>

</div>
<style>
        .custom-container {
            max-width: 70%; /* Ajusta el valor según tus necesidades */
            margin-right: auto;
            margin-left: auto;
        }
        .form-group {
            display: flex;
            align-items: flex-end;
        }

        .form-group label {
            white-space: nowrap;
        }

        .custom-label {
            margin-left: 15px;
            width: 200px;
        }
    </style>


@endsection