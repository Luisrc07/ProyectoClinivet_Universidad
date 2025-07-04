
## registroExamen.php
- **Descripción**: Proporciona un formulario para registrar nuevos exámenes en el sistema.
- **Funcionalidad**: Permite a los usuarios ingresar el nombre del examen, su precio y una descripción. Al enviar el formulario, se envían los datos al servidor para su registro.
- **Aspectos Importantes**: Incluye un campo oculto para el ID del examen, lo que permite la edición de un examen existente si se proporciona un ID.

## registroProducto.php
- **Descripción**: Proporciona un formulario para registrar nuevos productos en el sistema.
- **Funcionalidad**: Permite a los usuarios ingresar el nombre del producto, su descripción, precio, cantidad en stock y el ID del proveedor. Al enviar el formulario, se envían los datos al servidor para su registro.
- **Aspectos Importantes**: Incluye un campo oculto para el ID del producto, lo que permite la edición de un producto existente si se proporciona un ID.

## registroProveedor.php
- **Descripción**: Proporciona un formulario para registrar nuevos proveedores en el sistema.
- **Funcionalidad**: Permite a los usuarios ingresar el nombre del proveedor, el nombre del contacto, el teléfono y el correo electrónico. Al enviar el formulario, se envían los datos al servidor para su registro.
- **Aspectos Importantes**: Incluye un campo oculto para el ID del proveedor, lo que permite la edición de un proveedor existente si se proporciona un ID.

## registroRazas.php
- **Descripción**: Proporciona un formulario para registrar nuevas razas en el sistema.
- **Funcionalidad**: Permite a los usuarios seleccionar una especie y ingresar el nombre de la raza. Al enviar el formulario, se envían los datos al servidor para su registro.
- **Aspectos Importantes**: Incluye un campo oculto para el ID de la raza, lo que permite la edición de una raza existente si se proporciona un ID. Además, carga las especies disponibles desde el controlador para asegurar que la raza esté asociada a una especie válida.

## registroServicio.php
- **Descripción**: Proporciona un formulario para registrar nuevos servicios en el sistema.
- **Funcionalidad**: Permite a los usuarios ingresar el nombre del servicio, seleccionar el tipo de servicio, establecer un precio y proporcionar una descripción. Al enviar el formulario, se envían los datos al servidor para su registro.
- **Aspectos Importantes**: Incluye un campo oculto para el ID del servicio, lo que permite la edición de un servicio existente si se proporciona un ID. También ofrece opciones predefinidas para el tipo de servicio.

## registroServicioRealizado.php
- **Descripción**: Proporciona un formulario para registrar servicios que han sido realizados en la clínica.
- **Funcionalidad**: Permite a los usuarios ingresar el ID de la factura, el ID de la mascota, el ID del empleado que realizó el servicio, información adicional, la cita previa y la próxima cita. Al enviar el formulario, se envían los datos al servidor para su registro.
- **Aspectos Importantes**: Incluye un campo oculto para el ID del servicio realizado, lo que permite la edición de un registro existente si se proporciona un ID.

## listaClientes.php
- **Descripción**: Muestra una lista de todos los clientes registrados en el sistema.
- **Funcionalidad**: Permite a los usuarios ver detalles de cada cliente, incluyendo cédula, nombres, apellidos, correo y dirección. También proporciona opciones para eliminar o modificar la información de un cliente.
- **Aspectos Importantes**: Incluye un botón para registrar un nuevo cliente y un enlace para generar un reporte en PDF. La eliminación de un cliente requiere confirmación, y al eliminar un cliente, también se eliminarán las mascotas registradas asociadas.

## listaEmpleados.php
- **Descripción**: Muestra una lista de todos los empleados registrados en el sistema.
- **Funcionalidad**: Permite a los usuarios ver detalles de cada empleado, incluyendo cédula, nombres, apellidos, correo, dirección, fecha de nacimiento, especialización y desempeño. También proporciona opciones para eliminar o modificar la información de un empleado.
- **Aspectos Importantes**: Incluye un botón para registrar un nuevo empleado y un enlace para generar un reporte en PDF. La eliminación de un empleado requiere confirmación, y al eliminar un empleado, se eliminará su registro del sistema.

## listaEspecies.php
- **Descripción**: Muestra una lista de todas las especies registradas en el sistema.
- **Funcionalidad**: Permite a los usuarios ver detalles de cada especie, incluyendo su ID y nombre. También proporciona opciones para modificar la información de una especie.
- **Aspectos Importantes**: Incluye un botón para registrar una nueva especie y un enlace para regresar al menú principal.

## listaRazas.php
- **Descripción**: Muestra una lista de todas las razas registradas en el sistema.
- **Funcionalidad**: Permite a los usuarios ver detalles de cada raza, incluyendo su ID, nombre y la especie a la que pertenece. También proporciona opciones para modificar la información de una raza.
- **Aspectos Importantes**: Incluye un botón para registrar una nueva raza y un enlace para regresar al menú principal. La lista se carga dinámicamente desde el modelo correspondiente.

## listaServicios.php
- **Descripción**: Muestra una lista de todos los servicios registrados en el sistema.
- **Funcionalidad**: Permite a los usuarios ver detalles de cada servicio, incluyendo el nombre, tipo, precio y descripción. También proporciona opciones para eliminar o modificar la información de un servicio.
- **Aspectos Importantes**: Incluye un botón para registrar un nuevo servicio y un enlace para regresar al menú principal. La lista se carga dinámicamente desde el modelo correspondiente.

## listaProductos.php
- **Descripción**: Muestra una lista de todos los productos registrados en el sistema.
- **Funcionalidad**: Permite a los usuarios ver detalles de cada producto, incluyendo ID, nombre, descripción, precio, cantidad en stock y ID del proveedor. También proporciona opciones para eliminar o modificar la información de un producto.
- **Aspectos Importantes**: Incluye un botón para registrar un nuevo producto y un enlace para regresar al menú principal. La eliminación de un producto requiere confirmación, y al eliminar un producto, se eliminará su registro del sistema.

## listaProveedores.php
- **Descripción**: Muestra una lista de todos los proveedores registrados en el sistema.
- **Funcionalidad**: Permite a los usuarios ver detalles de cada proveedor, incluyendo ID, nombre, contacto, teléfono y correo. También proporciona opciones para eliminar o modificar la información de un proveedor.
- **Aspectos Importantes**: Incluye un botón para registrar un nuevo proveedor. La eliminación de un proveedor requiere confirmación, y al eliminar un proveedor, se eliminará su registro del sistema.

## Manejo de Errores
- **Descripción**: El manejo de errores en el sistema se realiza mediante el uso de bloques `try-catch` en las operaciones críticas, como el registro de datos y la interacción con la base de datos. Esto permite capturar excepciones y manejar errores de manera controlada.
- **Funcionalidad**: Cuando ocurre un error, se muestra un mensaje de error al usuario, y se registra el error en un archivo de log para su posterior revisión. Esto ayuda a los desarrolladores a identificar y solucionar problemas en el código.
- **Aspectos Importantes**: Se asegura que los errores no interrumpan la experiencia del usuario, proporcionando mensajes claros y concisos sobre lo que salió mal y cómo proceder.

## Manejo de Validaciones
- **Descripción**: Las validaciones se implementan para asegurar que los datos ingresados por los usuarios sean correctos y cumplan con los requisitos del sistema.
- **Funcionalidad**: Se realizan validaciones en el lado del cliente y del servidor. Por ejemplo, se verifica que los campos obligatorios estén completos, que los formatos de correo electrónico sean válidos y que no existan duplicados en campos críticos como cédula y correo.
- **Aspectos Importantes**: Las validaciones fallidas generan mensajes de error que se muestran al usuario, permitiendo corregir los datos antes de enviarlos al servidor. Esto mejora la calidad de los datos y la experiencia del usuario.
- **Funcionalidad**: Permite a los usuarios ingresar el nombre de la especie. Al enviar el formulario, se envían los datos al servidor para su registro.
- **Aspectos Importantes**: Incluye un campo oculto para el ID de la especie, lo que permite la edición de una especie existente si se proporciona un ID.
