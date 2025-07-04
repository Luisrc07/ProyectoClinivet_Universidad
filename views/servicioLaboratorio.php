<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="resources/css/registro-style.css">
    <link rel="stylesheet" href="resources/css/servicioLaboratorio.css">
    <title>Laboratorio Veterinario</title>

</head>
<body>
    <div class="Contenedor">
        <div class="log_vet">
            <img src="resources/images/pata.png" alt="pata" class="pata">
            <label>Clinivet Lab</label>
        </div>


        <header class="titulo">
            <h1>Laboratorio Veterinario</h1>

        </header>
    </div>
    <main>
        <section id="laboratorio">
            <h2>Servicios de Laboratorio</h2>
            <p>Contamos con un laboratorio equipado para realizar análisis y pruebas diagnósticas para tus mascotas.</p>
            <div class="servicios">
                <?php
                // Verificar si la variable $examenes existe y es un array o un objeto iterable
                if (isset($examenes) && is_array($examenes) || is_object($examenes)) {
                    foreach ($examenes as $examen) {
                        ?>
                        <div class="servicio">
                            <h3><?php echo htmlspecialchars($examen->Nombre_Examen); ?></h3>
                            <p><?php echo htmlspecialchars($examen->descripcion); ?></p>
                            <p class="precio">Precio: $<?php echo htmlspecialchars(number_format($examen->Precio, 2)); ?></p>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No hay exámenes de laboratorio registrados en este momento.</p>";
                }
                ?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Clínica Veterinaria. Todos los derechos reservados.</p>
    </footer>

</body>
</html>