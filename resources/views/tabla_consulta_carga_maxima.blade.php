<!-- Tabla carga maxima -->
<div class="mt-4">
    <table class="table">
        <thead class="thead-light">
            <tr class="text-center">
                <th>Folio</th>
                <th>Clave Única</th>
                <th>Tipo</th>              
                <th>Semestre</th>
                <th>Estado</th>
                <th>Aprobar</th>
                <th>Entregar</th>
                <th>Detalles</th>
                <th>Formato</th>
                <th>Cancelar</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($registros))
                @foreach ($registros as $item)
                    <tr class="text-center">
                        <td>{{ $item->id_solicitud_cm }}</td>
                        <td>{{ $item->clave_unica }}</td>
                        <td class="text-wrap" style="max-width: 200px;">
                            @if ($item->materias_reprobadas == true)
                                20 Materias Reprobadas<br>
                            @endif
                            @if ($item->duracion_y_media == true)
                                Duración y Media
                            @endif
                        </td>
                        <td>{{ $item->semestre }}</td>
                        <td>{{ $item->estado_solicitud }}</td>

                        @if($item->estado_solicitud != 'CANCELADA')
                            <td>
                                <form action="{{ route('autorizarCM', $item->id_solicitud_cm) }}" method="POST">
                                    @csrf
                                    <!-- Botón de Autorizar con modal -->
                                    <button type="button" class="btn btn-success confirm-action" data-toggle="modal" data-target="#confirmModalAutorizarCM" data-modal="confirmModalAutorizarCM" data-action="{{ route('autorizarCM', $item->id_solicitud_cm) }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('autorizarCM', $item->id_solicitud_cm) }}" method="POST">
                                    @csrf
                                    <!-- Botón de Autorizar con modal -->
                                    <button type="button" class="btn btn-success confirm-action" data-toggle="modal" data-target="#confirmModalAutorizarCM" data-modal="confirmModalAutorizarCM" data-action="{{ route('autorizarCM', $item->id_solicitud_cm) }}" disabled>
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        @endif

                        @if($item->estado_solicitud != 'CANCELADA')
                            <td>
                                <form action="{{ route('entregarCM', $item->id_solicitud_cm) }}" method="POST">
                                    @csrf
                                    <!-- Botón de Autorizar con modal -->
                                    <button type="button" class="btn btn-success confirm-action" data-toggle="modal" data-target="#confirmModalEntregarCM" data-modal="confirmModalEntregarCM" data-action="{{ route('entregarCM', $item->id_solicitud_cm) }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('entregarCM', $item->id_solicitud_cm) }}" method="POST">
                                    @csrf
                                    <!-- Botón de Autorizar con modal -->
                                    <button type="button" class="btn btn-success confirm-action" data-toggle="modal" data-target="#confirmModalEntregarCM" data-modal="confirmModalEntregarCM" data-action="{{ route('entregarCM', $item->id_solicitud_cm) }}" disabled>
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        @endif

                        <td>
                            <a href="{{ route('detallesCM', $item->id_solicitud_cm) }}" class="btn btn-info" style="text-decoration: none; color:white;">
                                <i class="fas fa-circle-info"></i>
                            </a>
                        </td>                        
                        <td class="text-center">
                            <a href="{{ route('cargaMaximaPdfPROVISIONAL.show', $item->id_solicitud_cm) }}" type="button" class="btn btn-primary btn-sm px-3 download-cm">
                                <i class="fas fa-file-arrow-down" style="color: white;"></i> </i>
                            </a>
                        </td>
                        @if($item->estado_solicitud != 'CANCELADA')
                            <td>
                                <form action="{{ route('cancelarCM', $item->id_solicitud_cm)}}" method="POST">
                                    @csrf
                                    <!-- Botón de Cancelar con modal -->
                                    <button type="button" class="btn btn-danger confirm-action" data-toggle="modal" data-target="#confirmModalCancelarCM" data-modal="confirmModalCancelarCM" data-action="{{ route('cancelarCM', $item->id_solicitud_cm) }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('cancelarCM', $item->id_solicitud_cm)}}" method="POST">
                                    @csrf
                                    <!-- Botón de Cancelar con modal -->
                                    <button type="button" class="btn btn-danger confirm-action" data-toggle="modal" data-target="#confirmModalCancelarCM" data-modal="confirmModalCancelarCM" data-action="{{ route('cancelarCM', $item->id_solicitud_cm) }}" disabled>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        @endif

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Modal de Confirmación para Autorizar CM -->
    <div class="modal fade" id="confirmModalAutorizarCM" tabindex="-1" role="dialog" aria-labelledby="confirmModalAutorizarCMLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalAutorizarCMLabel">Confirmación de Autorización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres AUTORIZAR la solicitud de Carga Máxima?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmActionAutorizarCM">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para entregar CM -->
    <div class="modal fade" id="confirmModalEntregarCM" tabindex="-1" role="dialog" aria-labelledby="confirmModalEntregarCMLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalEntregarCMLabel">Confirmación de Entrega</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres ENTREGAR la solicitud de Carga Máxima?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmActionEntregarCM">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Cancelar CM -->
    <div class="modal fade" id="confirmModalCancelarCM" tabindex="-1" role="dialog" aria-labelledby="confirmModalCancelarCMLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalCancelarCMLabel">Confirmación de Cancelación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres CANCELAR la solicitud de Carga Máxima?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmActionCancelarCM">Confirmar</button>
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

        $('#confirmActionCancelarCM').click(function () {
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

        $('#confirmActionAutorizarCM').click(function () {
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

        $('#confirmActionEntregarCM').click(function () {
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
