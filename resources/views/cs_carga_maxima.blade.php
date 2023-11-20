<div class="contenedor">
<div class="mt-4">
       <!-- Lista de radio buttons -->
    <div class="row mt-4 justify-content-start" >
        <div class="col-md-10">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="reprobadasRadio" id="reprobadasRadio1" checked>
                <label class="form-check-label" for="reprobadasRadio1">
                    Reprobé más de 20 materias
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="reprobadasRadio" id="reprobadasRadio2">
                <label class="form-check-label" for="reprobadasRadio2" tyle="height: 100%; width: 100%">
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
            <select class="form-control">
                <!-- Opciones del combo box -->
                <option value="1">1</option>
                <option value="2">2</option>
                <!-- ... otras opciones ... -->
            </select>
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
</style>