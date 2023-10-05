<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el valor de la opción de titulación seleccionada
    $opcionTitulacion = $_POST['opcionTitulacion'];
    
    // Verificar que se haya seleccionado una opción
    if (empty($opcionTitulacion)) {
        echo "<div class='alert alert-danger mt-3'>Debe seleccionar una opción de titulación.</div>";
    } else {
        // Aquí puedes procesar la solicitud y guardar los datos en tu base de datos o realizar otras acciones necesarias.
        // Luego puedes redirigir al usuario a una página de confirmación o agradecimiento.
        // Por ejemplo:
        // header("Location: confirmacion.php");
        // exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>SOLICITUD DE OPCIÓN DE TITULACIÓN</title>
</head>
<body class="container" style="margin: 100px;">

    <h1 class="text-center mb-4">SOLICITUD DE OPCIÓN DE TITULACIÓN</h1>
    <p class="text-end"><span id="currentDate"></span></p>
    <strong><p class="text-start">H. CONSEJO TÉCNICO CONSULTIVO<br>DE LA FACULTAD DE INGENIERÍA<br>DE LA U. A. S. L. P.<br>PRESENTE</p></strong><br>

    <form id="solicitudForm" method="post">
        <p class="mt-3">De la manera más atenta me dirijo a ese H. Cuerpo Colegiado para solicitar autorización para titularme de Ingeniero 
        <input type="text" class="form-control d-inline-block w-auto" required placeholder="Especialidad"> mediante la opción:</p>

        <div class="mt-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="trabajoRecepcional" id="trabajoRecepcional">
                <label class="form-check-label" for="trabajoRecepcional">Trabajo Recepcional</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="opcionTitulacion" value="examenConocimientos" id="examenConocimientos">
                <label class="form-check-label" for="examenConocimientos">Examen de Conocimientos con Duración de 8 horas</label>
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
            <!-- Repite el mismo patrón para los otros elementos form-check -->
        </div>

        <p class="mt-3">Agradezco la atención que se sirvan dar a la presente.</p>

        <p class="mt-3">Datos del solicitante.</p>

        <div class="mt-3">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" class="form-control" required placeholder="Escribe tu nombre completo">
        </div>

        <div class="mt-3">
            <label for="claveUnica">Clave única:</label>
            <input type="number" id="claveUnica" class="form-control" required maxlength="6" placeholder="Escribe tu clave única">
        </div>

        <div class="mt-3">
            <label for="fechaExamen">Fecha del examen en que aprobó su última materia:</label>
            <input type="date" id="fechaExamen" class="form-control" required>
        </div>

        <div class="mt-3">
            <label for="promedio">Promedio general aprobatorio:</label>
            <input type="number" id="promedio" class="form-control" required step="0.01" placeholder="Escribe tu promedio">
        </div>

        <div class="mt-3">
            <label for="anioIngreso">Año de ingreso a la licenciatura:</label>
            <input type="text" id="anioIngreso" class="form-control" required placeholder="Escribe el año de ingreso">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-4">Enviar</button>
        </div>
    </form>

    <!-- Script para mostrar la fecha actual -->
    <script>
        const currentDateElement = document.getElementById("currentDate");
        const currentDate = new Date();
        currentDateElement.textContent = currentDate.toLocaleDateString('es-MX', { day: '2-digit', month: 'long', year: 'numeric' });
    </script>

    <!-- Bootstrap JS, Popper.js, y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1do4A+gf8k5l7l4lMz4i3WDQn1Z7y/JonasIUNsobU+Kk8dDJIk5F5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
