<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/registroServicioRealizado.css">
    <title>Registro de Servicios Realizados</title>
</head>
<body>
<?php if (isset($_SESSION['success_message'])): ?>
    <div id="success-message" class="success-message">
        <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none'; // Ocultar el mensaje
        }, 3000); // Ocultar el mensaje después de 3 segundos
        setTimeout(function() {
            window.location.href = "index.php?controller=controlServicioRealizado&method=home";
        }, 3000); // Redirigir después de 3 segundos
    </script>
<?php endif; ?>

    <div class="container_padre">
        <form id="registro-form" action="index.php?controller=controlServicioRealizado&method=guardar" method="POST">
            <section class="form_registro">
                <div class="form_header">
                    <img src="resources/images/pata.png" alt="pata" class="pata">
                    <h2>Registro de Servicios Realizados</h2>
                </div>

                <!-- Campo oculto para el ID del servicio realizado -->
                <input type="hidden" name="idServicioRealizado" value="<?php echo isset($servicioRealizado->Id_Servicio_Realizado) ? $servicioRealizado->Id_Servicio_Realizado : ''; ?>">

                <!-- Select para mascotas -->
                <label for="id_mascota">Mascota</label>
                <select class="controls" name="idMascota" id="id_mascota" required>
                    <option value="">Seleccione una mascota</option>
                    <?php foreach ($mascotas as $mascota) : ?>
                        <option value="<?php echo $mascota->Id_Mascota; ?>" 
                            <?php echo isset($servicioRealizado->Id_Mascota) && $servicioRealizado->Id_Mascota == $mascota->Id_Mascota ? 'selected' : ''; ?>>
                            <?php echo $mascota->Nombre_Mascota . " (Propietario: " . $mascota->Nombres . " " . $mascota->Apellidos . ")"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Select para empleados -->
                <label for="id_empleado">Empleado</label>
                <select class="controls" name="idEmpleado" id="id_empleado" required>
                    <option value="">Seleccione un empleado</option>
                    <?php foreach ($empleados as $empleado) : ?>
                        <option value="<?php echo $empleado->Id_Empleado; ?>" 
                            <?php echo isset($servicioRealizado->Id_Empleado) && $servicioRealizado->Id_Empleado == $empleado->Id_Empleado ? 'selected' : ''; ?>>
                            <?php echo $empleado->Nombres . " " . $empleado->Apellidos; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Campo para información adicional -->
                <label for="informacion_adicional">Información Adicional</label>
                <textarea class="controls" name="informacionAdicional" id="informacion_adicional" placeholder="Información Adicional" required><?php echo isset($servicioRealizado->Informacion_Adicional) ? $servicioRealizado->Informacion_Adicional : ''; ?></textarea>

                <!-- Campo para cita previa -->
                <label for="cita_previa">Cita Previa</label>
                <input class="controls" type="text" name="citaPrevia" id="cita_previa" placeholder="Cita Previa" required value="<?php echo isset($servicioRealizado->Cita_Previa) ? $servicioRealizado->Cita_Previa : ''; ?>">

                <!-- Campo para próxima cita -->
                <label for="proxima_cita">Próxima Cita</label>
                <input class="controls" type="date" name="proximaCita" id="proxima_cita" placeholder="Próxima Cita" required value="<?php echo isset($servicioRealizado->Proxima_Cita) ? $servicioRealizado->Proxima_Cita : ''; ?>">

                <!-- Botón de envío -->
                <input class="butom" type="submit" value="Registrar">
            </section>
        </form>
    </div>

    <style>
        .error-message, .success-message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: bold;
            display: block;
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
