<?php
include_once 'models/Empleado.php';
require 'tcpdf/tcpdf.php'; 
class ControlEmpleado {

    public $MODEL;

    public function __construct() {
        $this->MODEL = new Empleado();
    }

    public function home() {
        include_once 'views/listaEmpleados.php'; // Vista para listar empleados
    }

    public function nuevo() {
        if (isset($_REQUEST['id'])) {
            $empleado = $this->MODEL->cargarID($_REQUEST['id']);
            include_once 'views/registroEmpleado.php'; // Vista para editar un empleado
        } else {
            include_once 'views/registroEmpleado.php'; // Vista para registrar un nuevo empleado
        }
    }

    public function guardar() {
        $empleado = new Empleado();
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
    
            // Validar edad mínima de 21 años
            $fechaNacimiento = new DateTime($_POST['Fec_nacimiento']);
            $edad = $fechaNacimiento->diff(new DateTime())->y;
            if ($edad < 21) {
                $response['error'] = "El empleado debe tener al menos 21 años.";
                echo json_encode($response);
                return;
            }
    
            // Asignar valores
            $empleado->setCedula($_POST['Cedula']);
            $empleado->setNombres($_POST['Nombre']);
            $empleado->setApellidos($_POST['Apellido']);
            $empleado->setCorreo($_POST['Correo']);
            $empleado->setFechaNacimiento($_POST['Fec_nacimiento']);
            $empleado->setDireccion($_POST['direccion']);
            $empleado->setEspecializacion($_POST['Especializacion']);
            $empleado->setDesempeño($_POST['Desempeño']);
    
            // Guardar o actualizar
            if (isset($_POST['idEmpleado']) && !empty($_POST['idEmpleado'])) {
                // Para actualización, obtener el empleado actual
                $empleadoActual = $this->MODEL->cargarID($_POST['idEmpleado']);
                if (!$empleadoActual) {
                    $response['error'] = "Empleado no encontrado.";
                    echo json_encode($response);
                    return;
                }
    
                // Verificar duplicados solo si la cédula o el correo han cambiado
                if ($_POST['Cedula'] != $empleadoActual->Cedula && $this->MODEL->buscarPorCedula($_POST['Cedula'])) {
                    $response['error'] = "La cédula ya existe.";
                    echo json_encode($response);
                    return;
                }
    
                if ($_POST['Correo'] != $empleadoActual->Correo && $this->MODEL->buscarPorCorreo($_POST['Correo'])) {
                    $response['error'] = "El correo ya existe.";
                    echo json_encode($response);
                    return;
                }
    
                $empleado->setIdEmpleado($_POST['idEmpleado']);
                $this->MODEL->actualizarDatos($empleado);
    
                // Devolver éxito en la actualización y URL de redirección
                $response['success'] = "Empleado actualizado exitosamente.";
                $response['redirect'] = "http://localhost/Clinivet/index.php?controller=controlEmpleado&method=home";
                echo json_encode($response);
                return;
            } else {
                // Verificar duplicados en nuevos registros
                if ($this->MODEL->buscarPorCedula($_POST['Cedula'])) {
                    $response['error'] = "La cédula ya existe.";
                    echo json_encode($response);
                    return;
                }
    
                if ($this->MODEL->buscarPorCorreo($_POST['Correo'])) {
                    $response['error'] = "El correo ya existe.";
                    echo json_encode($response);
                    return;
                }
    
                $this->MODEL->registrar($empleado);
    
                // Devolver éxito en el registro sin redirección
                $response['success'] = "Empleado registrado exitosamente.";
                echo json_encode($response); // No redirigir para nuevos registros
                return;
            }
    
        } catch (Exception $e) {
            $response['error'] = "Error inesperado: " . $e->getMessage();
            echo json_encode($response);
        }
    }
    
    
    public function verificarCedulaYCorreo() {
        $data = json_decode(file_get_contents('php://input'), true);
        $cedula = $data['cedula'];
        $correo = $data['correo'];
    
        try {
            $cedulaExiste = $this->MODEL->buscarPorCedula($cedula) ? true : false;
            $correoExiste = $this->MODEL->buscarPorCorreo($correo) ? true : false;
            
            echo json_encode(['cedulaExiste' => $cedulaExiste, 'correoExiste' => $correoExiste]);
        } catch (Exception $e) {
            // En caso de error, devolver un mensaje JSON con el error
            echo json_encode(['error' => "Error: " . $e->getMessage()]);
        }
    }
    

    public function eliminar() {
        $response = array();
        
        if (isset($_REQUEST['id'])) {
            try {
                // Eliminar el empleado
                $this->MODEL->delete($_REQUEST['id']);
                
                // Configurar mensaje de éxito
                $response['success'] = "Empleado eliminado exitosamente.";
            } catch (Exception $e) {
                // Configurar mensaje de error
                $response['error'] = "Error al eliminar el empleado: " . $e->getMessage();
            }
        } else {
            // Configurar mensaje de error
            $response['error'] = "ID de empleado no proporcionado.";
        }
        
        // Redirigir con mensaje de respuesta
        header("Location: index.php?controller=controlEmpleado&method=home"); 
        exit();
    }



    public function generarReporte() {
        // Obtener los datos de la base de datos
        $empleados = $this->MODEL->listar();
    
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
        $pdf->Cell(0, 10, 'Reporte de Empleados', 0, 1, 'C');
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
        $anchoEspecializacion = 40;
        $anchoTotal = $anchoCedula + $anchoNombres + $anchoApellidos + $anchoCorreo + $anchoEspecializacion;
    
        // Encabezados de la tabla
        $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->SetFillColor(200, 200, 200);
        $pdf->SetX((210 - $anchoTotal) / 2); 
        

        $pdf->Cell($anchoCedula, 10, 'Cédula', 1, 0, 'C',1);
        $pdf->Cell($anchoNombres, 10, 'Nombres', 1, 0, 'C',1);
        $pdf->Cell($anchoApellidos, 10, 'Apellidos', 1, 0, 'C',1);
        $pdf->Cell($anchoCorreo, 10, 'Correo', 1, 0, 'C',1);
        $pdf->Cell($anchoEspecializacion, 10, 'Especialización', 1, 1, 'C',1);
    
        // Datos de los empleados
        $pdf->SetFont('dejavusans', '', 12);
        
        foreach ($empleados as $empleado) {
            $yInicial = $pdf->GetY(); // Guarda la posición Y antes de imprimir la fila
    
            // Calcular la altura de la fila basado en el contenido más largo
            $alturaCorreo = $pdf->getStringHeight($anchoCorreo, $empleado->Correo);
            $alturaEspecializacion = $pdf->getStringHeight($anchoEspecializacion, $empleado->Especializacion);
            $alturaMax = max(10, $alturaCorreo, $alturaEspecializacion); // Mínimo 10
    
            $pdf->SetX((210 - $anchoTotal) / 2); // Centrar cada fila de la tabla
            $pdf->Cell($anchoCedula, $alturaMax, $empleado->Cedula, 1, 0, 'C');
            $pdf->Cell($anchoNombres, $alturaMax, $empleado->Nombres, 1, 0, 'C');
            $pdf->Cell($anchoApellidos, $alturaMax, $empleado->Apellidos, 1, 0, 'C');
    
            // Guardar posición X antes de usar MultiCell
            $xCorreo = $pdf->GetX();
            $yCorreo = $pdf->GetY();
            $pdf->MultiCell($anchoCorreo, $alturaMax, $empleado->Correo, 1, 'C');
            
            // Asegurar que la especialización quede alineada correctamente
            $pdf->SetXY($xCorreo + $anchoCorreo, $yCorreo);
            $pdf->MultiCell($anchoEspecializacion, $alturaMax, $empleado->Especializacion, 1, 'C');
    
            // Mover la posición Y hacia abajo según la altura más grande
            $pdf->SetY($yInicial + $alturaMax);
        }
    
        // Pie de página con número de página
        $pdf->SetY(-15);
        $pdf->SetFont('dejavusans', 'I', 10);
        $pdf->Cell(0, 10, 'Página ' . $pdf->getAliasNumPage() . ' de ' . $pdf->getAliasNbPages(), 0, 0, 'C');
    
        // Salida del PDF
        $pdf->Output('reporte_empleados.pdf', 'D'); // 'D' para descargar
    }
}

?>
