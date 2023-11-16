@extends('layouts.header')

@section('content')

@include('rpe_datos')

@include('rpe_cinta')



<div class="custom-container mt-4 justify-content-center">
    <h2 class="text-center" >Consultar Solicitud Materia Unica</h2>
          @include('rpe_datos')
 </div>
        <h5 class="text-center" > Seleccionar la materia para registrarla como materia unica</h5>
        <div class="container">
            <div class="row">
              <div class="col-md-4">
                <h6> Materia Unica </h6>
                <select class="form-select">
                  <!-- Opciones del primer select -->

                  <option selected>Seleccionar</option>
                  <option selected>Algebra A</option>
                  <option selected>CalculO B</option>
                </select>
              </div>
              <div class="col-md-4">
                <h6> Semestre </h6>
                <select class="form-select">
                  <!-- Opciones del segundo select -->
                  <option selected>Seleccionar</option>
                  <option selected>2023-2024/I </option>
                  <option selected>2023-2024/I</option>
                </select>
              </div>
              <div class="col-md-4">
                <h6> Fecha HCTC </h6>
                <select class="form-select">
                  <!-- Opciones del tercer select -->
                  <option selected>Seleccionar</option>
                  <option selected>10/12/2023</option>
                  <option selected>01/03/2021</option>
                </select>
              </div>
            </div>
          </div>
          
    
        


<div class="form-group justify-content-center">
    <button class="btn btn-success mr-2" id="recibir-formato"> Recibir Formato </button>
    <button class="btn btn-success" id="editar"> Editar </button>
    <button class="btn btn-success mr-2" id="cancelar"> Cancelar </button>
    <button class="btn btn-success" id="descargar-respuesta"> Descargar Respuesta</button>
    </form>
</div>
 

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
<style>
   
    .container {
        margin-top: 35px;
        max-width: 60%;
        
    }

    .flexbox-align {
  display: flex;
  justify-content: center;
  align-items: center;
    }

    .form-group {
        display: flex;
        align-items: flex-end;
    }

    .form-group label {
        white-space: nowrap;
        width: 250px;
        text-align: right;
    }
 
</style>