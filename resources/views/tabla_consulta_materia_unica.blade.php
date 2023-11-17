<!-- Tabla materia unica -->

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
                            <button type="submit" class="btn btn-success" value="Autorizar"><i class="fas fa-check"></i></button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('detallesMU', ['id' => $item['id_solicitud_mu']]) }}" class="btn btn-info" style="text-decoration: none; color:white;">
                            <i class="fas fa-circle-info"></i>
                        </a>
                    </td>
                    <td >
                        <a id="{{ $item['id_solicitud_mu'] }}" type="button"
                            class="btn btn-primary btn-sm px-3 download-mu">
                            <i class="fas fa-file-arrow-down" style="color: white;"></i> </i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('cancelarMU', $item['id_solicitud_mu']) }}" method="POST">
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
