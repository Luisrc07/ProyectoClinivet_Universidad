<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/LaboratorioAdmin.css">
    <title>Lista de Clientes</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="contenedor_titulo">
                <h2>Examenes</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button class="btn_agregar" onclick="window.location.href='index.php?controller=controlExamen&method=nuevo'" class="btn blue z-depth-3">Agregar Examen</button>
                <a class="btn_home" href="./views/menuAdmin.php">Home</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                        <th class="encabezado">Nombre Examen</th>
                        <th class="encabezado">Precio</th>
                        <th class="encabezado">Descripcion</th>
                        <th class="encabezado">Eliminar</th>
                        <th class="encabezado">Modificar</th>
                    </tr>
                    <?php foreach($this->MODEL->listar() as $k) : ?>
                        
                        <tr>
                            <td class="contenido"> <?php echo $k->Nombre_Examen; ?> </td>
                            <td class="contenido"> <?php echo $k->Precio; ?> </td>
                            <td class="contenido"> <?php echo $k->descripcion; ?> </td>
                            <td class="btn_eliminar"><a href="index.php?controller=controlExamen&method=eliminar&id=<?php echo $k->id_Tipo_Examen; ?>" class="btn_eliminar">Eliminar</a></td>
                            <td class="btn_modificar"><a href="index.php?controller=controlExamen&method=nuevo&id=<?php echo $k->id_Tipo_Examen; ?>" class="btn blue z-depth-3">Modificar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

