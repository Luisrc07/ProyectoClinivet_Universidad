<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/LaboratorioAdmin.css">
    <link rel="stylesheet" type="text/css" href="resources/css/listaCita.css">
    <title>Lista de Citas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row" id="message">
            <div class="col m12">
            </div>
        </div>
        <div class="row">
            <div class="contenedor_titulo">
                <h2>Lista de Citas</h2>
            </div>
        </div>
        <div class="row">
            <div class="btnagregar">
                <a class="btn_agregar" href="index.php?controller=controlCita&method=nuevo">Registrar Cita</a>
                <a class="btn_home" href="./views/menuAdmin.php">Home</a>    
            </div>
            </div>
        <div class="col">
            <table class="table-responsive blue z-depth-3">
                <tr>
                    <th class="encabezado">ID Cita</th>
                    <th class="encabezado">Tipo de Servicio</th>
                    <th class="encabezado">Mascota</th>
                    <th class="encabezado">Cliente</th>
                    <th class="encabezado">Empleado</th>
                    <th class="encabezado">Fecha Cita Actual</th>
                    <th class="encabezado">Fecha Próxima Cita</th>
                    <th class="encabezado">Eliminar</th>
                    <th class="encabezado">Modificar</th>
                </tr>
                <?php 
                // Asumiendo que $this->MODEL->listar() devolverá todas las citas
                // Si tienes una lista filtrada (ej. por búsqueda), usa esa:
                $lista = isset($citas) ? $citas : $this->MODEL->listar();
                
                foreach($lista as $k) : 
                    // Para mostrar información relacionada (TipoServicio, Mascota, Empleado),
                    // necesitarás cargar sus nombres respectivos.
                    // Esto asume que tienes métodos en tu controlCita para obtener estos detalles.
                    $tipoServicio = $this->Servicio_MODEL->cargarID($k->idTipoServicio);
                    $nombreTipoServicio = $tipoServicio ? $tipoServicio->nombreTipoServicio : 'Desconocido'; // Ajusta el nombre del campo según tu modelo CatalogoServicio

                    $mascota = $this->Mascota_MODEL->cargarID($k->idMascota);
                    $nombreMascota = $mascota ? $mascota->Nombre_Mascota : 'Desconocida';

                    // También querrás mostrar el nombre del cliente asociado con la mascota
                    $cliente = $mascota ? $this->Cliente_MODEL->cargarID($mascota->Id_Cliente) : null;
                    $nombreCliente = $cliente ? $cliente->Nombres . ' ' . $cliente->Apellidos : 'Desconocido';

                    $empleado = $this->Empleado_MODEL->cargarID($k->idEmpleado);
                    $nombreEmpleado = $empleado ? $empleado->Nombres . ' ' . $empleado->Apellidos : 'Desconocido'; // Ajusta los nombres de los campos si son diferentes en tu modelo Empleado
                ?>
                    <tr>
                        <td class="contenido"><?php echo $k->idCita; ?></td>
                        <td class="contenido"><?php echo $nombreTipoServicio; ?></td>
                        <td class="contenido"><?php echo $nombreMascota; ?></td>
                        <td class="contenido"><?php echo $nombreCliente; ?></td>
                        <td class="contenido"><?php echo $nombreEmpleado; ?></td>
                        <td class="contenido"><?php echo $k->fechaCitaActual; ?></td>
                        <td class="contenido"><?php echo $k->fechaProximaCita; ?></td>
                        <td class="btn_eliminar">
                            <a href="index.php?controller=controlCita&method=eliminar&id=<?php echo $k->idCita; ?>" class="btn red z-depth-5 eliminar-cita">Eliminar</a>
                        </td>
                        <td class="btn_modificar">
                            <a href="index.php?controller=controlCita&method=editar&id=<?php echo $k->idCita; ?>" class="btn btn-modificar z-depth-3">Modificar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        </div>
</body>
</html>