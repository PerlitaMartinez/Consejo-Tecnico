<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

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
                <select id="materiasSelect" class="form-control">
                    <!-- Opciones del combo box -->
                    @foreach ($materias as $materia)
                        <option value="{{ $materia->opcion_titulacion }}" id="{{ $materia->id_opcion_titulacion }}">
                            {{ $materia->opcion_titulacion }}</option>
                    @endforeach
                    <!-- ... otras opciones ... -->
                </select>
            </div>
        </div>

        <div class="row mt-4 justify-content-start">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group d-flex">
                        <label class="mr-2">Fecha del examen en que aprobó su ultima materia </label>
                        <input type="text" id="fecha_examen_aprobado" class="form-control" style="width: 190px;"
                            value="23/10/2023">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group d-flex">
                        <label class="mr-2" style="margin-left:175px;">Promedio general aprobatorio
                        </label>
                        <input type="text" id="promedio" class="form-control" style="width: 190px;" value="8.0">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group d-flex">
                        <label for="ano_ingreso" class="mr-2" style="margin-left:165px;">Año de ingreso a la
                            licenciatura</label>
                        <input type="text" id="ano_ingreso" class="form-control" style="width: 190px;"
                            value="2018">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .contenedor {
        max-width: 75%;
        /* Ajusta el ancho máximo según tus necesidades */
        margin: 0 auto;
        /* Centra el contenedor horizontalmente */
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



<script>
    @if (isset($materias) && $materias != 'registered')
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var id;
        var arregloBidimensional = [];
        $(document).ready(function() {
            $('#registrar-solicitud').on('click', function(event) {
                if (opcionTitulacionCheckbox.checked) { //registramos la solicitud de materia Única

                    $('#saveChangesButton').click(function() {

                        event.preventDefault();
                        var selectedOptionId = $('#materiasSelect').find('option:selected')
                            .attr('id');
                        $.post('{{ route('opcionTitulacion.store') }}', {
                                _token: "{{ csrf_token() }}",
                                dataSet: arregloBidimensional,
                                opcion_titulacion: selectedOptionId,
                                rol: 'RPE'
                            })
                            .done(function(data) {
                                // Manejar la respuesta exitosa aquí
                                id = data.id;
                                var url = "{{ route('opTitulacionPDF.show') }}?id=" + id;
                                window.open(url, "_blank");
                                location.reload();
                            });


                    });

                }
            });

        });
    @endif
</script>
