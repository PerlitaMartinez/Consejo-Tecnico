@extends('layouts.header')

@section('description')
<div class="text">
<div class="container-text">
    <p class="bold-text" >SISTEMA</p>
    <p class="bold-text">HCTC - {{$rol}}</p>
</div>     

@endsection

@section('content')
<div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {!! nl2br(session('success')) !!}
            </div>
        @endif
    <div class="wrapper">
      <div class="title"><span>{{$rol}}</span></div>
      <form method="POST"  action={{route('login.sumbit', ['clave'=> $clave, 'rol' =>$rol]) }}>
        @csrf
        <div class="row">
        <p>{{$clave}}:</p>
          {{-- <i class="fas fa-user"></i> --}}
          <input type="text"name="clave_unica" required>
        </div>
        <div class="row">
          {{-- <i class="fas fa-lock"></i> --}}
          <p>Contraseña:</p>
          <input type="password" name="contrasena" required>
        </div>
        <div class="row button">
          <input type="submit" value="Iniciar Sesión">
        </div>
      </form>
    </div>
  </div>
@endsection