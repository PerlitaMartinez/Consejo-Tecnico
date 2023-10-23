@extends('layouts.header')

@section('content')

{{-- @include('usuario_cinta') --}}

<div class="container">
        <h1>Registro de Tema y Temario Memorias de Actividad Profesional</h1>

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
                            <label for="semestre" class="mr-2" style="">Asesor Propuesto</label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group d-flex">
                            <label for="semestre" class="mr-2" style="">Tema Propuesto </label>
                            <input type="text" id="promedio" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-10">
        <div class="form-group d-flex">
            <label for="temario" class="mr-2" style="">Temario Propuesto</label>
        </div>
    </div>
</div>

<div class="col-md-10">
    <div class="form-group d-flex">
        <label for="temario" class="mr-2" style="">Tema</label>
        <input type="text" id="temario" class="form-control">
        <button id="agregar-tema" class="btn btn-primary ml-2 agregar-btn">+</button>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="form-group d-flex">
            <label for="semestre" class="mr-2" style=""></label>
            <ul id="temas-ingresados"></ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="form-group d-flex">
            <label for="semestre" class="mr-2" style=""></label>
            <button id="editar-tema" class="btn btn-primary ml-2" style="display: none;">Editar Tema</button>
            <button id="eliminar-tema" class="btn btn-danger ml-2" style="display: none;">Eliminar Tema</button>
        </div>
    </div>
</div>

                <br>

                
</div>

<style>
    .container {
        margin-top: 35px;
        max-width: 70%;
    }

    .form-group {
        display: flex;
        align-items: flex-end;
    }

    .form-group label {
        white-space: nowrap;
        width: 220px;
        text-align: right;
    }

    #temas-ingresados li {
    cursor: pointer;
    padding: 5px;
    transition: background-color 0.3s; /* Agrega una transición suave al cambio de color de fondo */
    list-style: decimal; /* Establece el tipo de viñeta (puedes personalizarlo según tus preferencias) */
    margin-left: 10px; /* Añade margen a la izquierda para separar la viñeta del texto */
    }

    #temas-ingresados li.selected {
        background-color: #00b2e3;
        color: white;
        border-radius: 5px;
    }

    #temas-ingresados li:hover {
        background-color: #00b2e3;
        color: white;
        border-radius: 5px;
    }

    .agregar-btn {
    display: inline-block; /* Establece la visualización en "inline-block" */
    width: auto; /* Ajusta el ancho si es necesario */
}
</style>


<<script>
    $(document).ready(function() {
        var temas = [];
        var temaSeleccionado = null;

        // Agregar un tema cuando se haga clic en el botón "Agregar Tema"
        $("#agregar-tema").click(function() {
            var tema = $("#temario").val();
            if (tema !== "") {
                temas.push(tema);
                mostrarTemas();
                $("#temario").val(""); // Limpiar el campo de entrada
            }
        });

        // Mostrar temas y habilitar la selección de temas
        function mostrarTemas() {
            $("#temas-ingresados").empty(); // Limpiar la lista de temas

            for (var i = 0; i < temas.length; i++) {
                var listItem = $("<li data-index='" + i + "'>" + temas[i] + "</li>");
                $("#temas-ingresados").append(listItem);
            }

            // Habilitar la selección de temas
            $("#temas-ingresados li").click(function() {
                var index = $(this).data("index");

                // Quitar la clase 'selected' de todos los elementos
                $("#temas-ingresados li").removeClass("selected");

                // Agregar la clase 'selected' al elemento seleccionado
                $(this).addClass("selected");

                temaSeleccionado = index;
                mostrarBotonesEditarEliminar();
            });

            // Controlador de clic en el documento para deseleccionar al hacer clic en otro lugar
            $(document).click(function(event) {
                if (!$(event.target).closest("#temas-ingresados").length) {
                    // Hacer clic fuera de la lista de temas
                    $("#temas-ingresados li").removeClass("selected");
                    temaSeleccionado = null;
                    mostrarBotonesEditarEliminar();
                }
            });
        }

        // Mostrar botones "Editar" y "Eliminar" cuando se selecciona un tema
        function mostrarBotonesEditarEliminar() {
            if (temaSeleccionado !== null) {
                $("#editar-tema").show();
                $("#eliminar-tema").show();
            } else {
                $("#editar-tema").hide();
                $("#eliminar-tema").hide();
            }
        }

        // Botón "Editar Tema"
        $("#editar-tema").click(function() {
            var nuevoNombre = prompt("Editar tema:", temas[temaSeleccionado]);
            if (nuevoNombre !== null) {
                temas[temaSeleccionado] = nuevoNombre;
                mostrarTemas();
                temaSeleccionado = null;
                mostrarBotonesEditarEliminar();
            }
        });

        // Botón "Eliminar Tema"
        $("#eliminar-tema").click(function() {
            var confirmar = confirm("¿Estás seguro de que deseas eliminar este tema?");
            if (confirmar) {
                temas.splice(temaSeleccionado, 1);
                mostrarTemas();
                temaSeleccionado = null;
                mostrarBotonesEditarEliminar();
            }
        });
    });
</script>


@endsection