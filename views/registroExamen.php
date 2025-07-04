<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/css/registroExamen.css">
    <title>Registro De Examenes</title>

</head>
<body>
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <div class="container_padre">


    <form id="registro-form" method="POST" action="index.php?controller=controlExamen&method=guardar">
            <section class="form_registro">
                <div class="form_header">
                    <img src="Resources/images/pata.png" alt="pata" class="pata">
                    <h2>Registro de Examenes</h2>
                </div>
                <input type="hidden" name="Id_Tipo_examen" value="<?php echo isset($Examen->id_Tipo_Examen) ? $Examen->id_Tipo_Examen : ''; ?>">
                <input class="controls" type="text" name="Nombre_Examen" id="nombre_examen" placeholder="nombre del examen" required value="<?php echo isset($Examen->Nombre_Examen) ? $Examen->Nombre_Examen : ''; ?>">
                <input class="controls" type="text" name="Precio" id="precio" placeholder="precio" required value="<?php echo isset($Examen->Precio) ? $Examen->Precio : ''; ?>">
                <textarea class="controls" name="descripcion" id="descripcion" placeholder="descripcion" required><?php echo isset($Examen->descripcion) ? $Examen->descripcion : ''; ?></textarea>
                <input class="butom" type="submit" value="Registrar">
            </section>
        </form>
    </div>

</body>
</html>
