<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/css/registroExamen.css"> 
    <title>Registro De Razas</title>
</head>
<body>
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <div class="container_padre">
        <form id="registro-form" method="POST" action="index.php?controller=controlRaza&method=guardar">
            <section class="form_registro">
                <div class="form_header">
                    <img src="Resources/images/pata.png" alt="pata" class="pata">
                    <h2>Registro de Raza</h2>
                </div>
                <input type="hidden" name="Id_Raza" value="<?php echo isset($raza->Id_Raza) ? $raza->Id_Raza : ''; ?>">
                
                <label for="id_especie">Especie:</label>
                <select class="controls"  name="Id_Especie" id="id_especie" required>
                    <option value="">Seleccione una especie</option>
                    <?php
                    // Aquí se cargan las especies desde el controlador
                    foreach ($especies as $especie) {
                        $selected = (isset($raza->Id_Especie) && $raza->Id_Especie == $especie->Id_Especie) ? 'selected' : '';
                        echo "<option value='{$especie->Id_Especie}' $selected>{$especie->Nombre_Especie}</option>";
                    }
                    ?>
                </select>
                <label>Nombre de la Raza</label>
                <input class="controls" type="text" name="Nombre_Raza" id="nombre_raza" placeholder="Nombre de la raza" required value="<?php echo isset($raza->Nombre_Raza) ? $raza->Nombre_Raza : ''; ?>">
                <input class="butom" type="submit" value="Registrar">
            </section>
        </form>
    </div>

</body>
</html>