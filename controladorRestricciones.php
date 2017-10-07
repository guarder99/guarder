<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/restricciones.php");

   $opcion = $_POST["fEnviar"];
   $idRestricciones = $_POST["fIdRestricciones"];
   $descripcionRestricciones = $_POST["fDescripcionRestricciones"];
   $idEstudianteRestricciones = $_POST["fIdEstudianteRestricciones"];

   
   $descripcionRestricciones = htmlspecialchars($descripcionRestricciones);
   $idEstudianteRestricciones = htmlspecialchars($idEstudianteRestricciones);

   $objetoRestricciones = new restricciones($conexion, $idRestricciones, $descripcionRestricciones, $idEstudianteRestricciones);


  switch($opcion){
      case 'Ingresar':
          $objetoRestricciones->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoRestricciones->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoRestricciones->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioRestricciones.php?msj=$mensaje");
?>