<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/registroMascota.css"> <title>Registro de Cita</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container_padre">
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <form id="registro-cita-form">
        <section class="form_registro">
            <div class="form_header">
                <img src="Resources/images/pata.png" alt="pata" class="pata"> <h2>Registro de Cita</h2>
            </div>
            <div class="selec_id">
                <input type="hidden" name="idCita" value="<?php echo isset($cita->idCita) ? $cita->idCita : ''; ?>" id="idCita">

                <label for="idTipoServicio">Tipo de Servicio</label>
                <select class="controls" name="idTipoServicio" id="idTipoServicio" required>
                    <option value="">Seleccione Tipo de Servicio</option>
                    <?php
                    // $tiposServicio debe ser pasado desde controlCita::nuevo() o editar()
                    foreach ($tiposServicio as $servicio) {
                        echo "<option value='{$servicio->idTipoServicio}'" . (isset($cita->idTipoServicio) && $cita->idTipoServicio == $servicio->idTipoServicio ? ' selected' : '') . ">{$servicio->nombreTipoServicio}</option>"; // Ajusta el nombre del campo si es diferente en el modelo CatalogoServicio
                    }
                    ?>
                </select>

                <label for="idMascota">Mascota</label>
                <select class="controls" name="idMascota" id="idMascota" required>
                    <option value="">Seleccione Mascota</option>
                    <?php
                    // $mascotas debe ser pasado desde controlCita::nuevo() o editar()
                    foreach ($mascotas as $mascotaOption) {
                        // Mostrando el nombre del cliente con el nombre de la mascota para un mejor contexto
                        // Esto asume que Cliente_MODEL es accesible en la vista o que el nombre del cliente se obtiene en el controlador
                        $clienteMascota = $this->Cliente_MODEL->cargarID($mascotaOption->Id_Cliente);
                        $nombreClienteMascota = $clienteMascota ? $clienteMascota->Nombres . ' ' . $clienteMascota->Apellidos : 'Desconocido';

                        echo "<option value='{$mascotaOption->Id_Mascota}'" . (isset($cita->idMascota) && $cita->idMascota == $mascotaOption->Id_Mascota ? ' selected' : '') . ">{$mascotaOption->Nombre_Mascota} (Cliente: {$nombreClienteMascota})</option>";
                    }
                    ?>
                </select>

                <label for="idEmpleado">Empleado</label>
                <select class="controls" name="idEmpleado" id="idEmpleado" required>
                    <option value="">Seleccione Empleado</option>
                    <?php
                    // $empleados debe ser pasado desde controlCita::nuevo() o editar()
                    foreach ($empleados as $empleadoOption) {
                        echo "<option value='{$empleadoOption->idEmpleado}'" . (isset($cita->idEmpleado) && $cita->idEmpleado == $empleadoOption->idEmpleado ? ' selected' : '') . ">{$empleadoOption->Nombres} {$empleadoOption->Apellidos}</option>"; // Ajusta los nombres de los campos si son diferentes en el modelo Empleado
                    }
                    ?>
                </select>

                <label for="fechaCitaActual">Fecha Cita Actual</label>
                <input class="controls" type="date" name="fechaCitaActual" id="fechaCitaActual" value="<?php echo isset($cita->fechaCitaActual) ? $cita->fechaCitaActual : ''; ?>" required>

                <label for="fechaProximaCita">Fecha Próxima Cita (Opcional)</label>
                <input class="controls" type="date" name="fechaProximaCita" id="fechaProximaCita" value="<?php echo isset($cita->fechaProximaCita) ? $cita->fechaProximaCita : ''; ?>">
            </div>

            <input class="buttons" type="submit" value="<?php echo isset($cita->idCita) ? 'Actualizar Cita' : 'Registrar Cita'; ?>">
            <p><a href="index.php?controller=controlCita&method=home">Volver a la lista de citas</a></p>
        </section>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#registro-cita-form').submit(function(event) {
        event.preventDefault(); // Evitar el envío normal del formulario

        $.ajax({
            url: 'index.php?controller=controlCita&method=guardar', // Ruta al método guardar en tu controlador
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json', // Esperamos una respuesta JSON
            success: function(response) {
                if (response.success) {
                    $('#success-message').text(response.success).show();
                    $('#error-message').hide();
                    if (response.redirect) {
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 2000); // Redirigir después de 2 segundos
                    }
                } else if (response.error) {
                    $('#error-message').text(response.error).show();
                    $('#success-message').hide();
                }
            },
            error: function(xhr, status, error) {
                $('#error-message').text("Error en la solicitud AJAX: " + error).show();
                $('#success-message').hide();
                console.error("Error en la solicitud AJAX:", status, error);
                console.error("Respuesta del servidor:", xhr.responseText);
            }
        });
    });
});
</script>
</body>
</html>