<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/css/registroExamen.css">
    <title>Registro De Especies</title>

</head>
<body>
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <div class="container_padre">


    <form id="registro-form" method="POST" action="index.php?controller=controlEspecie&method=guardar">
            <section class="form_registro">
                <div class="form_header">
                    <img src="Resources/images/pata.png" alt="pata" class="pata">
                    <h2>Registro de Especie</h2>
                </div>
                <input type="hidden" name="Id_Tipo_especie" value="<?php echo isset($especie->Id_Especie) ? $especie->Id_Especie : ''; ?>">
                <input class="controls" type="text" name="Nombre_Especie" id="nombre_especie" placeholder="nombre de la especie" required value="<?php echo isset($especie->Nombre_Especie) ? $especie->Nombre_Especie : ''; ?>">
                <input class="butom" type="submit" value="Registrar">
            </section>
        </form>
    </div>

</body>
</html>
