<?php

$host = 'C:\Users\marto\OneDrive\Documentos\USM\IWG\Proyecto-IWG\Proyecto-Intro'; 
$usuario = 'root'; 
$contrasena = ''; 
$base_de_datos = 'proyecto intro'; 


$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $curso = $_POST['curso'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $consulta = $conexion->prepare("INSERT INTO usuarios (usuario, curso, email, contrasena) VALUES (?, ?, ?, ?)");
    $consulta->bind_param("ssss", $usuario, $curso, $email, $contrasena);

    if ($consulta->execute()) {
        
        header('Location: home.html');
        exit; 
    } else {
        
        echo "Error en el registro. Inténtalo de nuevo.";
    }

    $consulta->close();
}

$conexion->close();
?>