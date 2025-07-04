<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/registroCita.css">
    <title>Registro De Citas</title>
</head>
<body>
    <div id="error-message" class="error-message"></div>
    <div id="success-message" class="success-message"></div>

    <div class="container_padre">
        <form id="registro-form" action="index.php?controller=controlCita&method=guardar" method="POST">
            <section class="form_registro">
                <div class="form_header">
                    <img src="resources/images/calendar.png" alt="calendar" class="calendar">
                    <h2>Registro de Citas</h2>
                </div>

<input type="hidden" name="idCita" value="<?php echo isset($cita->id_cita) ? htmlspecialchars($cita->id_cita) : ''; ?>">                <label for="fecha_actual">Fecha de Registro</label>
                <input class="controls" type="date" name="Fecha_cita_actual" id="fecha_actual" required value="<?php echo date('Y-m-d'); ?>" readonly>

                <label for="fecha_proxima">Fecha de Cita</label>
                <input class="controls" type="date" name="Fecha_Proxima_Cita" id="fecha_proxima"value="<?php echo (isset($cita->Fecha_Proxima_cita) && !empty($cita->Fecha_Proxima_cita)) ? date('Y-m-d', strtotime($cita->Fecha_Proxima_cita)) : ''; ?>">


               <label for="id_mascota">Mascota</label>
            <select class="controls" name="Id_Mascota" id="Id_Mascota" required>
    <option value="">Seleccione una mascota</option>
    <?php
    if (isset($mascotas) && is_array($mascotas) && !empty($mascotas)) {
        foreach ($mascotas as $masc) {
            $selected = '';
            if (isset($cita) && $cita->Id_Mascota == $masc->Id_Mascota) {
                $selected = 'selected';
            }
            echo "<option value='{$masc->Id_Mascota}' {$selected}>{$masc->Nombre_Mascota}</option>"; 
        }
    } else {
        echo "<option value=''>No hay mascotas registradas</option>";
    }
    ?>
</select>

<label for="id_tipo_servicio">Tipo de Servicio</label>
<select class="controls" name="Id_Tipo_Servicio" id="Id_Tipo_Servicio" required>
    <option value="">Seleccione un tipo de servicio</option>
    <?php
    if (isset($servicios) && is_array($servicios) && !empty($servicios)) {
        foreach ($servicios as $serv) {
            $selected = '';
            if (isset($cita) && $cita->Id_Tipo_Servicio == $serv->Id_Tipo_Servicio) {
                $selected = 'selected';
            }
            echo "<option value='{$serv->Id_Tipo_Servicio}' {$selected}>{$serv->Nombre_Servicio}</option>"; // Asegúrate de usar el nombre correcto
        }
    } else {
        echo "<option value=''>No hay servicios registrados</option>";
    }
    ?>
</select>

<label for="id_empleado">Empleado</label>
<select class="controls" name="Id_Empleado" id="Id_Empleado" required>
    <option value="">Seleccione un empleado</option>
    <?php
    if (isset($empleados) && is_array($empleados) && !empty($empleados)) {
        foreach ($empleados as $emp) {
            $selected = '';
            if (isset($cita) && $cita->Id_Empleado == $emp->Id_Empleado) {
                $selected = 'selected';
            }
            echo "<option value='{$emp->Id_Empleado}' {$selected}>{$emp->Nombres} {$emp->Apellidos}</option>"; // Asegúrate de usar los nombres correctos
        }
    } else {
        echo "<option value=''>No hay empleados registrados</option>";
    }
    ?>
</select>


                <input class="butom" type="submit" value="Registrar">
            </section>
        </form>
    </div>
</body>
</html>