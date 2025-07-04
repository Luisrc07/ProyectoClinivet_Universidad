# Documentación de Controladores

## Introducción
Este documento proporciona una visión general de los controladores utilizados en la aplicación, detallando su propósito y métodos clave.

## Resumen de Controladores

### auth.php
Maneja la autenticación de usuarios con métodos para inicio de sesión y registro.
- **Métodos**:
  - `login()`: Valida las credenciales del usuario y establece la sesión si son correctas.
  - `register()`: Crea un nuevo usuario en el sistema, validando los datos proporcionados.
  - `logout()`: Cierra la sesión del usuario actual y redirige a la página de inicio.

### controlCliente.php
Gestiona operaciones relacionadas con los clientes, incluyendo la creación, actualización, eliminación y listado de clientes.

### controlEmpleado.php
Similar a `controlCliente`, pero para la gestión de empleados.

### controlEspecie.php
Gestiona especies, incluyendo la creación, actualización y eliminación de especies.

### controlExamen.php
Maneja operaciones relacionadas con exámenes, incluyendo la creación y actualización de registros de exámenes.

### controlMascota.php
Gestiona operaciones relacionadas con mascotas, incluyendo la creación, actualización y listado de mascotas.

### controlProducto.php
Gestiona productos, incluyendo la creación, actualización y eliminación de registros de productos.

### controlProveedor.php
Maneja la gestión de proveedores, incluyendo la creación, actualización y eliminación de proveedores.

### controlRaza.php
Gestiona razas, incluyendo la creación, actualización y eliminación de registros de razas.

### controlServicio.php
Gestiona servicios, incluyendo la creación, actualización y listado de servicios.

### controlServicioRealizado.php
    Maneja operaciones relacionadas con los servicios realizados, incluyendo la creación y actualización de registros.

## Descripciones de Métodos
- **controlCliente.php**
  - `guardar()`: Valida y guarda un nuevo cliente o actualiza uno existente.
  - `eliminar()`: Elimina un cliente basado en su ID.
  - `nuevo()`: Carga la vista para registrar un nuevo cliente o editar uno existente.
  - `home()`: Muestra la lista de clientes.

### Métodos Compartidos
Todos los controladores en la aplicación comparten una estructura similar en sus métodos, lo que incluye operaciones para guardar, eliminar, crear nuevos registros y mostrar listas. Esto permite una consistencia en la forma en que se gestionan los datos a través de diferentes entidades en la aplicación.

### Métodos Únicos
- **controlEmpleado.php**: Incluye métodos específicos para gestionar la información de los empleados, como `obtenerEmpleadoPorId()`, que permite cargar un empleado específico para su edición.
- **controlExamen.php**: Tiene métodos como `cargarExamenPorId()`, que permite obtener un examen específico para su visualización o edición.
- **controlServicio.php**: Incluye `obtenerTiposServicio()`, que permite listar los tipos de servicios disponibles para su selección al crear o editar un servicio.
- **controlServicioRealizado.php**: Contiene `guardarConTransaccion()`, que maneja la lógica de guardar un servicio realizado, asegurando que se registren todos los detalles necesarios en una transacción.

## Manejo de Errores
Los controladores implementan un manejo de errores utilizando bloques try-catch. Cuando ocurre un error durante la ejecución de un método, se captura la excepción y se devuelve un mensaje de error en formato JSON. Esto permite que la interfaz de usuario maneje los errores de manera efectiva y proporcione retroalimentación adecuada al usuario.

### Ejemplo de Manejo de Errores:
```php
public function guardar() {
    try {
        // Código para guardar un registro
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al guardar: ' . $e->getMessage()]);
    }
}
```

## Manejo de Validaciones
Antes de procesar cualquier dato, los controladores realizan validaciones en los campos requeridos. Se verifica que no haya campos vacíos y se proporciona un mensaje de error si se detecta algún problema. Esto asegura que solo se procesen datos válidos y completos, mejorando la integridad de la aplicación.

### Ejemplo de Validación:
```php
public function guardar() {
    if (empty($_POST['Nombre_Cliente'])) {
        echo json_encode(['error' => 'El nombre del cliente es obligatorio.']);
        return;
    }
    // Código para guardar el cliente
}
