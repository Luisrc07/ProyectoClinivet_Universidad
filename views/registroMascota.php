<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/registroMascota.css">
    <title>Registro de Mascota</title>
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
                <img src="Resources/images/pata.png" alt="pata" class="pata">
                <h2>Registro de Mascota</h2>
            </div>
            <div class="selec_id">
                <input type="hidden" name="idMascota" value="<?php echo isset($mascota->Id_Mascota) ? $mascota->Id_Mascota : ''; ?>" id="idMascota">

                <label for="idcliente">Cliente</label>
                <select class="controls" name="idCliente" id="idcliente" required>
                    <option value="">Seleccione Cliente</option>
                    <?php 
                    foreach ($clientes as $cliente) { 
                        echo "<option value='{$cliente->Id_Cliente}'" . (isset($mascota->Id_Cliente) && $mascota->Id_Cliente == $cliente->Id_Cliente ? ' selected' : '') . ">{$cliente->Nombres} {$cliente->Apellidos}</option>";
                    } 
                    ?>    
                </select>

                <label for="nombre">Nombre de la Mascota</label>
                <input class="controls" type="text" name="nombreMascota" id="nombre" placeholder="Nombre de la Mascota" value="<?php echo isset($mascota->Nombre_Mascota) ? $mascota->Nombre_Mascota : ''; ?>" required>
                
                <label for="especie">Especie</label>
                <select class="controls" name="Especie" id="especie" required>
                    <option value="">Seleccione Especie</option>
                    <?php
                    foreach ($especies as $especie) {
                        echo "<option value='{$especie->Id_Especie}'" . (isset($mascota->Id_Especie) && $mascota->Id_Especie == $especie->Id_Especie ? ' selected' : '') . ">{$especie->Nombre_Especie}</option>";
                    }
                    ?>
                </select>

                <label for="raza">Raza</label>
                <select class="controls" name="Raza" id="raza" required>
                    <option value="">Seleccione Raza</option>
                    <?php
                    foreach ($razas as $raza) {
                        echo "<option value='{$raza->Id_Raza}'" . (isset($mascota->Id_Raza) && $mascota->Id_Raza == $raza->Id_Raza ? ' selected' : '') . ">{$raza->Nombre_Raza}</option>";
                    }
                    ?>
                </select>
                
                <label>Sexo</label> 
                <div class="genero_cont">
                    <input id="sexo-macho" type="radio" name="sexo" value="macho" <?php echo (isset($mascota->Sexo) && $mascota->Sexo == 'macho') ? 'checked' : ''; ?>> 
                    <label for="sexo-macho">Macho</label> 
                    <input id="sexo-hembra" type="radio" name="sexo" value="hembra" <?php echo (isset($mascota->Sexo) && $mascota->Sexo == 'hembra') ? 'checked' : ''; ?>> 
                    <label for="sexo-hembra">Hembra</label> 
                </div>

                <label for="fecha_nac">Fecha de Nacimiento</label>
                <input class="controls" type="date" name="fechaNacimiento" id="fecha_nac" value="<?php echo isset($mascota->Fecha_Nacimiento) ? date('Y-m-d', strtotime($mascota->Fecha_Nacimiento)) : ''; ?>" required>

                <label for="descripcion">Descripción</label>
                <textarea class="direccion" type="text" name="Descripcion" id="descripcion" placeholder="Descripcion" required><?php echo isset($mascota->Descripcion) ? $mascota->Descripcion : ''; ?></textarea>

                <label for="tienecita">Cita previa?</label>
                <input class="check" type="checkbox" name="tieneCita" id="tienecita" <?php echo isset($mascota->Tiene_Cita) && $mascota->Tiene_Cita ? 'checked' : ''; ?>>

                <input class="butom" type="submit" value="Registrar">
            </div>
        </section>
    </form>
</div>

<script>
$(document).ready(function() {
    $("#registro-form").submit(function(event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "index.php?controller=controlMascota&method=guardar",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    $("#error-message").text(response.error).fadeIn().delay(3000).fadeOut();
                    $("#success-message").hide();
                } else {
                    $("#success-message").text(response.success).fadeIn().delay(3000).fadeOut();
                    $("#error-message").hide();

                    // Redirigir si hay una URL de redirección en la respuesta
                    if (response.redirect) {
                        setTimeout(function() {
                            window.location.href = response.redirect;
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

    // Obtener las razas cuando se cambia la especie
    document.getElementById("especie").addEventListener("change", function() {
        let especieId = this.value;
        let razaSelect = document.getElementById("raza");

        fetch(`index.php?controller=controlMascota&method=obtenerRazasPorEspecie&especie=${especieId}`)
        .then(response => response.json())
        .then(data => {
            razaSelect.innerHTML = '<option value="">Seleccione una raza</option>';
            data.forEach(raza => {
                razaSelect.innerHTML += `<option value="${raza.Id_Raza}">${raza.Nombre_Raza}</option>`;
            });
        })
        .catch(error => console.error("Error al obtener razas:", error));
    });

    // Preseleccionar razas si la especie ya está seleccionada
    const especieSelect = document.getElementById("especie");
    const razaSelect = document.getElementById("raza");
    if (especieSelect.value) {
        fetch(`index.php?controller=controlMascota&method=obtenerRazasPorEspecie&especie=${especieSelect.value}`)
        .then(response => response.json())
        .then(data => {
            razaSelect.innerHTML = '<option value="">Seleccione una raza</option>';
            data.forEach(raza => {
                razaSelect.innerHTML += `<option value="${raza.Id_Raza}" ${raza.Id_Raza == "<?php echo isset($mascota->Id_Raza) ? $mascota->Id_Raza : ''; ?>" ? 'selected' : ''}>${raza.Nombre_Raza}</option>`;
            });
        })
        .catch(error => console.error("Error al obtener razas:", error));
    }
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
