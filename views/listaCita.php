<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/registro-style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/listaClientes.css">
    <title>Lista de Citas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="contenedor_titulo">
                <h2>Lista de Citas</h2>
            </div>
        </div>
        <div class="row">
                <div class="btnagregar">
                <a class="btn_agregar" href="index.php?controller=controlCita&method=nuevo">Registrar Cita</a>
                <a class="btn_home" href="./views/menuAdmin.php">Inicio</a>    
            </div>
            <div class="col m12">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                    <th class="encabezado">ID Cita</th>
                    <th class="encabezado">Fecha Actual</th>
                    <th class="encabezado">Próxima Cita</th>
                    <th class="encabezado">Mascota</th>
                    <th class="encabezado">Empleado</th>
                    <th class="encabezado">Servicio</th> 
                    <th class="encabezado">Eliminar</th>
                    <th class="encabezado">Modificar</th>
                </tr>
                <?php 
                // Asegúrate de que $citas esté definida y sea un array antes de iterar
                if (isset($citas) && is_array($citas)): 
                ?>
                    <?php foreach ($citas as $cita): ?>
                        <tr>
                            <td class="contenido"> <?php echo htmlspecialchars($cita->Id_Cita); ?> </td>
                            <td class="contenido"> <?php echo date('Y-m-d', strtotime($cita->Fecha_cita_actual)); ?> </td>
                            <td class="contenido"> <?php echo ($cita->Fecha_Proxima_cita !== '0000-00-00 00:00:00') ? date('Y-m-d', strtotime($cita->Fecha_Proxima_cita)) : '—'; ?></td>
                            <td class="contenido"> <?php echo htmlspecialchars($cita->Nombre_Mascota); ?> </td>
                            <td class="contenido"> <?php echo htmlspecialchars($cita->Nombre_Empleado); ?> </td>
                            <td class="contenido"> <?php echo htmlspecialchars($cita->Nombre_Tipo_Servicio); ?> </td> 
                            <td class="btn_eliminar">
                                <a href="index.php?controller=controlCita&method=eliminar&id=<?php echo htmlspecialchars($cita->Id_Cita); ?>" class="btn red z-depth-5">Eliminar</a>
                            </td>
                            <td class="btn_modificar">
                                <a href="index.php?controller=controlCita&method=nuevo&id=<?php echo htmlspecialchars($cita->Id_Cita); ?>" class="btn blue z-depth-3">Modificar</a>
                            </td>
                        </tr>                               
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="contenido" style="text-align: center;">No hay citas registradas.</td>
                    </tr>
                <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".eliminar-cita").on("click", function(e) { // Cambiado a .eliminar-cita si usas una clase específica
                e.preventDefault();
                const idCita = $(this).data("id");

                if (confirm("¿Está seguro que desea eliminar esta cita?")) {
                    window.location.href = "index.php?controller=controlCita&method=eliminar&id=" + idCita;
                }
            });
        });
    </script>
</body>
</html>