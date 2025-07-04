<?php

include_once 'models/Cliente.php'; 
require('tcpdf/tcpdf.php');
class controlCliente {

    public $MODEL;

    public function __construct() {
        $this->MODEL = new Cliente();
    }

    public function home() {
        include_once 'views/listaClientes.php'; // Vista para listar clientes
    }

    public function nuevo() {
        if (isset($_REQUEST['id'])) {
            $cliente = $this->MODEL->cargarID($_REQUEST['id']);
            include_once 'views/registroCliente.php'; // Vista para editar un cliente
        } else {
            include_once 'views/registroCliente.php'; // Vista para registrar un nuevo cliente
        }
    }
    

    public function guardar() {
        $cliente = new Cliente();
        $response = array();
    
        try {
            // Verificar que los campos no estén vacíos
            if (empty($_POST['Cedula']) || empty($_POST['Nombre']) || empty($_POST['Apellido']) || empty($_POST['Correo']) || empty($_POST['direccion'])) {
                $response['error'] = "Todos los campos son obligatorios.";
                echo json_encode($response);
                return;
            }
    
            // Validar el formato del correo
            if (!filter_var($_POST['Correo'], FILTER_VALIDATE_EMAIL)) {
                $response['error'] = "El correo no es válido.";
                echo json_encode($response);
                return;
            }
    
            // Asignar valores
            $cliente->setCedula($_POST['Cedula']);
            $cliente->setNombres($_POST['Nombre']);
            $cliente->setApellidos($_POST['Apellido']);
            $cliente->setCorreo($_POST['Correo']);
            $cliente->setDireccion($_POST['direccion']);
    
            // Guardar o actualizar
            if (isset($_POST['idCliente']) && !empty($_POST['idCliente'])) {
                // Para actualización, obtener el cliente actual
                $clienteActual = $this->MODEL->cargarID($_POST['idCliente']);
                if (!$clienteActual) {
                    $response['error'] = "Cliente no encontrado.";
                    echo json_encode($response);
                    return;
                }
    
                // Verificar duplicados solo si la cédula o el correo han cambiado
                if (isset($clienteActual->Cédula) && $_POST['Cedula'] != $clienteActual->Cédula && $this->MODEL->existeCedula($_POST['Cedula'])) {
                    $response['error'] = "La cédula ya existe.";
                    echo json_encode($response);
                    return;
                }
    
                if (isset($clienteActual->Correo) && $_POST['Correo'] != $clienteActual->Correo && $this->MODEL->existeCorreo($_POST['Correo'])) {
                    $response['error'] = "El correo ya existe.";
                    echo json_encode($response);
                    return;
                }
    
                $cliente->setIdCliente($_POST['idCliente']);
                $this->MODEL->actualizarDatos($cliente);
    
                // Devolver éxito en la actualización y URL de redirección
                $response['success'] = "Cliente actualizado exitosamente.";
                $response['redirect'] = "http://localhost/Clinivet/index.php?controller=controlCliente&method=home";
                echo json_encode($response);
                return;
            } else {
                // Verificar duplicados en nuevos registros
                if ($this->MODEL->existeCedula($_POST['Cedula'])) {
                    $response['error'] = "La cédula ya existe.";
                    echo json_encode($response);
                    return;
                }
    
                if ($this->MODEL->existeCorreo($_POST['Correo'])) {
                    $response['error'] = "El correo ya existe.";
                    echo json_encode($response);
                    return;
                }
    
                $this->MODEL->registrar($cliente);
    
                // Devolver éxito en el registro sin redirección
                $response['success'] = "Cliente registrado exitosamente.";
                $response['redirect'] = "http://localhost/Clinivet/index.php?controller=controlCliente&method=home";
                echo json_encode($response);
                
                return;
            }
    
        } catch (Exception $e) {
            $response['error'] = "Error inesperado: " . $e->getMessage();
            echo json_encode($response);
        }
    }
    
    
    
    
    
    
    
    

    public function eliminar() {
        $response = array();
        
        if (isset($_REQUEST['id'])) {
            try {
                // Eliminar todas las mascotas asociadas al cliente
                $this->MODEL->eliminarMascotasPorCliente($_REQUEST['id']);
                // Eliminar el cliente
                $this->MODEL->delete($_REQUEST['id']);
                
                // Configurar mensaje de éxito
                $response['success'] = "Cliente y sus mascotas eliminados exitosamente.";
            } catch (Exception $e) {
                // Configurar mensaje de error
                $response['error'] = "Error al eliminar el cliente: " . $e->getMessage();
            }
        } else {
            // Configurar mensaje de error
            $response['error'] = "ID de cliente no proporcionado.";
        }
        
        // Redirigir con mensaje de respuesta
        header("Location: index.php?controller=controlCliente&method=home"); 
        exit();
    }
    
  



    public function generarReporte() {
        // Obtener los datos de la base de datos
        $clientes = $this->MODEL->listar();
    
        // Crear un nuevo PDF
        $pdf = new TCPDF();
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();
        $pdf->SetFont('dejavusans', 'B', 16);
        
        // Agregar la imagen del logo
        $logoPath = './resources/images/clinivet.jpg'; 
        $pdf->Image($logoPath, 10, 10, 20, 20, 'JPG'); 
    
        // Centrar el título del reporte
        $pdf->SetXY(0, 10);
        $pdf->Cell(0, 10, 'Lista de Clientes', 0, 1, 'C');
        $pdf->Ln(10);
        
        // Línea separadora
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10, 30, 200, 30);
        $pdf->Ln(10);
    
        // Definir los anchos de cada columna
        $anchoCedula = 25;
        $anchoNombres = 35;
        $anchoApellidos = 35;
        $anchoCorreo = 55;
        $anchoDireccion = 45;
        $anchoTotal = $anchoCedula + $anchoNombres + $anchoApellidos + $anchoCorreo + $anchoDireccion;
    
        // Encabezados de la tabla
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->SetX((210 - $anchoTotal) / 2); // Centrar la tabla
        $pdf->SetFillColor(200, 200, 200);
        $pdf->Cell($anchoCedula, 10, 'Cédula', 1, 0, 'C',1);
        $pdf->Cell($anchoNombres, 10, 'Nombres', 1, 0, 'C',1);
        $pdf->Cell($anchoApellidos, 10, 'Apellidos', 1, 0, 'C',1);
        $pdf->Cell($anchoCorreo, 10, 'Correo', 1, 0, 'C',1);
        $pdf->Cell($anchoDireccion, 10, 'Dirección', 1, 1, 'C',1);
    
        // Datos de los clientes
        $pdf->SetFont('dejavusans', '', 12);
        
        foreach ($clientes as $cliente) {
            $yInicial = $pdf->GetY(); 
    
            // Calcular la altura de la fila basado en las columnas de mayor contenido
            $alturaCorreo = $pdf->getStringHeight($anchoCorreo, $cliente->Correo);
            $alturaDireccion = $pdf->getStringHeight($anchoDireccion, $cliente->Direccion);
            $alturaMax = max(10, $alturaCorreo, $alturaDireccion); // Mínimo 10
    
            $pdf->SetX((210 - $anchoTotal) / 2); 
            $pdf->Cell($anchoCedula, $alturaMax, $cliente->Cédula, 1, 0, 'C');
            $pdf->Cell($anchoNombres, $alturaMax, $cliente->Nombres, 1, 0, 'C');
            $pdf->Cell($anchoApellidos, $alturaMax, $cliente->Apellidos, 1, 0, 'C');
    
            // Guardar posición X antes de usar MultiCell
            $xCorreo = $pdf->GetX();
            $yCorreo = $pdf->GetY();
            $pdf->MultiCell($anchoCorreo, $alturaMax, $cliente->Correo, 1, 'C');
            
            // Asegurar que la dirección quede alineada correctamente
            $pdf->SetXY($xCorreo + $anchoCorreo, $yCorreo);
            $pdf->MultiCell($anchoDireccion, $alturaMax, $cliente->Direccion, 1, 'C');
    
            // Mover la posición Y hacia abajo según la altura más grande
            $pdf->SetY($yInicial + $alturaMax);
        }
    
        // Pie de página con número de página
        $pdf->SetY(-15);
        $pdf->SetFont('dejavusans', 'I', 10);
        $pdf->Cell(0, 10, 'Página ' . $pdf->getAliasNumPage() . ' de ' . $pdf->getAliasNbPages(), 0, 0, 'C');
    
        // Salida del PDF
        $pdf->Output('reporte_clientes.pdf', 'D'); // 'D' para descargar
    }
    
    
    

    
    
}

?>