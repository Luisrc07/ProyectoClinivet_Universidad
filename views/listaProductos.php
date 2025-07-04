<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/registro-style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/listaClientes.css">
    <title>Lista de Productos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="contenedor_titulo">
                <h2>Lista de Productos</h2>
            </div>
        </div>
        <div class="row">
                <div class="btnagregar">
                <a class="btn_agregar" href="index.php?controller=controlProducto&method=nuevo">Registrar Producto</a>
                <a class="btn_home" href="./views/menuAdmin.php">Home</a>    
            </div>
            <div class="col m12">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                    <th class="encabezado">ID Producto</th>
                    <th class="encabezado">Nombre</th>
                    <th class="encabezado">Descripción</th>
                    <th class="encabezado">Precio</th>
                    <th class="encabezado">Stock</th>
                    <th class="encabezado">Proveedor</th> <th class="encabezado">Eliminar</th>
                    <th class="encabezado">Modificar</th>
                </tr>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td class="contenido"> <?php echo htmlspecialchars($producto->Id_Producto); ?> </td>
                        <td class="contenido"> <?php echo htmlspecialchars($producto->Nombre_Producto); ?> </td>
                        <td class="contenido"> <?php echo htmlspecialchars($producto->Descripcion); ?> </td>
                        <td class="contenido"> <?php echo htmlspecialchars($producto->Precio); ?> </td>
                        <td class="contenido"> <?php echo htmlspecialchars($producto->Cantidad_Stock); ?> </td>
                        <td class="contenido"> <?php echo htmlspecialchars($producto->Nombre_Proveedor_Producto_Lista); ?> </td> 
                        <td class="btn_eliminar">
                            <a href="index.php?controller=controlProducto&method=eliminar&id=<?php echo htmlspecialchars($producto->Id_Producto); ?>" class="btn red z-depth-5">Eliminar</a>
                        </td>
                        <td class="btn_modificar">
                            <a href="index.php?controller=controlProducto&method=nuevo&id=<?php echo htmlspecialchars($producto->Id_Producto); ?>" class="btn blue z-depth-3">Modificar</a>
                        </td>
                    </tr>                               
                <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".eliminar-producto").on("click", function(e) {
                e.preventDefault();
                const idProducto = $(this).data("id");

                if (confirm("¿Está seguro que desea eliminar este producto?")) {
                    window.location.href = "index.php?controller=controlProducto&method=eliminar&id=" + idProducto;
                }
            });
        });
    </script>
</body>
</html>
