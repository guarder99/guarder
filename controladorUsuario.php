<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/usuario.php");

   $opcion = $_POST["fEnviar"];
   $idUsuario = $_POST["fIdUsuario"];
   $nombreUsuario = $_POST["fNombreUsuario"];
   $correoUsuario = $_POST["fCorreoUsuario"];
   $claveUsuario = $_POST["fClaveUsuario"];
   $fechaRegistroUsuario = $_POST["fFechaRegistroUsuario"];
   $celularUsuario = $_POST["fCelularUsuario"];
   $idRolesUsuario = $_POST["fIdRolesUsuario"];

   
   $nombreUsuario = htmlspecialchars($nombreUsuario);
   $correoUsuario = htmlspecialchars($correoUsuario);
   $claveUsuario = htmlspecialchars($claveUsuario);
   $fechaRegistroUsuario = htmlspecialchars($fechaRegistroUsuario);
   $celularUsuario = htmlspecialchars($celularUsuario);
   $idRolesUsuario = htmlspecialchars($idRolesUsuario);

   $objetoUsuario = new usuario($conexion, $idUsuario, $nombreUsuario, $correoUsuario, $claveUsuario, $fechaRegistroUsuario, $celularUsuario, $idRolesUsuario);


  switch($opcion){
      case 'Ingresar':
          $objetoUsuario->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoUsuario->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoUsuario->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioUsuario.php?msj=$mensaje");
?>