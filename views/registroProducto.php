<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/registroProducto.css">
    <title>Registro De Productos</title>
</head>
<body>
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <div class="container_padre">
        <form id="registro-form" action="index.php?controller=controlProducto&method=guardar" method="POST">
            <section class="form_registro">
                <div class="form_header">
                    <img src="resources/images/pata.png" alt="pata" class="pata">
                    <h2>Registro de Productos</h2>
                </div>

                <input type="hidden" name="idProducto" value="<?php echo isset($producto->Id_Producto) ? htmlspecialchars($producto->Id_Producto) : ''; ?>">

                <label for="nombre_producto">Nombre del Producto</label>
                <input class="controls" type="text" name="Nombre_Producto" id="nombre_producto" placeholder="Nombre del Producto" required value="<?php echo isset($producto->Nombre_Producto) ? htmlspecialchars($producto->Nombre_Producto) : ''; ?>">

                <label for="descripcion">Descripción del Producto</label>
                <textarea class="controls" name="Descripcion" id="descripcion" placeholder="Descripción del Producto" required><?php echo isset($producto->Descripcion) ? htmlspecialchars($producto->Descripcion) : ''; ?></textarea>

                <label for="precio">Precio</label>
                <input class="controls" type="number" step="0.01" name="Precio" id="precio" placeholder="Precio" required value="<?php echo isset($producto->Precio) ? htmlspecialchars($producto->Precio) : ''; ?>">

                <label for="cantidad_stock">Cantidad en Stock</label>
                <input class="controls" type="number" name="Cantidad_Stock" id="cantidad_stock" placeholder="Cantidad en Stock" required value="<?php echo isset($producto->Cantidad_Stock) ? htmlspecialchars($producto->Cantidad_Stock) : ''; ?>">

                <label for="id_proveedor">Proveedor</label>
                <label for="Id_Proveedor">Proveedor:</label>
<select class="controls" name="Id_Proveedor" id="Id_Proveedor" required>
    <option value="">Seleccione un proveedor</option>
    <?php
    // Asegúrate de que $proveedores sea la variable correcta que viene del controlador
    // Si $proveedores no está vacía y es iterable, recorre los proveedores
    if (isset($proveedores) && is_array($proveedores) && !empty($proveedores)) {
        foreach ($proveedores as $prov) {
            $selected = '';
            // Si estamos editando un producto y su Id_Proveedor coincide con el proveedor actual, lo seleccionamos
            if (isset($producto) && $producto->Id_Proveedor == $prov->Id_Proveedor) {
                $selected = 'selected';
            }
            echo "<option value='{$prov->Id_Proveedor}' {$selected}>{$prov->Nombre_Proveedor}</option>";
        }
    } else {
        echo "<option value=''>No hay proveedores registrados</option>";
    }
    ?>
</select>

                <input class="butom" type="submit" value="Registrar">
            </section>
        </form>
    </div>
</body>

</html>