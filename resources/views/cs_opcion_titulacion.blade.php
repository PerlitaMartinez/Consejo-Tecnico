<div class="contenedor">
    <div class="mt-4">
        <div class="row mt-4 justify-content-start">
            <div class="col-md-10">
                <p>Seleccionar la opción de titulación, de acuerdo a la opción seleccionada, 
                    el sistema solicitará la captura de los datos necesarios para realizar el trámite</p>
            </div>
        </div>

        <div class="row mt-2 justify-content-start">
            <div class="col-md-4 text-left">
                <label class="col-form-label">Opción de titulación:</label>
            </div>
            <div class="col-md-8">
                <select class="form-control">
                    <!-- Opciones del combo box -->
                    @if (isset($infoAlumno))
                        @foreach ($infoAlumno as $item)
                        
                        @endforeach
                    @endif
                    <option value="">Trabajo Recepcional</option>
                    <option value="">Examen Colectivo</option>
                    <option value="">Exención de Examen por Promedio</option>
                    <option value="">Mediante un semestre o dos cuatrimestres en Estudios de Especialidad o Posgrado</option>
                    <option value="">Memorias de Actividad Profesional</option>
                    <option value="">Opción a No trabajo Recepcional</option>
                    <option value="">Examen General de Egreso de la Licenciatura</option>
                    <option value="">Mediante dos semestres o tres cuatrimestres en Estudios de Especialidad o Posgrado</option>
                    <!-- ... otras opciones ... -->
                </select>
            </div>
        </div>

        <div class="row mt-4 justify-content-start">
            <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2">Fecha del examen en que aprobó su ultima materia </label>
                            <input type="text" id="fecha_examen_aprobado" class="form-control" style="width: 190px;"
                                value="" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="margin-left:175px;">Promedio general aprobatorio
                            </label>
                            <input type="text" id="promedio" class="form-control" style="width: 190px;"
                                value="" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="ano_ingreso" class="mr-2" style="margin-left:165px;">Año de ingreso a la
                                licenciatura</label>
                            <input type="text" id="ano_ingreso" class="form-control" style="width: 190px;"
                                value="" >
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>

<style>
    .contenedor {
        max-width: 75%; /* Ajusta el ancho máximo según tus necesidades */
        margin: 0 auto; /* Centra el contenedor horizontalmente */
        /* Otros estilos que desees aplicar */
    }

    .form-group {
            display: flex;
            align-items: flex-end;
    }

        .form-group label {
            white-space: nowrap;
        }
</style>
