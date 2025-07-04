<?php

class Conexion {
    public static function conectar() {
        try {
            $con = new PDO("mysql:host=localhost;dbname=clinivet;charset=utf8", "root", "");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            // Registra el error en lugar de mostrarlo directamente
            error_log("Error de conexión: " . $e->getMessage());
            // Opcional: lanzar una excepción personalizada
            throw new Exception("Error al conectar con la base de datos.");
        }

        
    }
}

?>