@extends('layouts.header')

@section('content')

{{-- @include('usuario_cinta') --}}

<div class="container">
        <h1>Terminacion de Trabajo Recepcional, Tesis o Memorias de Actividad Profesional</h1>

        <br>

        <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" >Ha concluido </label>
                            <input type="text" id="fecha_examen_aprobado" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Denominado </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>

                <br>

                <div class="form-group">
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
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
        width: 100px;
        text-align: right;
    }

</style>

@endsection
