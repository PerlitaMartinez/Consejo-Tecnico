<div id="tablaMateriaUnica" class="container-fluid">
        <br><br><center><h2>Solicitudes de Materia Única</h2></center><br><br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID Solicitud</th>
                        <th scope="col">Fecha Solicitud</th>
                        <th scope="col">Semestre</th>
                        <th scope="col">Fecha Impresión</th>
                        <th scope="col">Fecha y Hora Tutor</th>
                        <th scope="col">Estado Solicitud</th>
                        <th scope="col">Clave Única</th>
                        <th scope="col">RPE Tutor</th>
                        <th scope="col">RPE Staff</th>
                        <th scope="col">ID Sesión HCTC</th>
                        <th scope="col">Clave Materia</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($solicitudesMateriaUnica) && (is_array($solicitudesMateriaUnica) || $solicitudesMateriaUnica instanceof Countable) && count($solicitudesMateriaUnica) > 0)
                    @foreach($solicitudesMateriaUnica as $solicitudMU)
                        <tr>
                            <td>{{ $solicitudMU->id_solicitud_mu }}</td>
                            <td>{{ $solicitudMU->fecha_solicitud }}</td>
                            <td>{{ $solicitudMU->semestre }}</td>
                            <td>{{ $solicitudMU->fecha_impresion }}</td>
                            <td>{{ $solicitudMU->fecha_hora_tutor }}</td>
                            <td>{{ $solicitudMU->estado_solicitud }}</td>
                            <td>{{ $solicitudMU->clave_unica }}</td>
                            <td>{{ $solicitudMU->rpe_tutor }}</td>
                            <td>{{ $solicitudMU->rpe_staff }}</td>
                            <td>{{ $solicitudMU->id_sesion_hctc }}</td>
                            <td>{{ $solicitudMU->clave_materia }}</td>
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