@extends('layouts.header')

@section('content')

@if (isset($dataSet))
@include('usuario_cinta', ['dataSet' => $dataSet])
<div id="data-set-container" data-data-set="{{ json_encode($dataSet) }}"></div>
@else
@include('rpe_cinta', ['admin' => true])
@endif

<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {!! nl2br(session('success')) !!}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="modal fade" id="ModalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="exampleModalLabel" data-bs-toggle="modal"
                        data-bs-target="#ModalAgregar">Agregar Capitulo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario" method="POST"
                        action={{route('temario.create',['dataSet' => $dataSet , 'id' => $id])}}>
                        @csrf
                        <div class="mb-3">
                            <label for="orden" class="form-label">Orden</label>
                            <input type="text" class="form-control" id="txtorden" aria-describedby="emailHelp"
                                name="txtorden">

                        </div>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="txttitulo" aria-describedby="emailHelp"
                                name="txttitulo">

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
    {{-- @include('usuario_cinta') --}}

    <div class="container">
        <form method="POST" action={{route('agregar.datos',['dataSet' => $dataSet , 'id' => $id])}}>
        @csrf
        <h1>Memorias de Actividad Profesional</h1>
        <h1>Registro Tema y Temario</h1>
        <br>
        @if(session("correcto"))
        <div class="alert alert-success">{{session("correcto")}}</div>
        @endif
        @if($exists == 1)
        <div class="row">
            <div class="col-md-10">
                <div class="form-group d-flex">
                    <label for="generacion" class="mr-2" style="">Generacion:</label>
                    <input type="text" id="generacion" class="form-control" value="2019" readonly>
                </div>
            </div>
        </div>

        
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <button class="nav-link active " id="nav-contact-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-direccion" type="button" role="tab" aria-controls="nav-direccion"
                    aria-selected="true">Datos Generales</button>
                <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                    role="tab" aria-controls="nav-home" aria-selected="false">Asesor y
                    Coasesor</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-tema"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Tema y
                    Temario</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-empresa"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Datos de la
                    Empresa</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <br>
            <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="asesor" class="mr-2" style="">Asesor:</label>
                        <input type="text" id="Asesor" class="form-control" placeholder="Nombre Asesor" value="Alberto Ramirez Blanco" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        @foreach($coasesor as $nom)
                        <label for="coasesor" class="mr-2" style="">Coasesor:</label>
                        <input type="text" id="Coasesor" class="form-control" readonly
                         placeholder="Nombre CoAsesor" name="txtcoasesor" value="{{$nom->nombre_coasesor}}">
                         @endforeach
                        </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="nav-direccion" role="tabpanel" aria-labelledby="nav-contact-tab">
            @foreach ($datosA as $datos)
                <div class="col-md-8">
                    <div class="form-group d-flex">
                 
                        <label for="calleA" class="mr-2" style="">Calle:</label>
                        <input type="text" id="calleA" class="form-control" readonly placeholder="Nombre de la calle"
                            name="txtcalle" value="{{$datos->calle_alumno}}">
                    
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="coloniaA" class="mr-2" style="">Colonia:</label>
                        <input type="text" id="coloniaA" class="form-control" readonly placeholder="Nombre de la colonia"
                            name="txtcolonia" value="{{$datos->colonia_alumno}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="noEA" class="mr-2" style="">No. Ext:</label>
                        <input type="text" id="noEA" class="form-control" readonly placeholder="Numero de exterior" name="txtNo"
                        value="{{$datos->num_exterior_alumno}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="noIA" class="mr-2" style="">No. Int:</label>
                        <input type="text" id="noIA" class="form-control" readonly placeholder="Numero Interior" name="txtNi"
                        value="{{$datos->num_interior_alumno}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="cp" class="mr-2" style="">C.P:</label>
                        <input type="text" id="cp" class="form-control" readonly placeholder="Codigo Postal" name="txtcp"
                        value="{{$datos->cp_alumno}}"
                        >
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="telefono" class="mr-2" style="">Telefono:</label>
                        <input type="text" id="Telefono" class="form-control" readonly placeholder="Telefono" ,
                            name="txttelefono" value="{{$datos->telefono_alumno}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="coasesor" class="mr-2" style="">Email:</label>
                        <input type="text" id="email" class="form-control" readonly placeholder="Correo Electronico"
                            name="txtemail" value="{{$datos->correo_alumno}}">
                    </div>
                </div>
               @endforeach
            </div>

            <div class="tab-pane fade" id="nav-tema" role="tabpanel" aria-labelledby="nav-profile-tab">

                <div class="col-md-10">
                    <div class="form-group d-flex">
                    @foreach ($tema as $tem)
                        <label for="tema" class="mr-2" style="">Tema:</label>
                        <input type="text" class="form-control" readonly name="txtTema" value="{{$tem->tema}}"></input>
                    @endforeach
                    </div>
                </div>
                
                <div class="p-5 table-responsive">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <label for="temario" class="mr-2" style="">Temario</label>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-outline-primary" href="" data-bs-toggle="modal"
                                data-bs-target="#ModalAgregar" disabled ="true">Agregar Capitulo</a>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Orden</th>
                                <th scope="col">Titulo</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temarios as $temario)
                            <tr>
                                <td>{{$temario->id_seccion}}</td>
                                <td>{{$temario->nombre_seccion}}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#ModalEditar"
                                        class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn btn-danger"> <i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-empresa" role="tabpanel" aria-labelledby="nav-contact-tab">
              @foreach($datosE as $datE)
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="nombre" class="mr-2" style="">Nombre:</label>
                        <input type="text" id="nombre" class="form-control" name="txtnombreE"
                            placeholder="Nombre de la empresa" value="{{$datE->nombre_empresa}}" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="calle" class="mr-2" style="">Calle:</label>
                        <input type="text" id="calle" class="form-control" name="txtcalleE"
                            placeholder="Nombre de la calle" value="{{$datE->calle_empresa}}" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="colonia" class="mr-2" style="">Colonia:</label>
                        <input type="text" id="colonia" class="form-control" name="txtcoloE"
                            placeholder="Nombre de la colonia" value="{{$datE->colonia_empresa}}" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="noE" class="mr-2" style="" >No. Ext:</label>
                        <input type="text" id="noE" class="form-control" readonly name="txtnEE" 
                        placeholder="Numero de exterior" value="{{$datE->num_exterior_empresa}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="noI" class="mr-2" style="">No. Int:</label>
                        <input type="text" id="noI" class="form-control" readonly name="txtnIE"
                        placeholder="Numero Interior" value="{{$datE->num_interior_empresa}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="cp" class="mr-2" style="">C.P:</label>
                        <input type="text" id="cp" class="form-control" name="txtcpE"  readonly 
                        placeholder="Codigo Postal" value="{{$datE->cp_empresa}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="email" class="mr-2" style="">Email:</label>
                        <input type="text" id="email" class="form-control" name="txtemailEm"
                            placeholder="Correo Electronico empresa" value="{{$datE->correo_empresa}}" readonly>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="telefono" class="mr-2" style="">Telefono:</label>
                        <input type="text" id="telefono" class="form-control" name="txtteleE"
                            placeholder="Telefono de la empresa" value="{{$datE->telefono_empresa}}" readonly>
                    </div>
                </div>
               @endforeach
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-10">
                <div class="form-group d-flex">
                    <label for="generacion" class="mr-2" style="">Generacion:</label>
                    <input type="text" id="generacion" class="form-control" value="2019" readonly>
                </div>
            </div>
        </div>

       
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                <button class="nav-link active " id="nav-contact-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-direccion" type="button" role="tab" aria-controls="nav-direccion"
                    aria-selected="true">Datos Generales</button>
                <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                    role="tab" aria-controls="nav-home" aria-selected="false">Asesor y
                    Coasesor</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-tema"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Tema y
                    Temario</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-empresa"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Datos de la
                    Empresa</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <br>
            <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="asesor" class="mr-2" style="">Asesor:</label>
                        <input type="text" id="Asesor" class="form-control" placeholder="Nombre Asesor">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="coasesor" class="mr-2" style="">Coasesor:</label>
                        <input type="text" id="Coasesor" class="form-control" placeholder="Nombre CoAsesor" name="txtcoasesor">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="nav-direccion" role="tabpanel" aria-labelledby="nav-contact-tab">

                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="calleA" class="mr-2" style="">Calle:</label>
                        <input type="text" id="calleA" class="form-control" placeholder="Nombre de la calle"
                            name="txtcalle">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="coloniaA" class="mr-2" style="">Colonia:</label>
                        <input type="text" id="coloniaA" class="form-control" placeholder="Nombre de la colonia"
                            name="txtcolonia">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="noEA" class="mr-2" style="">No. Ext:</label>
                        <input type="text" id="noEA" class="form-control" placeholder="Numero de exterior" name="txtNo">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="noIA" class="mr-2" style="">No. Int:</label>
                        <input type="text" id="noIA" class="form-control" placeholder="Numero Interior" name="txtNi">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="cp" class="mr-2" style="">C.P:</label>
                        <input type="text" id="cp" class="form-control" placeholder="Codigo Postal" name="txtcp">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="telefono" class="mr-2" style="">Telefono:</label>
                        <input type="text" id="Telefono" class="form-control" placeholder="Telefono" ,
                            name="txttelefono">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="coasesor" class="mr-2" style="">Email:</label>
                        <input type="text" id="email" class="form-control" placeholder="Correo Electronico"
                            name="txtemail">
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="nav-tema" role="tabpanel" aria-labelledby="nav-profile-tab">

                <div class="col-md-10">
                    <div class="form-group d-flex">
                        <label for="tema" class="mr-2" style="">Tema:</label>
                        <input type="text" class="form-control" name="txtTema"></input>
                    </div>
                </div>
                
                <div class="p-5 table-responsive">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <label for="temario" class="mr-2" style="">Temario</label>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-outline-primary" href="" data-bs-toggle="modal"
                                data-bs-target="#ModalAgregar">Agregar Capitulo</a>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Orden</th>
                                <th scope="col">Titulo</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temarios as $temario)
                            <tr>
                                <td>{{$temario->id_seccion}}</td>
                                <td>{{$temario->nombre_seccion}}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#ModalEditar"
                                        class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn btn-danger"> <i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-empresa" role="tabpanel" aria-labelledby="nav-contact-tab">

                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="nombre" class="mr-2" style="">Nombre:</label>
                        <input type="text" id="nombre" class="form-control" name="txtnombreE"
                            placeholder="Nombre de la empresa">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="calle" class="mr-2" style="">Calle:</label>
                        <input type="text" id="calle" class="form-control" name="txtcalleE"
                            placeholder="Nombre de la calle">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="colonia" class="mr-2" style="">Colonia:</label>
                        <input type="text" id="colonia" class="form-control" name="txtcoloE"
                            placeholder="Nombre de la colonia">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="noE" class="mr-2" style="">No. Ext:</label>
                        <input type="text" id="noE" class="form-control" name="txtnEE" placeholder="Numero de exterior">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="noI" class="mr-2" style="">No. Int:</label>
                        <input type="text" id="noI" class="form-control" name="txtnIE" placeholder="Numero Interior">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="cp" class="mr-2" style="">C.P:</label>
                        <input type="text" id="cp" class="form-control" name="txtcpE" placeholder="Codigo Postal">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="email" class="mr-2" style="">Email:</label>
                        <input type="text" id="email" class="form-control" name="txtemailEm"
                            placeholder="Correo Electronico empresa">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group d-flex">
                        <label for="telefono" class="mr-2" style="">Telefono:</label>
                        <input type="text" id="telefono" class="form-control" name="txtteleE"
                            placeholder="Telefono de la empresa">
                    </div>
                </div>
            </div>
        </div>
        @endif
        <br>
        <div class="form-group">
                @if ($exists == 1)
                    <a class="btn btn-success" id="descargar-formato">Descargar Formato1</a>
                    <a class="btn btn-success" id="descargar-formato1">Descargar Formato2</a>
                    
                @else
                     <button type="submit" class="btn btn-primary">Registrar Solicitud</button>
                @endif
                
            </div>
       
        </form>

      
    </div>
    <script src="https://kit.fontawesome.com/5298f3cc9e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
    .container {
        margin-top: 35px;
        max-width: 80%;
    }

    .form-group {
        display: flex;
        align-items: flex-end;
    }

    .form-group label {
        white-space: nowrap;
        width: 220px;
        text-align: right;
    }

    #temas-ingresados li {
        cursor: pointer;
        padding: 5px;
        transition: background-color 0.3s;
        /* Agrega una transición suave al cambio de color de fondo */
        list-style: decimal;
        /* Establece el tipo de viñeta (puedes personalizarlo según tus preferencias) */
        margin-left: 10px;
        /* Añade margen a la izquierda para separar la viñeta del texto */
    }

    #temas-ingresados li.selected {
        background-color: #00b2e3;
        color: white;
        border-radius: 5px;
    }

    #temas-ingresados li:hover {
        background-color: #00b2e3;
        color: white;
        border-radius: 5px;
    }

    .agregar-btn {
        display: inline-block;
        /* Establece la visualización en "inline-block" */
        width: auto;
        /* Ajusta el ancho si es necesario */
    }
    </style>


    <script type="text/javascript">
         @if (!isset($admin))
            var dataSet = @json($dataSet);
            @if (isset($id))
                var id = @json($id);
                var url = "{{ route('memoriasPDF.show') }}?dataSet=" + JSON.stringify(dataSet) + "&id=" + id;;
                var url2 = "{{ route('memoriasPDF2.show') }}?dataSet=" + JSON.stringify(dataSet) + "&id=" + id;;
            @endif

           


            @if (isset($id))
                // Agrega un cuadro de diálogo de confirmación al botón "Descargar Formato"
                document.getElementById('descargar-formato').addEventListener('click', function(event) {
                    event.preventDefault();
                    if (confirm('¿Estás seguro(a) de que deseas descargar el formato?')) {
                        window.open(url, "_blank");
                    }
                });
                document.getElementById('descargar-formato1').addEventListener('click', function(event) {
                    event.preventDefault();
                    if (confirm('¿Estás seguro(a) de que deseas descargar el formato?')) {
                        window.open(url2, "_blank");
                    }
                });
               
            @endif
        @else
            @if (!isset($id))
                // Agrega un cuadro de diálogo de confirmación al botón "Registrar Solicitud"
                document.getElementById('registrar-solicitud').addEventListener('click', function(event) {
                    event.preventDefault();
                    if (confirm('¿Estás seguro(a) que deseas registrar la solicitud?')) {
                        // código para registrar la solicitud si se hace clic en "Aceptar"
                        document.getElementById('formulario').submit()
                    }
                });
            @endif
        @endif

    </script>


    @endsection