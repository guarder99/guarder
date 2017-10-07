<?php
    
    $emailUsuario = $_POST["fEmail"];
    $claveUsuario = $_POST["fClave"];

    include_once("../modelo/conexion.php");
    $objetoConexion = new Conexion();
    $conexion = $objetoConexion->conectar();

    $emailUsuario = mysqli_real_escape_string($conexion, $emailUsuario);

    include_once("../modelo/login.php");
    $objetoLogin = new Login($conexion, $emailUsuario, $claveUsuario);
    $usuarioEsValido = $objetoLogin->verificarUsuario();
    
    if($usuarioEsValido==true){
        session_start();
        $_SESSION['id']            = $objetoLogin->getIdUsuario();
        $_SESSION['nombre']        = $objetoLogin->getNombreUsuario();
        $_SESSION['idroles']       = $objetoLogin->getIdRolesUsuario();
         $objetoConexion->desconectar($conexion);
        header("location:../vista/formularioMatricula.php");
    }else{
        $objetoConexion->desconectar($conexion);
       header("location:../index.php?mensaje=incorrecto");
    }        
?>