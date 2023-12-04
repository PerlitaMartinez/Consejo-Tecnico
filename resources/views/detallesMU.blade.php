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
                <span id="clave_unica" name="clave_unica" class="form-control">{{$data->id_solicitud_mu}}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group d-flex">
                <label for="claveUnica" class="mr-2 custom-label" style="margin-left:15px;">Fecha Solicitud:</label>
                <span id="clave_unica" name="clave_unica" class="form-control">{{$data->fecha_solicitud}}  </span>


                                       <!-- Editar Fecha 

                <td type="button" class="text-center">    
                    <form action="{{ route('consulta_solicitudes_edit', $data)}}">
                     <button type="submit" style="border:none" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="green" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                    </button>
                 </form>
             </td>   -->


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