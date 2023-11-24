@extends('layouts.header')

@section('content')

@include('rpe_datos')

@include('rpe_cinta')
<div class="modal fade" id="ModalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalLabel" data-bs-toggle="modal"
                    data-bs-target="#ModalAgregar">Agregar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route("user.create")}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">RPE</label>
                        <input type="text" class="form-control" id="txtrpe" aria-describedby="emailHelp" name="txtrpe">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">NOMBRE</label>
                        <input type="text" class="form-control" id="txtrpe" aria-describedby="emailHelp"
                            name="txtnombre">

                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="custom-container mt-4">


    <br><br>
    <center>
        <h2>Usuarios</h2>
    </center><br><br>
    @if(session("correcto"))
    <div class="alert alert-success">{{session("correcto")}}</div>
    @endif
    <a class="btn btn-outline-primary" href="" data-bs-toggle="modal" data-bs-target="#ModalAgregar">Agregar</a>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">RPE</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">ACCIONES</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->rpe}}</td>
                    <td>{{$usuario->nombre_usuario}}</td>
                    <td>
                        <a href="" data-bs-toggle="modal" data-bs-target="#ModalEditar{{$usuario->rpe}}"
                            class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="" class="btn btn-danger"> <i class="fa-solid fa-trash"></i></a>
                    </td>
                    <div class="modal fade" id="ModalEditar{{$usuario->rpe}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-4" id="exampleModalLabel">Editar Usuario</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route("user.update")}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">RPE</label>
                                            <input type="text" class="form-control" id="txtrpe"
                                                aria-describedby="emailHelp" name="txtrpe" value="{{$usuario->rpe}}">

                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">NOMBRE</label>
                                            <input type="text" class="form-control" id="txtrpe"
                                                aria-describedby="emailHelp" name="txtnombre"
                                                value="{{$usuario->nombre_usuario}}">

                                        </div>



                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<style>
/* Agrega un estilo personalizado para el contenedor */
.custom-container {
    max-width: 70%;
    /* Ajusta el valor según tus necesidades */
    margin-right: auto;
    margin-left: auto;
}

.row {
    max-width: 95%;
    /* Ajusta el valor según tus necesidades */
    margin-right: auto;
    margin-left: auto;
}
</style>
<script src="https://kit.fontawesome.com/5298f3cc9e.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>



@endsection