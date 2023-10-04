@extends('layouts.header')

@section('description')
<div class="text">
<div class="container-text">
    <p class="bold-text" >SISTEMA</p>
    <p class="bold-text">HCTC - ALUMNO</p>
</div>     

@endsection

@section('menuA')
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="nav-link active" aria-current="page" href="/encabezado">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center"  id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/users_tipo">Alumno</a>
        </li>
        
      </ul>
      
    </div>
  </div>
</nav>
    <!-- FontAwesome (para el ícono del botón) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('solicitud')
<div class="container">
      <div class="row"  style="margin:20px;">
         <div class="col-14">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Solicitud Materia Unica</h2>
                </div>
                <div class="card-body">
                <a href="/grupos_user" class="btn btn-secondary" tabidex="5">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="4">Imprimir</button>
                <br/>
                <br/>
                <label for="" class="form-label">Por este conducto me permito dirigirme a ustedes, solicitando autorización para cursar una materia como única</label>
                </div>
                 <div class="card-body">
                 <form action="" method = "POST">
 @csrf
<table class="table table-striped table-hover">
  <thead>
    <tr>
        <th scope ="col"></th>
        <th scope ="col"></th>
        
    </tr>
  </thead>

  <div class="form-group">
   <Label for="">Materia</label>
   <select name="categoria_id" id="InputCategorta_id" class="form-control">
     <option value="">--Seleccione la materia--</option>
     <option value="">MateriaPrueba</option>
   </select>
  </div>

  <div class="form-group">
   <Label for="">Semestre</label>
   <select name="categoria_id" id="InputCategorta_id" class="form-control">
     <option value="">--Seleccione el semestre--</option>
     <option value="">SemestrePrueba</option>
  </select>
  </div>


</table>
<label for="inputPassword5" class="form-label">NOMBRE:</label>
  <input class="form-control form-control-sm" type="text"  disabled value="AlumnoPrueba">
  
  <label for="inputPassword5" class="form-label">CLAVE:</label>
  <input class="form-control form-control-sm" type="text"  disabled value="123456">
  
   <label for="inputPassword5" class="form-label">CARRERA:</label>
  <input class="form-control form-control-sm" type="text"  disabled value="Computacion">
  
  <label for="inputPassword5" class="form-label">CICLO ESCOLAR:</label>
  <input class="form-control form-control-sm" type="text"  disabled value="2022-2023">
  </form>

                 </div>
               </div>
         </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

@endsection