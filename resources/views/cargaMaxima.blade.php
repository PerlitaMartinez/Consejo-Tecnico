@extends('layouts.header')

    @section('content')
        
        @include('usuario_cinta')

        <div class="container">
    <form id="formulario" method="GET" action="{{ route('materiaUnicaPdf.show') }}" target="_blank">
        <h1>Carga Máxima</h1>
        <p>El sistema seleccionará el motivo inicial de la carga máxima</p>

        <div class="row">
                <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox1" checked>
                <label>Reprobé más de 20 materias</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <input class="form-check-input" type="radio" name="checkbox" id="checkbox2" checked>
                <label>Inscribí una vez y media la duración de la carrera</label>
            </div>
        </div>

        <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" >Semestre</label>
                            <select id="semestre" class="form-control">
                                <!-- Opciones para el combo box de Semestre -->
                            </select>
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
        </div> -->

        <!-- FontAwesome (para el ícono del botón) -->
        <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
        <!-- Bootstrap JS (optional) -->
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
        
        <!-- <scroll-container>
            <div class="container">
                <div class="row" style="margin:20px;">
                    <div class="col-14">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center">Solicitud Carga Máxima</h2>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('inicio') }}" class="btn btn-secondary" tabidex="5">Cancelar</a>
                                <button id="submit-button" type="submit" class="btn btn-primary"
                                    tabindex="4">Imprimir</button>
                                <br />
                                <br />
                                <label for="" class="form-label">Por este conducto me permito solicitar a ustedes
                                    autorización para continuar mis estudios en esta Facultad, debido a que:</label>
                            </div>
                            <div class="card-body">
                                <form id="formulario" method="GET" action="{{ route('cargaMaximaPdf.show') }}" target="_blank">
                                    @csrf
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>REPROBE MAS DE 20 MATERIAS</td>
                                                <td><input class="form-check-input" type="radio" name=""
                                                        id="checkbox1" checked></td>
                                            </tr>
                                            <tr>
                                                <td>INSCRIBI UNA VEZ Y MEDIA LA DURACION DE LA CARRERA</td>
                                                <td><input class="form-check-input" type="radio" name=""
                                                        id="checkbox2" checked></td>

                                            </tr>
                                        </tbody>
                                    </table>
                                    <label for="inputPassword5" class="form-label">NOMBRE:</label>
                                    <input class="form-control form-control-sm" type="text" disabled
                                        value="IVAN MARTINEZ LOPEZ">

                                    <label for="inputPassword5" class="form-label">CLAVE:</label>
                                    <input class="form-control form-control-sm" type="text" disabled value="295969">

                                    <label for="inputPassword5" class="form-label">CARRERA:</label>
                                    <input class="form-control form-control-sm" type="text" disabled
                                        value="ING. EN COMPUTACION">

                                    <label for="inputPassword5" class="form-label">CICLO ESCOLAR:</label>
                                    <input class="form-control form-control-sm" type="text" disabled value="2023-2024/I">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </scroll-container> -->



        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <script> -->
            <!-- // Función para mostrar la ventana emergente
        //     function showConfirmationModal() {
        //         var modal = document.getElementById('confirm-modal');
        //         modal.style.display = 'block';
        //     }

        //     // Función para ocultar la ventana emergente
        //     function hideConfirmationModal() {
        //         var modal = document.getElementById('confirm-modal');
        //         modal.style.display = 'none';
        //     }

        //     // Cuando se hace clic en el botón de envío
        //     document.getElementById('submit-button').addEventListener('click', function(e) {
        //         e.preventDefault(); // Evita enviar el formulario de inmediato
        //         showConfirmationModal();
        //     });

        //     document.getElementById('confirm-yes').addEventListener('click', function() {
        //         // Realiza la acción de envío del formulario
        //         document.getElementById('formulario').submit();
        //         hideConfirmationModal();
        //     });

        //     document.getElementById('confirm-no').addEventListener('click', function() {
        //         hideConfirmationModal();
        //     });
        // </script> -->
    @endsection
