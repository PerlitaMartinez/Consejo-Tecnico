@extends('layouts.header')

@section('content')

@include('rpe_datos')

@include('rpe_cinta')



<div class="custom-container mt-4 justify-content-center">
    <h2 class="text-center" >Crear Solicitud Carga Maxima</h2>
    
     <!-- Botón "Nueva Sesión" -->
    
     <div class="container ">
        <div class="row">
          <div class="col-md-4">
            <label for="inputDato" class="form-label">Clave Unica</label>
          </div>
          <div class="col-md-4">
            <input type="text" class="form-control" id="nombre" placeholder="Clave">
          </div>
          <div class="col-md-4">
            <button type="button" class="btn btn-primary">Consultar</button>
          </div>
        </div>
        @include('rpe_datos')
      </div>
            <div class="row mt-4 justify-content-center">
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opciones" id="cargaMaximaCheckbox" checked>
                        <label class="form-check-label" for="cargaMaximaCheckbox">
                            Carga Máxima
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opciones" id="materiaUnicaCheckbox">
                        <label class="form-check-label" for="materiaUnicaCheckbox">
                            Materia Única
                        </label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="opciones" id="opcionTitulacionCheckbox">
                        <label class="form-check-label" for="opcionTitulacionCheckbox">
                            Opción de Titulación
                        </label>
                    </div>
                </div>
            </div>
    <div class=" container ">
        <div class="form-check mb-0" >
            <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1" checked>Reprobe mas de 20 materias
            <label class="form-check-label" for="radio1"></label>
         </div>
            <div class="form-check ">
                <input type="radio" class="form-check-input" id="radio2" name="optradio" value="option2">Inscribi una vez y media la carrera
                <label class="form-check-label" for="radio2"></label>
            </div>
            <div class="text-center">
                <select class="form-control">
                    <option selected>Semestre</option>
                    <option value="1">2023-2024/I</option>
                    <option value="2">2023-2024/I</option>
                    <option value="3">2023-2024/I</option>
                    <option value="2">2023-2024/I</option>
                    <option value="3">2023-2024/I</option>
                </select>
            </div>
    </div>
    
</div>

<div class="form-group justify-content-center">
    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
    <button class="btn btn-success" id="descargar-formato">Descargar Formato</button>
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
