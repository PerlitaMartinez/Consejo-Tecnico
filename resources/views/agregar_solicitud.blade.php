@extends('layouts.header')
@section('content')
    @include('rpe_cinta', ['admin' => true])

    <div class="container d-flex justify-content-center align-items-center" style="height: 20vh;">
        <div class="text-center">
            <h2>Escoja el trámite</h2>
            <div><a class="btn btn-primary mb-2" href={{ route('cargaMaximaAdmin.show') }}>Carga Máxima</a></div>
            <div><a class="btn btn-primary mb-2" href={{ route('materiaUnicaAdmin.show') }}>Materia Única</a></div>
            <div><a class="btn btn-primary" href={{ route('titulacionAdmin.show') }}>Opción Titulación</a></div>
        </div>
    </div>
@endsection
