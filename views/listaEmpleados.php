<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/registro-style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/listaEmpleado.css">
    <title>Lista de Empleados</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="contenedor_titulo">
                <h2>Lista de Empleados</h2>
            </div>
        </div>
        <div class="row">
                <div class="btnagregar">
                <a class="btn_agregar" href="index.php?controller=controlEmpleado&method=nuevo">Registrar Empleado</a>
                <a class="btn_home" href="./views/menuAdmin.php">Home</a>       
            </div>
            <div class="col m12">
                <table class="table-responsive blue z-depth-3">
                    <tr>
                        <th class="encabezado">Cédula</th>
                        <th class="encabezado">Nombres</th>
                        <th class="encabezado">Apellidos</th>
                        <th class="encabezado">Correo</th>
                        <th class="encabezado">Dirección</th>
                        <th class="encabezado">Fecha de Nacimiento</th>
                        <th class="encabezado">Especialización</th>
                        <th class="encabezado">Desempeño</th>
                        <th class="encabezado">Eliminar</th>
                        <th class="encabezado">Modificar</th>
                    </tr>
                    <?php foreach($this->MODEL->listar() as $k) : ?>
                        <tr>
                            <td class="contenido"> <?php echo $k->Cedula; ?> </td>
                            <td class="contenido"> <?php echo $k->Nombres; ?> </td>
                            <td class="contenido"> <?php echo $k->Apellidos; ?> </td>
                            <td class="contenido"> <?php echo $k->Correo; ?> </td>
                            <td class="contenido"> <?php echo $k->Direccion; ?> </td>
                            <td class="contenido"> <?php echo $k->Fecha_Nacimiento; ?> </td>
                            <td class="contenido"> <?php echo $k->Especializacion; ?> </td>
                            <td class="contenido"> <?php echo $k->Desempeño; ?> </td>
                            <td class="btn_eliminar">
                                <a href="#" class="btn red z-depth-5 eliminar-empleado" data-id="<?php echo $k->Id_Empleado; ?>">Eliminar</a>
                            </td>
                            <td class="btn_modificar">
                                <a href="index.php?controller=controlEmpleado&method=nuevo&id=<?php echo $k->Id_Empleado; ?>" class="btn blue z-depth-3">Modificar</a>
                            </td>
                        </tr>                               
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="div_reporte">
                        <a href="index.php?controller=controlEmpleado&method=generarReporte" class="btn_reporte">Reporte PDF</a>
                    </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".eliminar-empleado").on("click", function(e) {
                e.preventDefault();
                const idEmpleado = $(this).data("id");

                if (confirm("¿Está seguro que desea eliminar este empleado?")) {
                    window.location.href = "index.php?controller=controlEmpleado&method=eliminar&id=" + idEmpleado;
                }
            });
        });
    </script>
</body>
</html>
