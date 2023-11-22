<div class="contenedor">
    <!-- Texto "Seleccionar la materia para registrarla como materia única" -->
    <div class="row mt-4 justify-content-start">
        <div class="col-md-10">
            <p>Seleccionar la materia para registrarla como materia única</p>
        </div>
    </div>

    @if (isset($infoAlumno) && $infoAlumno == 'registered')
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
                @if (isset($infoAlumno) && $infoAlumno != 'registered')
                    @foreach ($infoAlumno as $item)
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
                @if (isset($infoAlumno) && $infoAlumno != 'registered')
                    <option value="{{ $infoAlumno[0]['semestre'] }}">{{ $infoAlumno[0]['semestre'] }}</option>
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
    @if (isset($infoAlumno) && $infoAlumno != 'registered')
        $(document).ready(function() {
            $('#materia').on('change', function() {
                var materias = @json($infoAlumno);
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

    
</script>
