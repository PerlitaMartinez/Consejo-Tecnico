<!-- Tabla carga maxima -->
<div class="mt-4">
    <table class="table">
        <thead class="thead-light">
            <tr class="text-center">
                <th>Folio</th>
                <th>Clave Única</th>
                <th>Tipo</th>              
                <th>Semestre</th>
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
                                20 Materias Reprobadas
                            @endif
                            @if ($item->duracion_y_media == true)
                                Duración y Media
                            @endif

                        </td>
                        
                        <td>{{ $item->semestre }}</td>
                        <td><button class="btn btn-success"><i class="fas fa-check"></i></button></td>
                        <td><button class="btn btn-info"><i class="fas fa-circle-info"></i></button></td>
                        <td><button class="btn btn-primary"><i class="fas fa-file-arrow-down"></i></button></td>
                        <td><button class="btn btn-danger"><i class="fas fa-x"></i></button></td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>
