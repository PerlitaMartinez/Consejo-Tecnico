@extends('layouts.header')

@section('content')
    @include('usuario_cinta',  ['dataSet' => $dataSet])
@endsection
