<?php session_start(); ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/LaboratorioAdmin.css">
    <title>Lista de Servicios</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="contenedor_titulo">
                <h2>Servicios</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <a class="btn_agregar" href="index.php?controller=controlCatalogoServicio&method=nuevo">Registrar Servicio</a>
            <a class="btn_home" href="./views/menuAdmin.php">Home</a>
        </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                        <th class="encabezado">Nombre del Servicio</th>
                        <th class="encabezado">Tipo de Servicio</th>
                        <th class="encabezado">Precio</th>
                        <th class="encabezado">Descripción</th>

                        <th class="encabezado">Eliminar</th>
                        <th class="encabezado">Modificar</th>
                    </tr>
                    <?php foreach($this->MODEL->listar() as $k) : ?>

                        <tr>
                            <td class="contenido"> <?php echo $k->Nombre_Servicio; ?> </td>
                            <td class="contenido">
                                <?php echo $k->tipo_servicio_nombre; ?> </td>
                            <td class="contenido"> <?php echo $k->Precio_Servicio; ?> </td>
                            <td class="contenido"> <?php echo $k->Descripcion; ?> </td>
                            <td class="btn_eliminar"><a href="index.php?controller=controlCatalogoServicio&method=eliminar&id=<?php echo $k->Id_Tipo_Servicio; ?>" class="btn_eliminar">Eliminar</a></td>
                            <td class="btn_modificar"><a href="index.php?controller=controlCatalogoServicio&method=nuevo&id=<?php echo $k->Id_Tipo_Servicio; ?>" class="btn blue z-depth-3">Modificar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>