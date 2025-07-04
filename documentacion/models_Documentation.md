# Documentación de Modelos

Esta documentación proporciona una descripción general de los modelos utilizados en el sistema, incluyendo sus atributos y métodos. Cada modelo representa una entidad en la base de datos y contiene métodos para interactuar con los datos de esa entidad.

## Estructura General de los Modelos
Cada modelo sigue una estructura similar que incluye:
- **Atributos**: Propiedades que representan los datos de la entidad.
- **Métodos**: Funciones que permiten realizar operaciones como listar, cargar, registrar, actualizar y eliminar registros en la base de datos.

## Modelos

### Cita
- **Atributos**: 
  - `idCita`: int
  - `idCliente`: int
  - `fecha`: string
  - `hora`: string
  - `descripcion`: string
- **Métodos**: 
  - `listar()`: Lista todas las citas.
  - `cargarID($id)`: Carga una cita por ID.
  - `registrar($data)`: Registra una nueva cita.
  - `actualizarDatos($data)`: Actualiza los datos de una cita.
  - `delete($id)`: Elimina una cita.

### Cliente
- **Atributos**: 
  - `idCliente`: int
  - `cedula`: int
  - `nombres`: string
  - `apellidos`: string
  - `correo`: string
  - `direccion`: string
- **Métodos**: 
  - `listar()`: Lista todos los clientes.
  - `cargarID($id)`: Carga un cliente por ID.
  - `registrar($data)`: Registra un nuevo cliente.
  - `actualizarDatos($data)`: Actualiza los datos de un cliente.
  - `delete($id)`: Elimina un cliente.

### DetallesFactura
- **Atributos**: 
  - `idDetallesFactura`: int
  - `idFactura`: int
  - `montoServicio`: float
- **Métodos**: 
  - (No se definen métodos)

### Empleado
- **Atributos**: 
  - `idEmpleado`: int
  - `cedula`: int
  - `nombres`: string
  - `apellidos`: string
  - `correo`: string
  - `direccion`: string
  - `fechaNacimiento`: string
  - `especializacion`: string
  - `desempeño`: string
- **Métodos**: 
  - `listar()`: Lista todos los empleados.
  - `cargarID($id)`: Carga un empleado por ID.
  - `registrar($data)`: Registra un nuevo empleado.
  - `actualizarDatos($data)`: Actualiza los datos de un empleado.
  - `delete($id)`: Elimina un empleado.

### Especie
- **Atributos**: 
  - `id_especie`: int
  - `nombre_especie`: string
- **Métodos**: 
  - `listar()`: Lista todas las especies.
  - `cargarID($id)`: Carga una especie por ID.
  - `registrar($data)`: Registra una nueva especie.
  - `actualizarDatos($data)`: Actualiza los datos de una especie.
  - `delete($id)`: Elimina una especie.

### Examen
- **Atributos**: 
  - `id_Tipo_examen`: int
  - `nombre_Examen`: string
  - `precio`: float
  - `descripcion`: string
- **Métodos**: 
  - `listar()`: Lista todos los exámenes.
  - `cargarID($id)`: Carga un examen por ID.
  - `registrar($data)`: Registra un nuevo examen.
  - `actualizarDatos($data)`: Actualiza los datos de un examen.
  - `delete($id)`: Elimina un examen.

### Factura
- **Atributos**: 
  - `idFactura`: int
  - `montoTotal`: float
  - `fecha`: string
- **Métodos**: 
  - (No se definen métodos)

### Mascota
- **Atributos**: 
  - `idMascota`: int
  - `idCliente`: int
  - `nombreMascota`: string
  - `idEspecie`: int
  - `idRaza`: int
  - `sexo`: string
  - `fechaNacimiento`: string
  - `descripcion`: string
  - `tieneCita`: bool
- **Métodos**: 
  - `listar()`: Lista todas las mascotas.
  - `cargarID($id)`: Carga una mascota por ID.
  - `registrar($data)`: Registra una nueva mascota.
  - `actualizarDatos($data)`: Actualiza los datos de una mascota.
  - `delete($id)`: Elimina una mascota.

### Producto
- **Atributos**: 
  - `idProducto`: int
  - `nombreProducto`: string
  - `descripcion`: string
  - `precio`: float
  - `cantidadStock`: int
  - `idProveedor`: int
- **Métodos**: 
  - `listar()`: Lista todos los productos.
  - `cargarID($id)`: Carga un producto por ID.
  - `registrar($data)`: Registra un nuevo producto.
  - `actualizarDatos($data)`: Actualiza los datos de un producto.
  - `delete($id)`: Elimina un producto.

### Proveedor
- **Atributos**: 
  - `idProveedor`: int
  - `nombreProveedor`: string
  - `contacto`: string
  - `telefono`: string
  - `correo`: string
- **Métodos**: 
  - `listar()`: Lista todos los proveedores.
  - `cargarID($id)`: Carga un proveedor por ID.
  - `registrar($data)`: Registra un nuevo proveedor.
  - `actualizarDatos($data)`: Actualiza los datos de un proveedor.
  - `delete($id)`: Elimina un proveedor.

### Raza
- **Atributos**: 
  - `id_raza`: int
  - `id_especie`: int
  - `nombre_raza`: string
- **Métodos**: 
  - `listar()`: Lista todas las razas.
  - `cargarID($id)`: Carga una raza por ID.
  - `registrar($data)`: Registra una nueva raza.
  - `actualizarDatos($data)`: Actualiza los datos de una raza.
  - `delete($id)`: Elimina una raza.

### Servicio
- **Atributos**: 
  - `idTipoServicio`: int
  - `idServicio`: int
  - `nombreServicio`: string
  - `descripcion`: string
  - `precioServicio`: float
- **Métodos**: 
  - `listar()`: Lista todos los servicios.
  - `cargarID($id)`: Carga un servicio por ID.
  - `registrar($data)`: Registra un nuevo servicio.
  - `actualizarDatos($data)`: Actualiza los datos de un servicio.
  - `eliminar($id)`: Elimina un servicio.

### ServicioRealizado
- **Atributos**: 
  - `idServicioRealizado`: int
  - `facturaIdFactura`: int
  - `idMascota`: int
  - `idEmpleado`: int
  - `informacionAdicional`: string
  - `citaPrevia`: string
  - `proximaCita`: string
- **Métodos**: 
  - `listar()`: Lista todos los servicios realizados.
  - `cargarID($id)`: Carga un servicio realizado por ID.
  - `guardarConTransaccion($data)`: Guarda un servicio realizado con manejo de transacciones.
  - `actualizarDatos($data)`: Actualiza los datos de un servicio realizado.
  - `delete($id)`: Elimina un servicio realizado.

## Relaciones entre Modelos
Los modelos en este sistema están interconectados de la siguiente manera:

- **Cliente** y **Mascota**: Un cliente puede tener múltiples mascotas, lo que establece una relación uno a muchos.
- **Especie** y **Raza**: Cada raza pertenece a una especie, creando una relación uno a muchos.
- **Factura** y **ServicioRealizado**: Cada factura puede contener múltiples servicios realizados, estableciendo una relación uno a muchos.
- **Empleado** y **ServicioRealizado**: Un empleado puede realizar múltiples servicios, lo que también establece una relación uno a muchos.
- **Servicio** y **ServicioRealizado**: Cada servicio puede ser realizado múltiples veces, creando una relación uno a muchos.

Esta estructura de relaciones permite una gestión eficiente de los datos y facilita la realización de consultas complejas en la base de datos.

## Validaciones de Datos
Los modelos implementan diversas validaciones de datos para asegurar la integridad y validez de la información. A continuación se describen algunas de las validaciones más relevantes:

- **Validación de Campos Obligatorios**: 
  - En los métodos de registro de varios modelos, se verifica que los campos obligatorios no estén vacíos. Por ejemplo, en el modelo `Servicio`, se valida que `nombreServicio`, `descripcion`, `precioServicio` y `idTipoServicio` no sean nulos antes de registrar un nuevo servicio.

- **Validación de Tipos de Datos**: 
  - Se espera que los atributos tengan tipos de datos específicos (por ejemplo, `int`, `float`, `string`). Aunque no se implementan validaciones explícitas en el código, se asume que los datos proporcionados cumplen con estos tipos.

- **Manejo de Excepciones**: 
  - En todos los métodos que interactúan con la base de datos, se utilizan bloques `try-catch` para manejar excepciones. Esto permite capturar errores durante las operaciones de base de datos y proporciona mensajes de error claros en caso de fallos.

Estas validaciones son esenciales para mantener la calidad de los datos y prevenir errores en la aplicación.

## Manejo de Transacciones
El manejo de transacciones es crucial para asegurar la integridad de los datos en operaciones que involucran múltiples pasos. En el modelo `ServicioRealizado`, se utiliza el método `guardarConTransaccion($data)` para gestionar las transacciones de manera efectiva.

### Ejemplo en el Modelo ServicioRealizado
- **Inicio de la Transacción**: Se inicia una transacción utilizando `$this->connect->beginTransaction()`. Esto asegura que todas las operaciones dentro de la transacción se completen exitosamente antes de confirmar los cambios en la base de datos.
  
- **Operaciones de Base de Datos**: Dependiendo de si se está registrando un nuevo servicio realizado o actualizando uno existente, se ejecutan las consultas SQL correspondientes.

- **Confirmación de la Transacción**: Si todas las operaciones se completan sin errores, se confirma la transacción con `$this->connect->commit()`, lo que hace permanentes los cambios en la base de datos.

- **Manejo de Errores**: Si ocurre un error en cualquier parte del proceso, se captura la excepción y se revierte la transacción utilizando `$this->connect->rollBack()`. Esto asegura que la base de datos no quede en un estado inconsistente.

Este enfoque garantiza que las operaciones críticas se manejen de manera segura y que los datos permanezcan consistentes, incluso en caso de errores.

## Manejo de Errores
El manejo de errores en los modelos se realiza a través de bloques `try-catch` que permiten capturar excepciones durante las operaciones de base de datos. A continuación se describen los aspectos clave del manejo de errores:

- **Captura de Excepciones**: En cada método que interactúa con la base de datos, se utilizan bloques `try-catch` para envolver las operaciones. Esto permite que cualquier excepción lanzada durante la ejecución de la consulta sea capturada y manejada adecuadamente.

- **Mensajes de Error**: Cuando se captura una excepción, se puede proporcionar un mensaje de error claro que indique la naturaleza del problema. Esto es útil para la depuración y para informar al usuario sobre el error.

- **Rollback de Transacciones**: En el contexto de las transacciones, si ocurre un error durante la ejecución de una operación, se revierte la transacción utilizando `$this->connect->rollBack()`. Esto asegura que la base de datos no quede en un estado inconsistente.

- **Manejo de Errores Personalizado**: Se pueden implementar manejadores de errores personalizados para diferentes tipos de excepciones, lo que permite una respuesta más específica a los errores que puedan surgir.

Este enfoque de manejo de errores ayuda a mantener la estabilidad y la integridad del sistema, asegurando que los problemas se manejen de manera efectiva y que se minimicen los impactos negativos en la experiencia del usuario.
