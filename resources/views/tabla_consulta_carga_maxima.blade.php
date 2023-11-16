<div id="tablaCargaMaxima" class="container-fluid">
        <div class="table-responsive">
        <center><h2>Solicitudes de Carga Máxima</h2></center><br><br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID Solicitud</th>
                        <th scope="col">Fecha Solicitud</th>
                        <th scope="col">Semestre</th>
                        <th scope="col">Materias Reprobadas</th>
                        <th scope="col">Duración y Media</th>
                        <th scope="col">Fecha Impresión</th>
                        <th scope="col">Fecha y Hora Tutor</th>
                        <th scope="col">Estado Solicitud</th>
                        <th scope="col">Clave Única</th>
                        <th scope="col">RPE Tutor</th>
                        <th scope="col">RPE Staff</th>
                        <th scope="col">ID Sesión HCTC</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($solicitudesCargaMaxima) && (is_array($solicitudesCargaMaxima) || $solicitudesCargaMaxima instanceof Countable) && count($solicitudesCargaMaxima) > 0)
                        @foreach($solicitudesCargaMaxima as $solicitudCM)
                        <tr>
                            <td>{{ $solicitudCM->id_solicitud_cm }}</td>
                            <td>{{ $solicitudCM->fecha_solicitud }}</td>
                            <td>{{ $solicitudCM->semestre }}</td>
                            <td>{{ $solicitudCM->materias_reprobadas }}</td>
                            <td>{{ $solicitudCM->duracion_y_media }}</td>
                            <td>{{ $solicitudCM->fecha_impresion }}</td>
                            <td>{{ $solicitudCM->fecha_hora_tutor }}</td>
                            <td>{{ $solicitudCM->estado_solicitud }}</td>
                            <td>{{ $solicitudCM->clave_unica }}</td>
                            <td>{{ $solicitudCM->rpe_tutor }}</td>
                            <td>{{ $solicitudCM->rpe_staff }}</td>
                            <td>{{ $solicitudCM->id_sesion_hctc }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">No hay solicitudes disponibles</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>