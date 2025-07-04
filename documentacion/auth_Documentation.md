    |# Documentación del archivo `auth.php`

## Descripción
El archivo `auth.php` es un controlador que maneja la autenticación de usuarios en la aplicación. Este controlador incluye funciones para iniciar sesión, cerrar sesión y verificar la autenticación del usuario.

## Funciones

### 1. `login()`
- **Descripción**: Esta función permite a los usuarios iniciar sesión en la aplicación.
- **Parámetros**:
  - `username`: El nombre de usuario del usuario que intenta iniciar sesión.
  - `password`: La contraseña del usuario.
- **Retorno**: Devuelve un mensaje de éxito o error dependiendo de si la autenticación fue exitosa.

### 2. `logout()`
- **Descripción**: Esta función cierra la sesión del usuario actual.
- **Retorno**: Devuelve un mensaje de éxito indicando que el usuario ha cerrado sesión correctamente.

### 3. `isAuthenticated()`
- **Descripción**: Verifica si el usuario actual está autenticado.
- **Retorno**: Devuelve `true` si el usuario está autenticado, de lo contrario, devuelve `false`.

## Ejemplo de uso
```php
// Iniciar sesión
$response = login('usuario', 'contraseña');
echo $response;

// Cerrar sesión
$response = logout();
echo $response;

// Verificar autenticación
if (isAuthenticated()) {
    echo "Usuario autenticado";
} else {
    echo "Usuario no autenticado";
}
```

## Notas
- Asegúrese de que las credenciales del usuario sean correctas al iniciar sesión.
- La función `isAuthenticated()` se puede utilizar para proteger rutas que requieren autenticación.
