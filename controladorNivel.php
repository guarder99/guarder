<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/nivel.php");

   $opcion = $_POST["fEnviar"];
   $idNivel= $_POST["fIdNivel"];
   $nombreNivel = $_POST["fNombreNivel"];
   

   $nombreNivel = htmlspecialchars($nombreNivel);


   $objetoNivel = new Nivel($conexion, $idNivel, $nombreNivel);

  switch($opcion){
      case 'Ingresar':
          $objetoNivel->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoNivel->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoNivel->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioNivel.php?msj=$mensaje");
?>
