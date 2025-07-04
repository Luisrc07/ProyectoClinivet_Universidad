<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Resources/css/home.css">
    <title>Menu</title>
</head>

<body>
    <div class="bloque_opciones">
        <div class="contenedor_marca">
            <section class="contenedor_imagen">
                <img src="Resources/images/clinivet.png" alt="Pet Pulse" class="logo_petpulse">
                <h1>PetPulse</h1>
            </section>
        </div>

        <header class="header">
            <nav class="opciones">
                <div class="con_op">
                    <ul class="opc_nav">
                        <li class="cl_cli"> <a class="no_pointer">Consulta</a>
                            <ul>
                                <li class="consultas"><a href="./views/consultaGeneral.php">General</a></li>
                                <li class="consultas"><a href="./views/consultaEspecializada.php">Especializada</a></li>  
                                <li class="consultas"><a href="./views/consultaUrgencia.php">Urgencia</a></li>                   
                            </ul>
                        </li>
                        <li class="cl_mas"> <a href="./views/servicioPeluqueria.php">Peluquería</a> </li>
                        <li class="cl_lab"> <a class="no_pointer">Laboratorio</a>
                                <ul>
                                    <li class="consultas"><a href="index.php?controller=controlExamen&method=mostrarServicios">Exámenes</a></li>
                                </ul>
                            </li>
                        <li class="cl_pro"><a class="no_pointer">Productos</a> </li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <main>
        <div class="stuff">              
            <div class="ingresar">
                <form action="index.php?controller=auth&method=login" method="POST">
                    <img src="Resources/images/pata.png" alt="pata" class="pata">
                    <h2 class="bienvenida">Inicia sesión</h2>
                    <input class="input" type="text" name="username" id="Username" placeholder="usuario" required>
                    <input class="input" type="password" name="password" id="Password" placeholder="contraseña" required>        
                    <input type="submit" value="Iniciar sesión">
                    
                    
                </form>
            </div>

            <div class="contenido">
                <!-- Contenido de la página -->
                <img src="Resources/images/pata.png" alt="pata" class="pata">
                <h2 class="bienvenida">Veterinaria Clinivet</h2>
                <p class="parr_bienv">Veterinaria Clinivet, ofrecemos servicios de atención, cuidado y estética a tu mascota.
                    Aseguramos que cada mascota se sienta como en casa, nuestros clientes son lo más importante para nosotros.
                    Ellos son tan importantes como lo son sus dueños.
                </p>
            </div>          
        </div>
    </main>
</body>
</html>