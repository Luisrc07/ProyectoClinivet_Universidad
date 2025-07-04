<?php

include_once 'models/Mascota.php';
include_once 'models/Cliente.php';
require 'tcpdf/tcpdf.php'; 
class ControlMascota {

    public $MODEL;
    public $clienteModel;

    public function __construct() {
        $this->MODEL = new Mascota();
        $this->clienteModel = new Cliente();
    }

    public function home() {
        include_once 'views/listaMascotas.php'; // Vista para listar mascotas
    }

    public function nuevo() {
        $mascota = new Mascota();
        $clientes = $this->obtenerClientes(); // Obtener lista de clientes
        $especies = $this->obtenerEspecies(); // Obtener lista de especies
        $razas = []; // Inicializar con un array vacío, se llenará al seleccionar una especie
    
        if (isset($_REQUEST['id'])) {
            $mascota = $this->MODEL->cargarID($_REQUEST['id']);
            $razas = $this->obtenerRazasPorEspecie($mascota->Id_Especie); // Obtener razas si hay una especie seleccionada
        }
    
        include_once 'views/registroMascota.php';
    }
    

    public function guardar() {
        session_start();
        $mascota = new Mascota();
        $response = array();
    
        // Validar campos obligatorios
        if (empty($_POST['idCliente']) || empty($_POST['nombreMascota']) || empty($_POST['Especie']) || empty($_POST['Raza']) || empty($_POST['sexo']) || empty($_POST['fechaNacimiento'])) {
            $response['error'] = "Todos los campos son obligatorios.";
            echo json_encode($response);
            return;
        }
    
        // Asignar valores
        $mascota->setIdCliente($_POST['idCliente']);
        $mascota->setNombreMascota($_POST['nombreMascota']);
        $mascota->setIdEspecie($_POST['Especie']);
        $mascota->setIdRaza($_POST['Raza']);
        $mascota->setSexo($_POST['sexo']);
        $mascota->setFechaNacimiento($_POST['fechaNacimiento']);
        $mascota->setDescripcion($_POST['Descripcion']);
        $mascota->setTieneCita(isset($_POST['tieneCita']) ? 1 : 0);
    
        // Guardar o actualizar
        if (isset($_POST['idMascota']) && !empty($_POST['idMascota'])) {
            $mascota->setIdMascota($_POST['idMascota']);
            $this->MODEL->actualizarDatos($mascota);
            $response['success'] = "Mascota modificada correctamente.";
        } else {
            $this->MODEL->registrar($mascota);
            $response['success'] = "Mascota registrada correctamente.";
        }
    
        // Redirigir a home después de mostrar la notificación
        $response['redirect'] = "index.php?controller=controlMascota&method=home";
        echo json_encode($response);
        exit;
    }
    
    
    public function obtenerClientes() {
        return $this->clienteModel->listar(); // Llama al método listar del modelo Cliente
    }

    public function obtenerClientePorId($id) {
        return $this->clienteModel->cargarID($id); // Obtener cliente por ID
    }

    public function editar() {
        if (isset($_REQUEST['id'])) {
            $mascota = $this->MODEL->cargarID($_REQUEST['id']);
            $clientes = $this->obtenerClientes(); // Obtener lista de clientes
            $especies = $this->obtenerEspecies(); // Obtener lista de especies
            $razas = $this->obtenerRazasPorEspecie($mascota->Id_Especie); // Obtener razas por especie seleccionada
            
            include_once 'views/registroMascota.php';
        } else {
            header("Location: ?controller=controlMascota&method=home");
        }
    }

    public function obtenerEspecies() {
        include_once 'models/Especie.php';
        $especieModel = new Especie();
        return $especieModel->listar(); // Método para listar todas las especies
    }

    public function eliminar() {
        if (isset($_REQUEST['id'])) {
            $this->MODEL->delete($_REQUEST['id']);
            header("Location: ?controller=controlMascota&method=home"); 
        }
    }

    public function listarPorLetra() {
      /*  $contarMachosYHembras = $this->MODEL->contarMachosYHembras(); // Contar machos y hembras
        $this->mascotasCount = [
            'machos' => 0,
            'hembras' => 0
        ];
        
        foreach ($contarMachosYHembras as $sexo) {
            if ($sexo['Sexo'] === 'Macho') {
                $this->mascotasCount['machos'] = $sexo['Total'];
            } elseif ($sexo['Sexo'] === 'Hembra') {
                $this->mascotasCount['hembras'] = $sexo['Total'];
            }
        }
*/
        if (isset($_POST['letra'])) {
            $letra = $_POST['letra'];
            $this->generarReportePorLetra($letra);
        } else {
            header("Location: index.php?controller=controlMascota&method=home");
        }
    }

    // Añadimos el método consultar para listar las mascotas

    public function consultar() {
        $mascotas = $this->MODEL->listar();
        include_once 'views/listaMascotas.php';
    }

    public function buscarPorLetra() {
        $mascotas = null; // Inicializar variable para mascotas filtradas

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['letra'])) {
            $letra = trim($_POST['letra']);
            
            // Validar que solo sea una letra
            if (!preg_match('/^[A-Za-z]$/', $letra)) {
                $_SESSION['error'] = "Debe ingresar una sola letra válida.";
                header("Location: index.php?controller=controlMascota&method=lista");
                exit();
            }
    
            // Obtener mascotas que comienzan con la letra ingresada
            $mascotas = $this->MODEL->listarPorLetra($letra);
    
            // Cargar la vista con los resultados filtrados
            require_once "views/listaMascotas.php"; // Pasar el conteo a la vista

        } else {
            header("Location: index.php?controller=controlMascota&method=lista");
            exit();
        }
    }
    

    public function generarReporte() {
        // Crear una instancia de TCPDF
        $pdf = new TCPDF();
        // Obtener el conteo de machos y hembras usando el método del modelo
      //  $conteo = $this->MODEL->contarMachosYHembras();
        $countMales = 0;
        $countFemales = 0;
        // Ajustar márgenes
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();
        
        // Título del reporte
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(0, 10, 'Reporte de Mascotas', 0, 1, 'C');
        $pdf->Ln(5);
        
        // Encabezados de la tabla
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->Cell(25, 10, 'ID Mascota', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Cliente', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Nombre Mascota', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Especie', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Raza', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Sexo', 1, 1, 'C');
        
        // Obtener datos de la base de datos
        $mascotas = $this->MODEL->listar(); // Asegúrate de que este método devuelva las mascotas correctamente
    
        $pdf->SetFont('dejavusans', '', 10);
        
        foreach ($mascotas as $m) {
            $cliente = $this->obtenerClientePorId($m->Id_Cliente);
            $nombreCliente = $cliente ? $cliente->Nombres . ' ' . $cliente->Apellidos : 'No encontrado';
            
            $pdf->Cell(25, 10, $m->Id_Mascota, 1, 0, 'C');
            $pdf->Cell(45, 10, $nombreCliente, 1, 0, 'L');
            $pdf->Cell(35, 10, $m->Nombre_Mascota, 1, 0, 'L');
            $pdf->Cell(30, 10, $m->Nombre_Especie, 1, 0, 'C');
            $pdf->Cell(25, 10, $m->Nombre_Raza, 1, 0, 'C');
            $pdf->Cell(25, 10, $m->Sexo, 1, 1, 'C');
            //($conteo as $row) {
                if ($m->Sexo == 'macho') {
                    $countMales ++;
                } elseif ($m->Sexo == 'hembra') {
                    $countFemales ++;
                }
            
        }
    
        
    
        
        
        // Agregar el conteo al PDF
        $pdf->Ln(10);
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->Cell(0, 10, 'Total Machos: ' . $countMales, 0, 1, 'L');
        $pdf->Cell(0, 10, 'Total Hembras: ' . $countFemales, 0, 1, 'L');
        
        // Salida del PDF
        $pdf->Output('Reporte_Mascotas.pdf', 'D'); // 'D' para descargar
    }

    public function generarReportePorLetra($letra) {
        // Debugging: Log the received letter
        error_log("Received letter for report: " . $letra);

        // Create a TCPDF instance
        $pdf = new TCPDF();
        
        // Set margins and auto page breaks
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();
        
        // Set font for the report
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->SetFillColor(200, 200, 200);
    
        // Center the report title
        $pdf->SetXY(0, 10);
        $pdf->Cell(0, 10, 'Reporte de Mascotas por Letra: ' . $letra, 0, 1, 'C');
        $pdf->Ln(5);
    
        // Separator line
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10, 30, 200, 30);
        $pdf->Ln(10);
    
        // Table headers
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->SetX((210 - 180) / 2);
        $pdf->Cell(25, 10, 'ID Mascota', 1, 0, 'C', 1);
        $pdf->Cell(45, 10, 'Cliente', 1, 0, 'C', 1);
        $pdf->Cell(35, 10, 'Nombre Mascota', 1, 0, 'C', 1);
        $pdf->Cell(30, 10, 'Especie', 1, 0, 'C', 1);
        $pdf->Cell(25, 10, 'Raza', 1, 0, 'C', 1);
        $pdf->Cell(25, 10, 'Sexo', 1, 1, 'C', 1);
    
        // Get data from the database filtering by letter
        $mascotas = $this->MODEL->listarPorLetra($letra);
        // Check if any mascotas were found
        if (empty($mascotas)) {
            error_log("No mascotas found for letter: " . $letra);
        }

        $pdf->SetFont('dejavusans', '', 10);
    
        foreach ($mascotas as $m) {
            $cliente = $this->obtenerClientePorId($m->Id_Cliente);
            $nombreCliente = $cliente ? $cliente->Nombres . ' ' . $cliente->Apellidos : 'No encontrado';
    
            $pdf->SetX((210 - 180) / 2);
            $pdf->Cell(25, 10, $m->Id_Mascota, 1, 0, 'C');
            $pdf->Cell(45, 10, $nombreCliente, 1, 0, 'L');
            $pdf->Cell(35, 10, $m->Nombre_Mascota, 1, 0, 'L');
            $pdf->Cell(30, 10, $m->Nombre_Especie, 1, 0, 'C');
            $pdf->Cell(25, 10, $m->Nombre_Raza, 1, 0, 'C');
            $pdf->Cell(25, 10, $m->Sexo, 1, 1, 'C');
        }
    
        // Output the PDF
        $pdf->Output('Reporte_Mascotas_por_Letra_' . $letra . '.pdf', 'D');

       
    }
    
    
    public function obtenerRazasPorEspecie() {
        if (isset($_GET['especie'])) {
            include_once 'models/Raza.php';
            $razaModel = new Raza();
            $razas = $razaModel->listarPorEspecie($_GET['especie']);
            echo json_encode($razas);
        } else {
            echo json_encode([]);
        }
    }
    
    
    public function obtenerEspeciePorId($id) {
        include_once 'models/Especie.php';
        $especieModel = new Especie();
        return $especieModel->cargarID($id); // Método para obtener especie por ID
    }
    
    public function obtenerRazaPorId($id) {
        include_once 'models/Raza.php';
        $razaModel = new Raza();
        return $razaModel->cargarID($id); // Método para obtener raza por ID
    }
}
    

?>
