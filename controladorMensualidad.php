<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/mensualidad.php");

   $opcion = $_POST["fEnviar"];
   $idMensualidad = $_POST["fIdMensualidad"];
   $valorMensualidad = $_POST["fValorMensualidad"];
   $mesPagoMensualidad = $_POST["fMesPagoMensualidad"];
   $fechaMensualidad = $_POST["fFechaMensualidad"];
   $idEstudiantesMensualidad = $_POST["fIdEstudiantesMensualidad"];

   
   $valorMensualidad = htmlspecialchars($valorMensualidad);
   $mesPagoMensualidad = htmlspecialchars($mesPagoMensualidad);
   $fechaMensualidad = htmlspecialchars($fechaMensualidad);
   $idEstudiantesMensualidad = htmlspecialchars($idEstudiantesMensualidad);

   $objetoMensualidades = new mensualidad($conexion, $idMensualidad, $valorMensualidad, $mesPagoMensualidad, $fechaMensualidad, $idEstudiantesMensualidad);
  echo "cualquier cosas=".$idEstudiantesMensualidad;

  switch($opcion){
      case 'Ingresar':
          $objetoMensualidades->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoMensualidades->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoMensualidades->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioMensualidad.php?msj=$mensaje");
?>
