<hr style="border: 0px solid #DCDCDC; margin: 10px 0;">

<div style="display: flex; justify-content: center;">
    <div style="background-color: #B0E0E6; text-align: right; padding: 5px; width: 160px; height: 77px;">
        <ul style="list-style: none; color: #004a98;">
            <li>RPE</li>
            <li>Nombre</li>
            <li>Rol</li>
        </ul>
    </div>
    <div id="rol-actual" style="background-color: #dfecde; padding: 5px; width: 480px; height: 77px;">
        <ul style="list-style: none; color: #0d2607;">
            <li>039999</li>
            <li>PATERNO MATERNO NOMBRES</li>
            <li> <span id="rol-actual-value"> </span></li>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un rol almacenado en la sesión
        var rolAlmacenado = sessionStorage.getItem('rolActual');
        
        if (rolAlmacenado) {
            document.getElementById('rol-actual-value').innerText = rolAlmacenado;
        }
    });

</script>