@extends('layouts.header')

@section('description')
<div class="text">
<div class="container-text">
    <p class="bold-text" >SISTEMA</p>
    <p class="bold-text">HCTC - ALUMNO</p>
</div>     
@endsection

@section('content')

    <h1 class="text-center mb-4" style="margin-left: 100px; margin-right: 100px; margin-top:50px;" >REGISTRO DE TEMA</h1>
    <p class="text-end" style="margin-left: 100px; margin-right: 100px;"><span id="currentDate"></span></p>
    <strong><p class="text-start" style="margin-left: 100px; margin-right: 100px;">H. CONSEJO TÉCNICO CONSULTIVO<br>DE LA FACULTAD DE INGENIERÍA<br>DE LA U. A. S. L. P.<br>PRESENTE</p></strong><br>

    <form id="registroForm" style="margin-left: 100px; margin-right: 100px;">
        <p class="mt-3">De la manera más atenta me dirijo a ustedes, solicitando autorización para desarrollar el Trabajo Recepcional previo a la presentación de mi Examen Profesional, con este fin proporciono los datos siguientes:</p>

        <div class="row mt-3">
            <div class="col-md-4">
                <label for="apellidoPaterno">Apellido Paterno:</label>
                <input type="text" id="apellidoPaterno" class="form-control" required placeholder="Apellido Paterno">
            </div>
            <div class="col-md-4">
                <label for="apellidoMaterno">Apellido Materno:</label>
                <input type="text" id="apellidoMaterno" class="form-control" required placeholder="Apellido Materno">
            </div>
            <div class="col-md-4">
                <label for="nombres">Nombre(s):</label>
                <input type="text" id="nombres" class="form-control" required placeholder="Nombre(s)">
            </div>
        </div>

        <div class="mt-3">
            <label for="domicilio">Domicilio:</label>
            <textarea id="domicilio" class="form-control" required placeholder="Escribe tu domicilio"></textarea>
        </div>

        <div class="mt-3">
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" class="form-control" required pattern="[0-9]{10}" placeholder="Escribe tu número de teléfono" minlength="10" maxlength="10" pattern="^\d+$" title="El teléfono debe de ser solo de 10 números">
        </div>

        <div class="mt-3">
            <label for="tema">Tema Propuesto:</label>
            <textarea id="tema" class="form-control" required placeholder="Escribe el tema propuesto"></textarea>
        </div>

        <div class="mt-3">
            <label for="asesor">Asesor Propuesto:</label>
            <input type="text" id="asesor" class="form-control" required placeholder="Nombre del asesor propuesto">
        </div>

        <div class="mt-3">
            <label for="coasesor">Co-Asesor Propuesto:</label>
            <input type="text" id="coasesor" class="form-control" required placeholder="Nombre del co-asesor propuesto">
        </div>

        <div class="mt-3">
            <label for="carrera">Carrera:</label>
            <input type="text" id="carrera" class="form-control" required placeholder="Escribe tu carrera">
        </div>

        <p class="text-center mt-3">ATENTAMENTE</p>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary mt-4">Enviar</button>
        </div>
    </form>

    <script>
        const currentDateElement = document.getElementById("currentDate");
        const currentDate = new Date();
        currentDateElement.textContent = currentDate.toLocaleDateString('es-MX', { day: '2-digit', month: 'long', year: 'numeric' });
    </script>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1do4A+gf8k5l7l4lMz4i3WDQn1Z7y/JonasIUNsobU+Kk8dDJIk5F5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@endsection