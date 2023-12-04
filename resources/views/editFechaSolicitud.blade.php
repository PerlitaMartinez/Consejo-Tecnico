@extends('layouts.header')

@section('content')

@include('rpe_datos')

@include('rpe_cinta')

<a href="{{ route('consultar_solicitudes')}}"> Regresar </a>

<div class="form-group">
  <h1> Editar Fecha de la  Solicitud </h1>
 <form action="{{ route('solicitud.update', $data)}}" method="POST">
  @method('PATCH')
  @csrf
    <label for="selectExample">Selecciona la fecha de Solicitud:</label>

    <input required type="date" value="{{ $data->fecha_solicitud}}" name="fecha_solicitud" min="2000-00-01" max="2028-04-30" />
   </div>

       
       <button class="btn btn-primary btn-block" type="submit" > Actualizar Solicitud </button>
    </div>
  </form>
</div>

@endsection