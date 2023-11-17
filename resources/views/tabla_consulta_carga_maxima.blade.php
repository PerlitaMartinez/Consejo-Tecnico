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

                        <td>
                            <form action="{{ route('autorizarCM', $item->id_solicitud_cm) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-success" value="Autorizar"><i class="fas fa-check"></i></button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('detallesCM', $item->id_solicitud_cm) }}" class="btn btn-info" style="text-decoration: none; color:white;">
                                <i class="fas fa-circle-info"></i>
                            </a>
                        </td>                        
                        <td><button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button></td>
                        <td>
                            <form action="{{ route('cancelarCM', $item->id_solicitud_cm)}}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-danger" value="Cancelar"><i class="fas fa-x"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>
