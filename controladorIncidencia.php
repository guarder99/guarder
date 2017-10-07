<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/incidencia.php");

   $opcion = $_POST["fEnviar"];
   $idIncidencia = $_POST["fIdIncidencia"];
   $fechayHoraIncidencia = $_POST["fFechayHoraIncidencia"];
   $descripcionIncidencia = $_POST["fDescripcionIncidencia"];
   $idEnfermedadIncidencia = $_POST["fIdEnfermedadIncidencia"];
   $idEstudianteIncidencia = $_POST["fIdEstudianteIncidencia"]; 
   
   $fechayHoraIncidencia = htmlspecialchars($fechayHoraIncidencia);    
   $descripcionIncidencia = htmlspecialchars($descripcionIncidencia);
   $idEnfermedadIncidencia = htmlspecialchars($idEnfermedadIncidencia);
   $idEstudianteIncidencia = htmlspecialchars($idEstudianteIncidencia);


   $objetoIncidencia = new incidencia($conexion, $idIncidencia, $fechayHoraIncidencia, $descripcionIncidencia, $idEnfermedadIncidencia, $idEstudianteIncidencia);

  switch($opcion){
      case 'Ingresar':
          $objetoIncidencia->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoIncidencia->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoIncidencia->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioIncidencia.php?msj=$mensaje");
?>
