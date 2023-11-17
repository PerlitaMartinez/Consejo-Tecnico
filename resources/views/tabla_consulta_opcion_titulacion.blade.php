 <!-- Tabla opcion titulación -->
 <div class="mt-4">
     <table class="table">
         <thead class="thead-light">
             <tr class="text-center">
                 <th>Folio</th>
                 <th>Tipo</th>
                 <th>Clave Única</th>
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
                         <td>{{ $item->id_solicitud_OT }}</td>
                         <td style="max-width: 150px;">{{ $item->opcion_titulacion }}</td>
                         <td>{{ $item->clave_unica }}</td>
                         <td>{{ $item->semestre }}</td>
                         <td><button class="btn btn-success"><i class="fas fa-check"></i></button></td>
                         <td><button class="btn btn-info"><i class="fas fa-circle-info"></i></button></td>
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
                         <td><button class="btn btn-danger"><i class="fas fa-x"></i></button></td>
                     </tr>
                 @endforeach
             @endif
         </tbody>
     </table>
 </div>
