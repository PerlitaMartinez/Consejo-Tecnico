@extends('layouts.header')

@section('content')

@include('usuario_cinta')

<div class="container">
    <form id="formulario" method="POST" action="{{ route('opcionTitulacionPdf.show') }}" target="_blank">
        @csrf
        <h1>Opciones de Titulación</h1>
        <p>Seleccionar la opción de titulación, de acuerdo a la opción seleccionada, el sistema solicitará la captura de los datos necesarios para realizar el trámite</p>

        <div class="row">
                <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox1" checked>
                <label>Trabajo Recepcional</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Tesis</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Examen Colectivo</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Exención de Examen por Promedio</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Mediante un semestre o dos cuatrimestres en Estudios de Especialidad o Posgrado</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Mediante dos semestres o tres cuatrimestres en Estudios de Especialidad o Posgrado</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Examen de Conocimientos con Duración de 8 horas</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Memorias de Actividad Profesional</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Opción a No trabajo Recepcional</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Examen General de Egreso de la Licenciatura</label>
            </div>
        </div>

        <br>

        <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" >Fecha del examen en que aprobó su ultima materia </label>
                            <input type="text" id="fecha_examen_aprobado" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="margin-left:175px;">Promedio general aprobatorio </label>
                            <input type="text" id="promedio" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
    <div class="col-md-10">
        <div class="form-group d-flex">
            <label for="ano_ingreso" class="mr-2" style="margin-left:165px;">Año de ingreso a la licenciatura</label>
            <input type="text" id="ano_ingreso" class="form-control" readonly>
        </div>
    </div>
</div>
        <br>

        <div class="form-group">
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
                    <button class="btn btn-success" id="descargar-formato">Descargar Formato</button>
        </div>
    </form>
</div>


<style>

    .container {
        margin-top: 35px;
        max-width: 60%;
        
    }

    .form-group {
        display: flex;
        align-items: flex-end;
    }

    .form-group label {
        white-space: nowrap;
    }

</style>


<!-- <div id="confirm-modal" class="modal">
            <div class="modal-content">
                <p>¿Estás seguro de que la información ingresada es correcta?</p>
                <button id="confirm-yes">Sí</button>
                <button id="confirm-no">No</button>
            </div>
</div>

<div class="container" style="margin-top: 10px;">
    <div class="row" style="margin: 20px;">
        <div class="col-14">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Solicitud de Opcion de Titulación</h2>
                </div>
                <div class="card-body">
                    <label for="" class="form-label">De la manera más atenta me dirijo a ese H. Cuerpo Colegiado para solicitar autorización para titularme de Ingeniero(a) de la carrera</label>
                    <input class="form-control form-control-sm" type="text" disabled value="Ingeniería en computacion">
                    <br />
                    <label for="" class="form-label">mediante la opción:</label>
                </div>
                <div class="card-body">
                                <form id="formulario" method="GET" action="{{ route('opcionTitulacionPdf.show') }}" target="_blank">

                        @csrf

                        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="trabajoRecepcional" id="trabajoRecepcional">
                <label class="form-check-label" for="trabajoRecepcional">Trabajo Recepcional</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos"></label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Tesis</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Memorias de Actividad Profesional</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Examen Colectivo</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Opción a No trabajo Recepcional</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Exención de Examen por Promedio</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Examen General de Egreso de la Licenciatura</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Mediante un semestre o dos cuatrimestres en Estudios de Especialidad o Posgrado</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Mediante dos semestres o tres cuatrimestres en Estudios de Especialidad o Posgrado</label>
            </div>
             Repite el mismo patrón para los otros elementos form-check
        </div>
        <br />

                        <label for="inputPassword5" style="margin-top: 10px; margin-bottom: 1px;" class="form-label">NOMBRE:</label>
                        <input class="form-control form-control-sm" type="text" disabled value="IVAN MARTINEZ LOPEZ">

                        <label for="inputPassword5" style="margin-top: 10px;margin-bottom: 1px;"class="form-label">CLAVE:</label>
                        <input class="form-control form-control-sm" type="text" disabled value="295969">

                        <label for="inputPassword5" style="margin-top: 10px;margin-bottom: 1px;"class="form-label">FECHA DEL EXAMEN EN QUE APROBO SU ULTIMA MATERIA</label>
                        <input class="form-control form-control-sm" type="text" disabled value="03/12/2022">

                        <label for="inputPassword5" style="margin-top: 10px;margin-bottom: 1px;"class="form-label">PROMEDIO GENERAL APROBATORIO:</label>
                        <input class="form-control form-control-sm" type="text" disabled value="75.5">

                        <label for="inputPassword5" style="margin-top: 10px;margin-bottom: 1px;"class="form-label">AÑO EN QUE INGRESO A LA LICENCIATURA:</label>
                        <input class="form-control form-control-sm" type="text" disabled value="2015">
                    </form>
                    <br />
                    <a href="/hctc/inicio" class="btn btn-secondary" tabindex="5">Cancelar</a>
                    <button id="submit-button" type="submit" class="btn btn-primary" tabindex="4">Imprimir</button>
                </div>
                
            </div>
            
        </div>
        
    </div>
    
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script> -->
    <!-- <script>
            // Función para mostrar la ventana emergente
            function showConfirmationModal() {
                var modal = document.getElementById('confirm-modal');
                modal.style.display = 'block';
            }

            // Función para ocultar la ventana emergente
            function hideConfirmationModal() {
                var modal = document.getElementById('confirm-modal');
                modal.style.display = 'none';
            }

            // Cuando se hace clic en el botón de envío
            document.getElementById('submit-button').addEventListener('click', function(e) {
                e.preventDefault(); // Evita enviar el formulario de inmediato
                showConfirmationModal();
            });

            document.getElementById('confirm-yes').addEventListener('click', function() {
                // Realiza la acción de envío del formulario
                document.getElementById('formulario').submit();
                hideConfirmationModal();
            });

            document.getElementById('confirm-no').addEventListener('click', function() {
                hideConfirmationModal();
            });
        </script> -->

@endsection
