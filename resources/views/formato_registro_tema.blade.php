@extends('layouts.header')

@section('content')

    {{-- @include('usuario_cinta') --}}

    <div class="container">
                <h1>Registro de Tema</h1>

                <br>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Domicilio </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Teléfono </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Tema propuesto </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Asesor propuesto </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>

<div class="row">
    <div class="col-md-10" >
        <div class="form-group d-flex align-items-center">
            <input type="checkbox" id="tiene-coasesor" class="mr-2" onchange="mostrarCoAsesor()">
            <label for="semestre" style="white-space: nowrap; width: auto;">Tiene co-asesor</label>
        </div>
    </div>
</div>

<div class="row" id="coasesor-section" style="display: none;">
    <div class="col-md-10">
        <div class="form-group d-flex">
            <label for="semestre" class="mr-2" style="">Co-Asesor Propuesto</label>
            <input type="text" id="coasesor" class="form-control">
        </div>
    </div>
</div>

                <br>

                <div class="form-group">
                    <button class="btn btn-primary mr-2" id="registrar-solicitud">Registrar Solicitud</button>
                    <form id="formulario" method="GET" action="{{ route('materiaUnicaPdf.show') }}" target="_blank">
                    <button class="btn btn-success" id="descargar-formato">Descargar Formato</button>
                    </form>
                </div>
            
       

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
        width: 250px;
        text-align: right;
    }

    #tiene-coasesor{
        width: 200px;
        align-self: flex-center;
    }

</style>

<script>
    // Agrega un cuadro de diálogo de confirmación al botón "Registrar Solicitud"
    document.getElementById('registrar-solicitud').addEventListener('click', function() {
        if (confirm('¿Estás seguro(a) de que deseas registrar la solicitud?')) {
            // código para registrar la solicitud si se hace clic en "Aceptar"
        }
    });

    // Agrega un cuadro de diálogo de confirmación al botón "Descargar Formato"
    document.getElementById('descargar-formato').addEventListener('click', function() {
        if (confirm('¿Estás seguro(a) de que deseas descargar el formato?')) {
            // código para descargar el formato si se hace clic en "Aceptar"
            document.getElementById('formulario').submit();
        }
    });

    function mostrarCoAsesor() {
        const checkbox = document.getElementById('tiene-coasesor');
        const coasesorSection = document.getElementById('coasesor-section');

        if (checkbox.checked) {
            coasesorSection.style.display = 'block';
        } else {
            coasesorSection.style.display = 'none';
        }
    }
</script>

@endsection
