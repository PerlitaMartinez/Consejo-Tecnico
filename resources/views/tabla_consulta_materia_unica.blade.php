<!-- Tabla materia unica -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="mt-4">
    <table class="table">
        <thead class="thead-light">
            <tr class="text-center">
                <th>Folio</th>
                <th>Clave Única</th>
                <th>Materia</th>
                <th>Semestre</th>
                <th>Estado</th>
                <th>Aprobar</th>
                <th>Detalles</th>
                <th>Formato</th>
                <th>Cancelar</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($registros))
            @foreach ($registros as $item)
                <tr class="text-center">
                    <td>{{$item['id_solicitud_mu']}}</td>
                    <td>{{$item['clave_unica']}}</td>
                    <td>{{ $item['materia'] }}</td>
                    <td>{{ $item['semestre'] }}</td>   
                    <td>{{ $item['estado_solicitud'] }}</td>                    
                    <td>
                        <form action="{{ route('autorizarMU', $item['id_solicitud_mu']) }}" method="POST">
                        @csrf
                        <!-- Botón de Autorizar -->
                            <button type="button" class="btn btn-success confirm-action" data-toggle="modal" data-target="#confirmModalAutorizar" data-modal="confirmModalAutorizar" data-action="{{ route('autorizarMU', $item['id_solicitud_mu']) }}">
                                <i class="fas fa-check"></i>
                            </button>                       
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('detallesMU', ['id' => $item['id_solicitud_mu']]) }}" class="btn btn-info" style="text-decoration: none; color:white;">
                            <i class="fas fa-circle-info"></i>
                        </a>
                    </td>
                    <td>
                        <a id="{{ $item['id_solicitud_mu'] }}" type="button" class="btn btn-primary btn-sm px-3 download-mu">
                            <i class="fas fa-file-arrow-down" style="color: white;"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('cancelarMU', $item['id_solicitud_mu']) }}" method="POST">
                        @csrf
                            <!-- Botón de Cancelar -->
                            <button type="button" class="btn btn-danger confirm-action" data-toggle="modal" data-target="#confirmModalCancelar" data-modal="confirmModalCancelar" data-action="{{ route('cancelarMU', $item['id_solicitud_mu']) }}">
                                <i class="fas fa-times"></i>
                            </button>                        
                        </form>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <!-- Modal de Confirmación para Autorizar -->
    <div class="modal fade" id="confirmModalAutorizar" tabindex="-1" role="dialog" aria-labelledby="confirmModalAutorizarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalAutorizarLabel">Confirmación de Autorización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres AUTORIZAR la solicitud de Materia Única?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmActionAutorizar">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Cancelar -->
    <div class="modal fade" id="confirmModalCancelar" tabindex="-1" role="dialog" aria-labelledby="confirmModalCancelarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalCancelarLabel">Confirmación de Cancelación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres CANCELAR la solicitud de Materia Única?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmActionCancelar">Confirmar</button>
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

        $('#confirmActionCancelar').click(function () {
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

        $('#confirmActionAutorizar').click(function () {
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
