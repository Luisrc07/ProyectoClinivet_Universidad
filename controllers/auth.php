<?php

class auth {

    public function login() {
        session_start(); 

  
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        if ($this->authenticate($username, $password)) {
            $_SESSION['user'] = $username; 
            echo "<script>alert('Inicio de sesión exitoso'); setTimeout(function() { window.location.href='views/menuAdmin.php'; }, 500);</script>";
            exit();
          
            header('Location: views/menuAdmin.php');
            
        } else {
            $_SESSION['auth_error'] = 'Los datos introducidos son incorrectos';
            echo "<script>alert('Los datos introducidos son incorrectos'); setTimeout(function() { window.location.href='index.php'; }, 500);</script>";
            exit();
            
           
            header('Location: index.php');
            exit();
        }
    }



    // Método de registro
    public function register() {
        include_once 'views/registroCliente.php';
    }

    // Método ficticio para verificar las credenciales
    private function authenticate($username, $password) {
        // Lógica de autenticación (puedes reemplazar esto con la verificación en la base de datos)
        return $username === 'admin' && $password === '1234'; // Solo un ejemplo
    }
}
?>