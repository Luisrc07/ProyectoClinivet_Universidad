<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/registro-style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/listaClientes.css">
    <title>Lista de Proveedores</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
           
            <div class="contenedor_titulo">
                <h2>Lista de Proveedores</h2>
            </div>
        </div>
        <div class="row">
             <div class="btnagregar">
                <a class="btn_agregar" href="index.php?controller=controlProveedor&method=nuevo">Registrar Proveedor</a>
                <a class="btn_home" href="./views/menuAdmin.php">Home</a>    
            </div>
            <div class="col m12">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                        <th class="encabezado">ID Proveedor</th>
                        <th class="encabezado">Nombre</th>
                        <th class="encabezado">Contacto</th>
                        <th class="encabezado">Teléfono</th>
                        <th class="encabezado">Correo</th>
                        <th class="encabezado">Eliminar</th>
                        <th class="encabezado">Modificar</th>
                    </tr>
                    <?php foreach($this->MODEL->listar() as $proveedor) : ?>
                        <tr>
                            <td class="contenido"> <?php echo $proveedor->Id_Proveedor; ?> </td>
                            <td class="contenido"> <?php echo $proveedor->Nombre_Proveedor; ?> </td>
                            <td class="contenido"> <?php echo $proveedor->Contacto; ?> </td>
                            <td class="contenido"> <?php echo $proveedor->Telefono; ?> </td>
                            <td class="contenido"> <?php echo $proveedor->Correo; ?> </td>
                            <td class="btn_eliminar">
                                <a href="index.php?controller=controlProveedor&method=eliminar&id=<?php echo $proveedor->Id_Proveedor; ?>" class="btn red z-depth-5 eliminar-proveedor" data-id="<?php echo $proveedor->Id_Proveedor; ?>">Eliminar</a>
                            </td>
                            <td class="btn_modificar">
                                <a href="index.php?controller=controlProveedor&method=nuevo&id=<?php echo $proveedor->Id_Proveedor; ?>" class="btn blue z-depth-3">Modificar</a>
                            </td>
                        </tr>                               
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".eliminar-proveedor").on("click", function(e) {
                e.preventDefault();
                const idProveedor = $(this).data("id");

                if (confirm("¿Está seguro que desea eliminar este proveedor?")) {
                    window.location.href = "index.php?controller=controlProveedor&method=eliminar&id=" + idProveedor;
                }
            });
        });
    </script>
</body>
</html>
