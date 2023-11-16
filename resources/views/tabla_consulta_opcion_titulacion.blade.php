<div id="tablaOpcionTitulacion" class="container-fluid">
        <center><h2>Solicitudes de Opción de Titulación</h2></center><br><br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID Solicitud</th>
                        <th scope="col">Fecha Solicitud</th>
                        <th scope="col">Semestre</th>
                        <th scope="col">Fecha y Hora Coordinador</th>
                        <th scope="col">Fecha Impresión</th>
                        <th scope="col">Estado Solicitud</th>
                        <th scope="col">Clave Única</th>
                        <th scope="col">RPE Staff</th>
                        <th scope="col">RPE Coordinador</th>
                        <th scope="col">ID Opción Titulación</th>
                        <th scope="col">ID Sesión HCTC</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($solicitudesOpcionTitulacion) && (is_array($solicitudesOpcionTitulacion) || $solicitudesOpcionTitulacion instanceof Countable) && count($solicitudesOpcionTitulacion) > 0)
                        @foreach($solicitudesOpcionTitulacion as $solicitudOT)
                        <tr>
                            <td>{{ $solicitudOT->id_solicitud_OT }}</td>
                            <td>{{ $solicitudOT->fecha_solicitud }}</td>
                            <td>{{ $solicitudOT->semestre }}</td>
                            <td>{{ $solicitudOT->fecha_hora_coordinador }}</td>
                            <td>{{ $solicitudOT->fecha_impresion }}</td>
                            <td>{{ $solicitudOT->estado_solicitud }}</td>
                            <td>{{ $solicitudOT->clave_unica }}</td>
                            <td>{{ $solicitudOT->rpe_staff }}</td>
                            <td>{{ $solicitudOT->rpe_coordinador }}</td>
                            <td>{{ $solicitudOT->id_opcion_titulacion }}</td>
                            <td>{{ $solicitudOT->id_sesion_hctc }}</td>
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