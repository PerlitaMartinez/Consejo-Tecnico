@extends('layouts.header')

@section('content')

@include('rpe_datos')

@include('rpe_cinta')


<a href="{{ route('admin_sesiones_hctc')}}"> Regresar </a>

<div class="form-group">
  <h1> Editar Sesiones </h1>
 <form action="{{ route('sesion.update', $sesion)}}" method="POST">
  @method('PATCH')
  @csrf
    <label for="selectExample">Selecciona la fecha de Sesion:</label>

    <input required type="date" value="{{ $sesion->fecha_sesion}}" name="fecha_sesion" min="2000-00-01" max="2028-04-30" />
   </div>

       <div class="checkbox">
         <label><input required type="radio" name = "tipo_sesion" value="Normal"> Normal </label>
       </div>
       <div class="checkbox">
         <label><input required type="radio" name="tipo_sesion"  value="Extraordinaria">Extraordinaria</label>
       </div>

       <button class="btn btn-primary btn-block" type="submit" > Actualizar Sesion </button>
    </div>
  </form>
</div>

@endsection