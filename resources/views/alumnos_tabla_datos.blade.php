{{-- <link rel="stylesheet" href="{{ asset('assets/stylesForms.css') }}"> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">


<div style="display: flex; justify-content: center;">
    <div style="background-color: #B0E0E6;  text-align: right; padding: 5px; width: 190px; height: 130px;">
        <ul style="list-style: none; color: #004a98;">
            <li>Clave única</li>
            <li>Nombre</li>
            <li>Carrera</li>
            <li>Tutor académico</li>
            <li>Coordinador</li>
        </ul>
    </div>
    <div style="background-color: #dfecde; width: 480px; height: 130px;">
        <ul style="list-style: none;  padding: 5px 5px 5px 5px; color: #0d2607;">
            <li>
                @if (isset($infoAlumno))
                    {{ $infoAlumno['clave_unica'] }}
                @else
                    --
                @endif
            </li>
            <li>
                @if (isset($infoAlumno))
                    {{ $infoAlumno['nombre_alumno'] }}
                @else
                    --
                @endif
            </li>
            <li>
                @if (isset($infoAlumno))
                    {{ $infoAlumno['nombre_carrera'] }}
                @else
                    --
                @endif
            </li>
            <li>
                @if (isset($infoAlumno))
                    {{ $infoAlumno['nombre_tutor'] }}
                @else
                    --
                @endif
            </li>
            <li>
                @if (isset($infoAlumno))
                    {{ $infoAlumno['nombre_coordinador'] }}
                @else
                    --
                @endif
            </li>
        </ul>
    </div>

</div>

