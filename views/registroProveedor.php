<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <<link rel="stylesheet" href="resources/css/registroExamen.css">
    <title>Registro De Proveedores</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <div class="container_padre">


        <form id="registro-form" method="POST" action="index.php?controller=controlProveedor&method=guardar">
            <section class="form_registro">
                <div class="form_header">
                    <img src="Resources/images/pata.png" alt="pata" class="pata">
                    <h2>Registro de Proveedores</h2>
                </div>
                <input type="hidden" name="idProveedor" value="<?php echo isset($proveedor->Id_Proveedor) ? $proveedor->Id_Proveedor : ''; ?>">
                <input class="controls" type="text" name="Nombre_Proveedor" id="nombre_proveedor" placeholder="Nombre del Proveedor" required value="<?php echo isset($proveedor->Nombre_Proveedor) ? $proveedor->Nombre_Proveedor : ''; ?>">
                <input class="controls" type="text" name="Contacto" id="contacto" placeholder="Nombre del Contacto" required value="<?php echo isset($proveedor->Contacto) ? $proveedor->Contacto : ''; ?>">
                <input class="controls" type="tel" name="Telefono" id="telefono" placeholder="Teléfono" required value="<?php echo isset($proveedor->Telefono) ? $proveedor->Telefono : ''; ?>">
                <input class="controls" type="email" name="Correo" id="correo" placeholder="Correo" value="<?php echo isset($proveedor->Correo) ? $proveedor->Correo : ''; ?>">
                <input class="butom" type="submit" value="Registrar">
            </section>
        </form>
    </div>

</body>
</html>
