<div class="contenedor">
    <!-- Texto "Seleccionar la materia para registrarla como materia única" -->
    <div class="row mt-4 justify-content-start">
        <div class="col-md-10">
            <p>Seleccionar la materia para registrarla como materia única</p>
        </div>
    </div>

    <!-- Fila con combo box para la materia y botón "Buscar Materia" -->
    <div class="row mt-2 justify-content-start">
        <div class="col-md-3 text-left">
            <label class="col-form-label">Materia única:</label>
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <!-- Opciones del combo box -->
                @if (isset($infoAlumno))
                    @foreach ($infoAlumno as $item)
                        
                    @endforeach
                @endif
                <option value="materia1">Materia 1</option>
                <option value="materia2">Materia 2</option>
                <!-- ... otras opciones ... -->
            </select>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" style="width: 110%">Buscar Materia</button>
        </div>
    </div>

    <!-- Fila con texto "Semestre" y combo box para seleccionar el semestre -->
    <div class="row mt-4 justify-content-start">
        <div class="col-md-3 text-left">
            <label class="col-form-label">Semestre:</label>
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <!-- Opciones del combo box -->
                <option value="1">1</option>
                <option value="2">2</option>
                <!-- ... otras opciones ... -->
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
