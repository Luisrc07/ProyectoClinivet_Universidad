# Documentación para la clase Conexion

## Clase: Conexion
La clase `Conexion` se encarga de establecer la conexión a la base de datos utilizando PDO (PHP Data Objects).

### Métodos:
- **conectar()**: 
  - **Descripción**: Este método estático establece una conexión a la base de datos MySQL.
  - **Retorna**: Un objeto PDO que representa la conexión a la base de datos.
  - **Excepciones**: 
    - Si ocurre un error al intentar conectarse, se registra el error en el log de errores y se lanza una excepción personalizada con el mensaje "Error al conectar con la base de datos."

### Ejemplo de uso:
```php
$con = Conexion::conectar();
