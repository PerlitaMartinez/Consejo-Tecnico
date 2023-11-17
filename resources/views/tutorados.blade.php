@extends('layouts.header')

@section('content')

@include('rpe_datos')

@include('rpe_cinta')

<div class="custom-container mt-4">


        <br><br><center><h2>Tutorados</h2></center><br><br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Clave Única</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Semestre</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>214585</td>
                            <td>Jorge López Castillo</td>
                            <td>9no semestre</td>
                        </tr>
                        <tr>
                            <td>235614</td>
                            <td>Ximena Hernández Sánchez</td>
                            <td>1er semestre</td>
                        </tr>
                        <tr>
                            <td>145200</td>
                            <td>Gustavo Jiménez Ruíz</td>
                            <td>5to semestre</td>
                        </tr>
                </tbody>
            </table>
        </div>
   
</div>

<style>
    /* Agrega un estilo personalizado para el contenedor */
    .custom-container {
        max-width: 70%; /* Ajusta el valor según tus necesidades */
        margin-right: auto;
        margin-left: auto;
    }

    .row {
        max-width: 95%; /* Ajusta el valor según tus necesidades */
        margin-right: auto;
        margin-left: auto;
    }
</style>

@endsection