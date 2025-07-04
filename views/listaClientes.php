<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/registro-style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/listaClientes.css">
    <title>Lista de Clientes</title>
    <script>
        function confirmarEliminacion(clienteId) {
            var confirmar = confirm("¿Está seguro que desea eliminar este cliente? Si lo elimina, también se eliminará la mascota registrada.");
            
            if (confirmar) {
                window.location.href = "index.php?controller=controlCliente&method=eliminar&id=" + clienteId;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="contenedor_titulo">
                <div class="contenedor_titulo">
                    <h2>Lista de Clientes</h2>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="btnagregar">
                <a class="btn_agregar" href="index.php?controller=controlCliente&method=nuevo">Registrar Cliente</a>
                <a class="btn_home" href="./views/menuAdmin.php">Home</a>
                </div>
                <div class="col">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                        <th class="encabezado">Cédula</th>
                        <th class="encabezado">Nombres</th>
                        <th class="encabezado">Apellidos</th>
                        <th class="encabezado">Correo</th>
                        <th class="encabezado">Dirección</th>
                        <th class="encabezado">Eliminar</th>
                        <th class="encabezado">Modificar</th>
                    </tr>
                    <?php foreach($this->MODEL->listar() as $k) : ?>
                        <tr>
                            <td class="contenido"> <?php echo $k->Cédula; ?> </td>
                            <td class="contenido"> <?php echo $k->Nombres; ?> </td>
                            <td class="contenido"> <?php echo $k->Apellidos; ?> </td>
                            <td class="contenido"> <?php echo $k->Correo; ?> </td>
                            <td class="contenido"> <?php echo $k->Direccion; ?> </td>
                            <td class="btn_eliminar"><a href="javascript:void(0);" onclick="confirmarEliminacion(<?php echo $k->Id_Cliente; ?>)" class="btn_eliminar">Eliminar</a></td>
                            <td class="btn_modificar"><a href="index.php?controller=controlCliente&method=nuevo&id=<?php echo $k->Id_Cliente; ?>" class="btn blue z-depth-3">Modificar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                    </div>
                    <div class="div_reporte">
                        <a href="index.php?controller=controlCliente&method=generarReporte" class="btn_reporte">Reporte PDF</a>

                    </div>
            </div>      
    </div>
</body>
</html>
