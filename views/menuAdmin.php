<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Resources/css/menuAdmin.css">
    <title>Menu</title>
</head>

<body>
    <div class="bloque_opciones">
        <div class="contenedor_marca">
            <section class="contenedor_imagen">
                <img src="../Resources/images/clinivet.png" alt="Pet Pulse" class="logo_petpulse">
                <h1>PetPulse</h1>
            </section>
        </div>

        <header class="main">
            <nav class="opciones">
                <div class="con_op">
                    <ul class="opc_nav">
                        <li class="cl_cli"> <a class="no_pointer">Clientes</a>
                            <ul>
                                <li class="consultas"><a href="../index.php?controller=controlCliente&method=home">Consulta de Clientes</a>
                                </li>
                                <li class="consultas"><a href="../index.php?controller=controlCliente&method=nuevo">Registro de Clientes</a></li>
                            </ul>
                        </li>
                        <li class="cl_mas"> <a class="no_pointer">Mascotas</a>
                            <ul>
                            <li class="consultas"><a href="../index.php?controller=controlMascota&method=home">Consulta de Mascotas</a>
                            <li class="consultas"><a href="../index.php?controller=controlMascota&method=nuevo">Registro Mascotas</a></li>                              
                            <li class="consultas"><a href="../index.php?controller=controlEspecie&method=nuevo">Registro Especie</a></li> 
                            <li class="consultas"><a href="../index.php?controller=controlEspecie&method=home">Consulta Especie</a></li>
                            <li class="consultas"><a href="../index.php?controller=controlRaza&method=nuevo">Registro Razas</a></li> 
                            <li class="consultas"><a href="../index.php?controller=controlRaza&method=home">Consulta Razas</a></li>
                        </ul>
                        </li>


                        <li class="cl_produc"> <a >Productos</a>
                            <ul>
                                <li class="consultas"><a href="../index.php?controller=controlProducto&method=home">Consulta de Productos</a>
                                </li>
                                <li class="consultas"><a href="../index.php?controller=controlProducto&method=nuevo">Registro de Productos</a></li>
                                <li class="consultas"><a href="../index.php?controller=controlProveedor&method=home">Consulta de Proveedor</a></li>
                                <li class="consultas"><a href="../index.php?controller=controlProveedor&method=nuevo">Registro de Proveedor</a></li>
                            </ul>
                        </li>

                        
                       <li class="cl_serv"> <a class="no_pointer">Servicios</a>
                           <ul>
                           <li class="consultas"><a href="../index.php?controller=controlExamen&method=home">Consulta de Examen</a></li>
                           <li class="consultas"><a href="../index.php?controller=controlExamen&method=nuevo">Registro de Examen</a></li>  
                           <li class="consultas"><a href="../index.php?controller=controlCatalogoServicio&method=home">Consulta de Servicio</a></li>
                           <li class="consultas"><a href="../index.php?controller=controlCatalogoServicio&method=nuevo">Registro de Servicio</a></li>
                           <li class="consultas"><a href="../index.php?controller=controlServicioRealizado&method=home">Consulta de Servicio Realizado</a></li>
                           <li class="consultas"><a href="../index.php?controller=controlServicioRealizado&method=nuevo">Registro de Servicio Realizado</a></li>
                           
                        
                                
                           </ul>
                       </li>



                        <li class="cl_empl"><a class="no_pointer">Empleados</a>
                            <ul>
                            <li class="consultas"><a href="../index.php?controller=controlEmpleado&method=home">Consulta de Empleados</a>
                            <li class="consultas"><a href="../index.php?controller=controlEmpleado&method=nuevo">Registro de Empleados</a></li>
                            </ul>
                        </li>

                         <li class="cl_empl"><a class="no_pointer">Cita y Factura</a>
                            <ul>
                            <li class="consultas"><a href="../index.php?controller=controlCita&method=home">Lista Citas</a>
                            <li class="consultas"><a href="../index.php?controller=controlCita&method=nuevo">Registro Citas</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <main class="maiz">
        <div class="contenido">
            <!-- Contenido de la página -->
            <img src="../Resources/images/pata.png" alt="pata" class="pata">
            <h2 class="bienvenida">Veterinaria Clinivet</h2>
            <p class="parr_bienv">Veterinaria Clinivet, ofrecemos servicios de atención, cuidado y estética a tu mascota.
                Aseguramos que cada mascota se sienta como en casa, nuestros clientes son lo más importante para nosotros.
                Ellos son tan importantes como lo son sus dueños.
            </p>
        </div>
    </main>
</body>
</html>