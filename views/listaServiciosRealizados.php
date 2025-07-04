<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/registro-style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/listaServiciosRealizados.css">
    <title>Lista de Servicios Realizados</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="contenedor_titulo">
                <h2>Lista de Servicios Realizados</h2>
            </div>
        </div>
        <div class="row">
            <div class="btnagregar">
                <a class="btn_agregar" href="index.php?controller=controlServicioRealizado&method=nuevo">Registrar Servicio Realizado</a>
                <a class="btn_home" href="./views/menuAdmin.php">Home</a>   
            </div>
            <div class="col m12">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                        <th class="encabezado">ID Servicio Realizado</th>
                        <th class="encabezado">Nombre Mascota</th>
                        <th class="encabezado">Nombre Empleado</th>

                        <th class="encabezado">Información Adicional</th>
                        <th class="encabezado">Cita Previa</th>
                        <th class="encabezado">Próxima Cita</th>
                        <th class="encabezado">Eliminar</th>
                        <th class="encabezado">Modificar</th>
                    </tr>
                    <?php foreach($this->MODEL->listar() as $servicioRealizado) : ?>
    <tr>
        <td class="contenido"> <?php echo $servicioRealizado->Id_Servicio_Realizado; ?> </td>
        <td class="contenido"> <?php echo $servicioRealizado->Nombre_Mascota; ?> </td>
        <td class="contenido"> <?php echo $servicioRealizado->Nombre_Empleado; ?> </td>

        <td class="contenido"> <?php echo $servicioRealizado->Informacion_Adicional; ?> </td>
        <td class="contenido"> <?php echo $servicioRealizado->Cita_Previa; ?> </td>
        <td class="contenido"> <?php echo $servicioRealizado->Proxima_Cita; ?> </td>
        <td class="btn_eliminar">
            <a href="#" class="btn red z-depth-5 eliminar-servicio" data-id="<?php echo $servicioRealizado->Id_Servicio_Realizado; ?>">Eliminar</a>
        </td>
        <td class="btn_modificar">
            <a href="index.php?controller=controlServicioRealizado&method=nuevo&id=<?php echo $servicioRealizado->Id_Servicio_Realizado; ?>" class="btn blue z-depth-3">Modificar</a>
        </td>
    </tr>                               
<?php endforeach; ?>

                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".eliminar-servicio").on("click", function(e) {
                e.preventDefault();
                const idServicioRealizado = $(this).data("id");

                if (confirm("¿Está seguro que desea eliminar este servicio realizado?")) {
                    window.location.href = "index.php?controller=controlServicioRealizado&method=eliminar&id=" + idServicioRealizado;
                }
            });
        });
    </script>
</body>
</html>
