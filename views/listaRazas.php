<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/LaboratorioAdmin.css">
    <title>Lista de Razas</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="contenedor_titulo">
                <h2>Razas</h2>
            </div>
        </div>
        <div class="row">
            <div class="btnagregar">
                <a class="btn_agregar" href="index.php?controller=controlRaza&method=nuevo">Registrar Raza</a>
                <a class="btn_home" href="./views/menuAdmin.php">Home</a>    
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                        <th class="encabezado">Id</th>
                        <th class="encabezado">Nombre de la Raza</th>
                        <th class="encabezado">Especie</th>
                        <th class="encabezado">Modificar</th>
                    </tr>
                    <?php foreach($this->MODEL->listar() as $k) : ?>
                        <tr>
                            <td class="contenido"> <?php echo $k->Id_Raza; ?> </td>
                            <td class="contenido"> <?php echo $k->Nombre_Raza; ?> </td>
                            <td class="contenido"> 
                                <?php 
                                // Cargar el nombre de la especie correspondiente
                                $especie = $this->ESPECIE_MODEL->cargarID($k->Id_Especie);
                                echo $especie->Nombre_Especie; 
                                ?> 
                            </td>
                            <td class="btn_modificar">
                                <a href="index.php?controller=controlRaza&method=nuevo&id=<?php echo $k->Id_Raza; ?>" class="btn blue z-depth-3">Modificar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>