<!-- Tabla opcion titulación -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="mt-4">
    <table class="table">
        <thead class="thead-light">
            <tr class="text-center">
                <th>Folio</th>
                <th>Tipo</th>
                <th>Clave Única</th>
                <th>Semestre</th>
                <th>Estado</th>
                <th>Aprobar</th>
                <th>Detalles</th>
                <th>Formato</th>
                <th>Cancelar</th>
            </tr>
        </thead>

        <tbody>
            @if (isset($registros))
                @foreach ($registros as $item)
                    <tr class="text-center">
                        <td>{{ $item->id_solicitud_OT }}</td>
                        <td style="max-width: 150px;">{{ $item->opcion_titulacion }}</td>
                        <td>{{ $item->clave_unica }}</td>
                        <td>{{ $item->semestre }}</td>
                        <td>{{ $item->estado_solicitud }}</td>

                        <td>
                            <form action="{{ route('autorizarOT', $item->id_solicitud_OT) }}" method="POST">
                                @csrf
                                <!-- Botón de Autorizar con modal -->
                                <button type="button" class="btn btn-success confirm-action" data-toggle="modal" data-target="#confirmModalAutorizarOT" data-modal="confirmModalAutorizarOT" data-action="{{ route('autorizarOT', $item->id_solicitud_OT) }}">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('detallesOT', $item->id_solicitud_OT) }}" class="btn btn-info" style="text-decoration: none; color:white;">
                                <i class="fas fa-circle-info"></i>
                            </a>
                        </td>
                        <td>
                            @if (
                            $item->opcion_titulacion == 'Trabajo Recepcional' ||
                            $item->opcion_titulacion == 'Tesis' ||
                            $item->opcion_titulacion == 'Memorias de Actividad Profesional')
                                <button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button>
                                <button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button>
                                <button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button>
                            @else
                                <button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('cancelarOT', $item->id_solicitud_OT) }}" method="POST">
                                @csrf
                                <!-- Botón de Cancelar con modal -->
                                <button type="button" class="btn btn-danger confirm-action" data-toggle="modal" data-target="#confirmModalCancelarOT" data-modal="confirmModalCancelarOT" data-action="{{ route('cancelarOT', $item->id_solicitud_OT) }}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Modal de Confirmación para Autorizar OT -->
    <div class="modal fade" id="confirmModalAutorizarOT" tabindex="-1" role="dialog" aria-labelledby="confirmModalAutorizarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalAutorizarOTLabel">Confirmación de Autorización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres AUTORIZAR la solicitud de Opción de Titulación?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmActionAutorizarOT">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Cancelar OT -->
    <div class="modal fade" id="confirmModalCancelarOT" tabindex="-1" role="dialog" aria-labelledby="confirmModalCancelarOTLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalCancelarOTLabel">Confirmación de Cancelación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres CANCELAR la solicitud de Opción de Titulación?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmActionCancelarOT">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.confirm-action').click(function () {
            var action = $(this).data('action');
            var modalId = $(this).data('modal');

            // Setea la acción en el botón de confirmación correspondiente
            $('#' + modalId).find('.btn-primary').data('action', action);

            // Muestra el modal correspondiente
            $('#' + modalId).modal('show');
        });

        $('#confirmActionCancelarOT').click(function () {
            var action = $(this).data('action');

            // Crear un formulario dinámicamente
            var form = $('<form method="POST" action="' + action + '"></form>');
            $('body').append(form);

            // Agregar el token CSRF al formulario (si es necesario)
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (csrfToken) {
                form.append('<input type="hidden" name="_token" value="' + csrfToken + '">');
            }

            // Enviar el formulario
            form.submit();
        });

        $('#confirmActionAutorizarOT').click(function () {
            // Agregar la lógica de autorización aquí si es necesario
            var action = $(this).data('action');

            // Crear un formulario dinámicamente
            var form = $('<form method="POST" action="' + action + '"></form>');
            $('body').append(form);

            // Agregar el token CSRF al formulario (si es necesario)
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (csrfToken) {
                form.append('<input type="hidden" name="_token" value="' + csrfToken + '">');
            }

            // Enviar el formulario
            form.submit();
        });
    });
</script>