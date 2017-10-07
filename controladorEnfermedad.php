<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/enfermedad.php");

   $opcion = $_POST["fEnviar"];
   $idEnfermedad = $_POST["fIdEnfermedad"];
   $descripcionEnfermedad = $_POST["fDescripcionEnfermedad"];
   

   $descripcionEnfermedad = htmlspecialchars($descripcionEnfermedad);


   $objetoEnfermedad = new enfermedad($conexion, $idEnfermedad, $descripcionEnfermedad);

  switch($opcion){
      case 'Ingresar':
          $objetoEnfermedad->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoEnfermedad->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoEnfermedad->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioEnfermedad.php?msj=$mensaje");
?>
