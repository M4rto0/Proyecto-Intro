<?php

$host = 'C:\Users\marto\OneDrive\Documentos\USM\IWG\Proyecto-IWG\Proyecto-Intro'; 
$usuario = 'root'; 
$contrasena = ''; 
$base_de_datos = 'tu_base_de_datos'; 

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    
    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? AND contrasena = ?");
    $consulta->bind_param("ss", $email, $contrasena);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows == 1) {
        
        echo "Inicio de sesión exitoso. Redirige al usuario a la página de inicio.";
    } else {

        echo "Credenciales incorrectas. Inténtalo de nuevo.";
    }

    $consulta->close();
}

$conexion->close();
?>