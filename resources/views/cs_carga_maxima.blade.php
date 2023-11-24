<div class="contenedor">
    <div class="mt-4">
        <!-- Lista de radio buttons -->
        <div class="row mt-4 justify-content-start">
            <div class="col-md-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="opciones" value="opcion1"
                        @if (isset($infoAlumnoCM) && $infoAlumnoCM['materias_reprobadas_semestre'] != null) checked @endif>
                    <label class="form-check-label" for="reprobadasRadio1">
                        Reprobé más de 20 materias
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="opciones" value="opcion2"
                        @if (isset($infoAlumnoCM) && $infoAlumnoCM['duracion_y_media_semestre'] != null) checked @endif>
                    <label class="form-check-label" for="reprobadasRadio2" style="height: 100%; width: 100%">
                        Inscríbí una vez y media la duración de la carrera
                    </label>
                </div>
            </div>
        </div>

        <!-- Texto "Semestre" y combo box en la misma fila -->
        <div class="row mt-4 justify-content-start">
            <div class="col-md-3 text-left">
                <label class="col-form-label">Semestre:</label>
            </div>
            <div class="col-md-3">
                <select style="width: 150%" class="form-control">
                    <!-- Opciones del combo box -->
                    @if (isset($infoAlumnoCM) && $infoAlumnoCM['materias_reprobadas_semestre'] != null)
                        <option value=""> {{ $infoAlumnoCM['materias_reprobadas_semestre'] }}</option>
                    @endif
                    @if (isset($infoAlumnoCM) && $infoAlumnoCM['duracion_y_media_semestre'] != null)
                        <option value=""> {{ $infoAlumnoCM['duracion_y_media_semestre'] }} </option>
                    @endif
                    <!-- ... otras opciones ... -->
                </select>
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
</style>

<script>
    @if (isset($infoAlumnoCM) && $infoAlumnoCM != 'registered')
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var id;
        var arregloBidimensional = [];
        $(document).ready(function() {
            $('#registrar-solicitud').on('click', function(event) {
                if (cargaMaximaCheckbox.checked) { //registramos la solicitud de materia Única

                    $('#saveChangesButton').click(function() {

                        event.preventDefault();
                
                        $.post('{{ route('cargaMaxima.store') }}', {
                                _token: "{{ csrf_token() }}",
                                rol: 'RPE'
                            })
                            .done(function(data) {
                                // Manejar la respuesta exitosa aquí
                                id = data.id;
                                var url = "{{ route('cargaMaximaPDF.show') }}?id=" + id;
                                window.open(url, "_blank");
                                location.reload();
                            });


                    });

                }
            });

        });
    @endif
</script>
