<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/css/registroCliente.css">
    <title>Registro de Cliente</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container_padre">
    <!-- Mensajes de Error y Éxito -->
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <form id="registro-form">
    <section class="form_registro">
    <div class="form_header">
        <h2>Registro de Cliente</h2>
    </div>
    <input type="hidden" name="idCliente" value="<?php echo isset($cliente->Id_Cliente) ? $cliente->Id_Cliente : ''; ?>">
    
    <label for="cedula">Cédula</label>
    <input class="controls" type="text" name="Cedula" id="cedula" placeholder="Cédula del Cliente" required value="<?php echo isset($cliente->{'Cédula'}) ? htmlspecialchars($cliente->{'Cédula'}, ENT_QUOTES, 'UTF-8') : ''; ?>">
    <label for="nombres">Nombre</label>
    <input class="controls" type="text" name="Nombre" id="nombres" placeholder="Nombre del Cliente" required value="<?php echo isset($cliente->Nombres) ? $cliente->Nombres : ''; ?>">
    
    <label for="apellido">Apellido</label>
    <input class="controls" type="text" name="Apellido" id="apellido" placeholder="Apellido del Cliente" required value="<?php echo isset($cliente->Apellidos) ? $cliente->Apellidos : ''; ?>">
    
    <label for="correo">Correo</label>
    <input class="controls" type="email" name="Correo" id="correo" placeholder="Correo del Cliente" required value="<?php echo isset($cliente->Correo) ? $cliente->Correo : ''; ?>">
    
    <label for="direccion">Dirección</label>
    <textarea class="direccion" name="direccion" id="direccion" placeholder="Ingrese dirección" required><?php echo isset($cliente->Direccion) ? $cliente->Direccion : ''; ?></textarea>    
    <input class="butom" type="submit" value="Registrar">
</section>`
    </form>
</div>

<script>
$(document).ready(function() {
    $("#registro-form").submit(function(event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "index.php?controller=controlCliente&method=guardar",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $("#error-message").text(response.error).fadeIn().delay(3000).fadeOut();
                    $("#success-message").hide();
                } else {
                    $("#success-message").text(response.success).fadeIn().delay(3000).fadeOut();
                    $("#error-message").hide();

                    // Limpiar los campos del formulario si es un nuevo registro
                    if (!$("#registro-form input[name='idCliente']").val()) {
                        $("#registro-form").trigger("reset");
                    }

                    // Redirigir si hay una URL de redirección en la respuesta
                    if (response.redirect) {
                        setTimeout(function() {
                            window.location.href = "index.php?controller=controlCliente&method=home";
                        }, 3000);
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                var errorMsg = "Error en la solicitud: " + textStatus + " - " + errorThrown;
                if (jqXHR.responseText) {
                    errorMsg += " - " + jqXHR.responseText;
                }
                $("#error-message").text(errorMsg).fadeIn().delay(3000).fadeOut();
                $("#success-message").hide();
            }
        });
    });
});


</script>

<style>
.error-message, .success-message {
    
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    font-weight: bold;
    display: none;
}

.error-message {
    color: #D8000C;
    background-color: #FFBABA;
    border: 1px solid #D8000C;
}

.success-message {
    color: #4F8A10;
    background-color: #DFF2BF;
    border: 1px solid #4F8A10;
}
</style>

</body>
</html>


