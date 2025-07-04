<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/registroExamen.css">
    <title>Registro de Servicios</title>
</head>
<body>
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <div class="container_padre">
    <form id="registro-form" method="POST" action="index.php?controller=controlCatalogoServicio&method=guardar">
    <section class="form_registro">
        <div class="form_header">
            <img src="Resources/images/pata.png" alt="pata" class="pata">
            <h2>Registro de Servicios</h2>
        </div>

        <input type="hidden" name="IdServicio" value="<?php echo isset($servicio->Id_Tipo_Servicio) ? $servicio->Id_Tipo_Servicio : ''; ?>">
        
        <label for="nombre_servicio">Nombre del servicio</label>
        <input class="controls" type="text" name="nombreServicio" id="nombre_servicio" placeholder="Nombre del servicio" required value="<?php echo isset($servicio->Nombre_Servicio) ? $servicio->Nombre_Servicio : ''; ?>">

        <label for="tiposervicio">Tipo de servicio</label>
        <select class="controls" name="TipoServicio" id="tiposervicio" required>
            <option value="">Seleccione el tipo de servicio</option>
            <option value="1" <?php echo isset($servicio->TipoServicio) && $servicio->TipoServicio == '1' ? 'selected' : ''; ?>>Consulta</option>
            <option value="2" <?php echo isset($servicio->TipoServicio) && $servicio->TipoServicio == '2' ? 'selected' : ''; ?>>Laboratorio</option>
            <option value="3" <?php echo isset($servicio->TipoServicio) && $servicio->TipoServicio == '3' ? 'selected' : ''; ?>>Peluquería</option>
        </select>

        <label for="precio_servicio">Precio</label>
        <input class="controls" type="text" name="precioServicio" id="precio_servicio" placeholder="Precio" required value="<?php echo isset($servicio->Precio_Servicio) ? $servicio->Precio_Servicio : ''; ?>">

        <label for="descripcion">Descripción</label>
        <textarea class="controls" name="descripcion" id="descripcion" placeholder="Descripción" required><?php echo isset($servicio->Descripcion) ? $servicio->Descripcion : ''; ?></textarea>
        
        <input class="butom" type="submit" value="Guardar">
    </section>
    </form>
    </div>
</body>
</html>