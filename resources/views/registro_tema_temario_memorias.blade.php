@extends('layouts.header')

@section('content')
<div class="modal fade" id="ModalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-4" id="exampleModalLabel" data-bs-toggle="modal" data-bs-target="#ModalAgregar">Agregar Capitulo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
        @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Orden</label>
    <input type="text" class="form-control" id="txtrpe" aria-describedby="emailHelp" name="txtorden">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Titulo</label>
    <input type="text" class="form-control" id="txtrpe" aria-describedby="emailHelp" name="txttitulo">
    
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
        <h1>Memorias de Actividad Profesional</h1>
         <h1>Registro Tema y Temario</h1>
        <br>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Generacion:</label>
                            <input type="text" id="promedio" class="form-control" value="2019" readonly >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Direccion:</label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Telefono:</label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asesor y Coasesor</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-tema" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Tema y Temario</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-empresa" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Datos de la Empresa</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <br>
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
     <div class="col-md-8">
       <div class="form-group d-flex">
                <label for="asesor" class="mr-2" style="">Asesor:</label>
                <input type="text" id="Asesor" class="form-control" placeholder="Nombre Asesor">
        </div>
       </div>
       <div class="col-md-8">
       <div class="form-group d-flex">
                <label for="coasesor" class="mr-2" style="">Coasesor:</label>
                <input type="text" id="Coasesor" class="form-control" placeholder="Nombre CoAsesor">
        </div>
       </div>
   </div>
<div class="tab-pane fade" id="nav-tema" role="tabpanel" aria-labelledby="nav-profile-tab">
     <div class="col-md-10">
       <div class="form-group d-flex">
                <label for="tema" class="mr-2" style="">Tema:</label>
                <textarea class="form-control" ></textarea>
        </div>
      </div>
<div class="p-5 table-responsive">
<div class="row justify-content-between">
<div class="col-4">
    <label for="temario" class="mr-2" style="">Temario</label>
    </div>
    <div class="col-4">
    <a class="btn btn-outline-primary" href="" data-bs-toggle="modal" data-bs-target="#ModalAgregar">Agregar Capitulo</a>
    </div>
</div>
<table  class="table table-striped table-hover table-bordered">
  <thead class="bg-primary text-white">
    <tr>
      <th scope="col">Orden</th>
      <th scope="col">Titulo</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Capitulo 1: Introduccion</td>
      <td>
      <a href="" data-bs-toggle="modal" data-bs-target="#ModalEditar"class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
      <a href=""  class="btn btn-danger"> <i class="fa-solid fa-trash"></i></a>
        </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Capitulo 2: Descripcion</td>
      <td>
            <a href="" data-bs-toggle="modal" data-bs-target="#ModalEditar"class="btn btn-info"> <i class="fa-solid fa-pen-to-square"></i></a>
            <a href=""  class="btn btn-danger"> <i class="fa-solid fa-trash"></i></a>
       </td>
       
    </tr>
    
  </tbody>
</table>
</div>

</div>
   <div class="tab-pane fade" id="nav-empresa" role="tabpanel" aria-labelledby="nav-contact-tab">
        <div  class="container-fluid">
           <div class="row">
               <div class="col-md-10">
                   <div class="form-floating mb-3">
                   
                   <input type="text" id="nombremp" class="form-control" placeholder="Nombre de la Empresa">
                   <label for="nombremp" class="mr-2" style="">Nombre de la Empresa:</label>
                </div>
               </div>
            </div>
            <div class="row">
                   <div class="col-md-10">
                       <div class="form-floating mb-3">
                           <input type="text" id="direccion" class="form-control" placeholder="Direccion">
                           <label for="direccion">Direccion:</label>
                       </div>
                    </div>
            </div> 
            <div class="row">
                    <div class="col-md-10">
                            <div class="form-floating mb-3">
                              <input type="text" id="telefono" class="form-control" placeholder="Telefono de la empresa">
                              <label for="telefono" >Telefono(s):</label>
                            </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-5">
                            <div class="form-floating mb-3">
                               <input type="text" id="extension" class="form-control" placeholder="Extension">
                               <label for="extension" >EXT:</label>
                             </div>

                    </div>
            </div>
            <div class="row">
                        <div class="col-md-10">
                           <div class="form-floating mb-3">
                                <input type="text" id="ciudad" class="form-control" placeholder="Ciudad de la empresa ">
                                <label for="ciudad" class="mr-2" style="">Ciudad:</label>
                            </div>
                        </div>
            </div>
         </div>
    </div>
</div>

<br>
<div class="form-group">
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
                    <form id="formulario" method="GET" action="" target="_blank">
                    <button class="btn btn-success" id="descargar-formato">Descargar Formato</button>
                    </form>
</div>
</div>
<script src="https://kit.fontawesome.com/5298f3cc9e.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
        width: 220px;
        text-align: right;
    }

    #temas-ingresados li {
    cursor: pointer;
    padding: 5px;
    transition: background-color 0.3s; /* Agrega una transición suave al cambio de color de fondo */
    list-style: decimal; /* Establece el tipo de viñeta (puedes personalizarlo según tus preferencias) */
    margin-left: 10px; /* Añade margen a la izquierda para separar la viñeta del texto */
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
    display: inline-block; /* Establece la visualización en "inline-block" */
    width: auto; /* Ajusta el ancho si es necesario */
}
</style>


<script>
    $(document).ready(function() {
        var temas = [];
        var temaSeleccionado = null;

        // Agregar un tema cuando se haga clic en el botón "Agregar Tema"
        $("#agregar-tema").click(function() {
            var tema = $("#temario").val();
            if (tema !== "") {
                temas.push(tema);
                mostrarTemas();
                $("#temario").val(""); // Limpiar el campo de entrada
            }
        });

        // Mostrar temas y habilitar la selección de temas
        function mostrarTemas() {
            $("#temas-ingresados").empty(); // Limpiar la lista de temas

            for (var i = 0; i < temas.length; i++) {
                var listItem = $("<li data-index='" + i + "'>" + temas[i] + "</li>");
                $("#temas-ingresados").append(listItem);
            }

            // Habilitar la selección de temas
            $("#temas-ingresados li").click(function() {
                var index = $(this).data("index");

                // Quitar la clase 'selected' de todos los elementos
                $("#temas-ingresados li").removeClass("selected");

                // Agregar la clase 'selected' al elemento seleccionado
                $(this).addClass("selected");

                temaSeleccionado = index;
                mostrarBotonesEditarEliminar();
            });

            // Controlador de clic en el documento para deseleccionar al hacer clic en otro lugar
            $(document).click(function(event) {
                if (!$(event.target).closest("#temas-ingresados").length) {
                    // Hacer clic fuera de la lista de temas
                    $("#temas-ingresados li").removeClass("selected");
                    temaSeleccionado = null;
                    mostrarBotonesEditarEliminar();
                }
            });
        }

        // Mostrar botones "Editar" y "Eliminar" cuando se selecciona un tema
        function mostrarBotonesEditarEliminar() {
            if (temaSeleccionado !== null) {
                $("#editar-tema").show();
                $("#eliminar-tema").show();
            } else {
                $("#editar-tema").hide();
                $("#eliminar-tema").hide();
            }
        }

        // Botón "Editar Tema"
        $("#editar-tema").click(function() {
            var nuevoNombre = prompt("Editar tema:", temas[temaSeleccionado]);
            if (nuevoNombre !== null) {
                temas[temaSeleccionado] = nuevoNombre;
                mostrarTemas();
                temaSeleccionado = null;
                mostrarBotonesEditarEliminar();
            }
        });

        // Botón "Eliminar Tema"
        $("#eliminar-tema").click(function() {
            var confirmar = confirm("¿Estás seguro de que deseas eliminar este tema?");
            if (confirmar) {
                temas.splice(temaSeleccionado, 1);
                mostrarTemas();
                temaSeleccionado = null;
                mostrarBotonesEditarEliminar();
            }
        });
    });
</script>


@endsection