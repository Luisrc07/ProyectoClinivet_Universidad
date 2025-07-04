<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="resources/css/registro-style.css">
    <link rel="stylesheet" type="text/css" href="resources/css/listaMascota.css">
    <title>Lista de Mascotas</title>
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
            <h2>Lista de Mascotas</h2>
        </div>
    </div>
    
    <div class="row">
        <div class="btnagregar">
            <a class="btn_agregar" href="index.php?controller=controlMascota&method=nuevo">Registrar Mascota</a>
            <a class="btn_home" href="./views/menuAdmin.php">Home</a>    
        </div>
        <div class = "buscarmascota">
        
<form action="index.php?controller=controlMascota&method=buscarPorLetra" method="POST">
    <label for="letra">Buscar mascotas por letra:</label>
    <input type="text" id="letra" name="letra" maxlength="1" required>
    <button type="submit" class="btn_reporte">Buscar</button>
    
</div>
</form>

        </div>
        
        <div class="col">
        

<table class="table-responsive blue z-depth-3">
    <tr>
        <th class="encabezado">ID Mascota</th>
        <th class="encabezado">ID Cliente</th>
        <th class="encabezado">Nombre Mascota</th>
        <th class="encabezado">Especie</th>
        <th class="encabezado">Raza</th>
        <th class="encabezado">Sexo</th>
        <th class="encabezado">Fecha Nacimiento</th>
        <th class="encabezado">Eliminar</th>
        <th class="encabezado">Modificar</th>
    </tr>
    <?php 
    $lista = isset($mascotas) ? $mascotas : $this->MODEL->listar(); // Si hay filtro, usa la lista filtrada
    foreach($lista as $k) : ?>
        <tr>
            <td class="contenido"><?php echo $k->Id_Mascota; ?></td>
            <td class="contenido"><?php echo $k->Nombres . ' ' . $k->Apellidos; ?></td>
            <td class="contenido"><?php echo $k->Nombre_Mascota; ?></td>
            <td class="contenido"><?php echo $k->Nombre_Especie; ?></td>
            <td class="contenido"><?php echo $k->Nombre_Raza; ?></td>
            <td class="contenido"><?php echo $k->Sexo; ?></td>
            <td class="contenido"><?php echo $k->Fecha_Nacimiento; ?></td>
            <td class="btn_eliminar">
                <a href="index.php?controller=controlMascota&method=eliminar&id=<?php echo $k->Id_Mascota; ?>" class="btn red z-depth-5 eliminar-mascota">Eliminar</a>
            </td>
            <td class="btn_modificar">
                <a href="index.php?controller=controlMascota&method=editar&id=<?php echo $k->Id_Mascota; ?>" class="btn btn-modificar z-depth-3">Modificar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
        </div>
        <div class="div_reporte">
            <a href="index.php?controller=controlMascota&method=generarReporte" class="btn_reporte">Reporte PDF</a>
        </div>
    </div>
</div>

</body>
</html>
