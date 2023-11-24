<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="contenedor">
    <!-- Texto "Seleccionar la materia para registrarla como materia única" -->
    <div class="row mt-4 justify-content-start">
        <div class="col-md-10">
            <p>Seleccionar la materia para registrarla como materia única</p>
        </div>
    </div>

    @if (isset($infoAlumnoMU) && $infoAlumnoMU == 'registered')
        <div class="col-md-10">
            <p>El alumno no cuenta con alguna materia única para ser registrada.</p>
        </div>
    @endif

    <!-- Fila con combo box para la materia y botón "Buscar Materia" -->
    <div class="row mt-2 justify-content-start">
        <div class="col-md-3 text-left">
            <label class="col-form-label">Materia única:</label>
        </div>
        <div class="col-md-3">
            <select id="materia" name="materia" style="width: 25vmin;" class="form-control">
                <!-- Opciones del combo box -->
                @if (isset($infoAlumnoMU) && $infoAlumnoMU != 'registered')
                    @foreach ($infoAlumnoMU as $item)
                        <option value="{{ $item['nombre_materia'] }}">{{ $item['nombre_materia'] }}
                        </option>
                    @endforeach
                @endif
                <!-- ... otras opciones ... -->
            </select>
        </div>
    </div>

    <!-- Fila con texto "Semestre" y combo box para seleccionar el semestre -->
    <div class="row mt-4 justify-content-start">
        <div class="col-md-3 text-left">
            <label class="col-form-label">Semestre:</label>
        </div>
        <div class="col-md-3">
            <select id="semestre" name="semestre" style="width: 25vmin;" class="form-control">
                <!-- Opciones del combo box -->
                @if (isset($infoAlumnoMU) && $infoAlumnoMU != 'registered')
                    <option value="{{ $infoAlumnoMU[0]['semestre'] }}">{{ $infoAlumnoMU[0]['semestre'] }}</option>
                @endif

            </select>
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
    @if (isset($infoAlumnoMU) && $infoAlumnoMU != 'registered')
        var materias = @json($infoAlumnoMU);
        $(document).ready(function() {
            $('#materia').on('change', function() {
                var materias = @json($infoAlumnoMU);
                var materiaSeleccionada = $('#materia option:selected').text().trim();
                $('#semestre').empty();
                for (var i = 0; i < materias.length; i++) {
                    if (materias[i]['nombre_materia'].trim() == materiaSeleccionada) {
                        $('#semestre').append(
                            '<option value="' + materias[i]["semestre"] + '">' + materias[i][
                                "semestre"
                            ] + '</option>'
                        );

                    }
                }
            });
        });
    @endif

    @if (isset($infoAlumnoMU) && $infoAlumnoMU != 'registered')
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var infoAlumnoMU = @json($infoAlumnoMU);
        var id;
        $(document).ready(function() {
            $('#registrar-solicitud').on('click', function(event) {
                if (materiaUnicaCheckbox.checked) { //registramos la solicitud de materia Única

                    $('#saveChangesButton').click(function() {
                        var materia = $('#materia').val();
                        var semestre = $('#semestre').val();
                        console.log(materia, semestre);
                        event.preventDefault();

                        $.post('{{ route('materiaUnica.store') }}', {
                            _token: "{{ csrf_token() }}",
                            materia: materia,
                            semestre: semestre,
                            dataSet: JSON.stringify(infoAlumnoMU),
                            rol: 'RPE'
                        }, function(data) {
                            id = data.id;
                            var alertaClaveUnicaVacia =
                                document
                                .createElement(
                                    'div');
                            alertaClaveUnicaVacia
                                .classList
                                .add('alert',
                                    'alert-success',
                                    'mt-3'
                                );
                            alertaClaveUnicaVacia
                                .innerText =
                                'Solicitud Registrada con éxito';
                            document
                                .getElementById(
                                    'mensajeContainer'
                                )
                                .appendChild(
                                    alertaClaveUnicaVacia
                                );

                            var url = "{{ route('materiaUnicaPDF.show') }}?id=" + id;
                            window.open(url, "_blank");
                            location.reload();
                        }, 'json');

                    });

                }
            });

        });
    @endif
</script>
