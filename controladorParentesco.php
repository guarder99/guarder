<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/parentesco.php");

   $opcion = $_POST["fEnviar"];
   $idParentesco = $_POST["fIdParentesco"];
   $descripcionParentesco = $_POST["fDescripcionParentesco"];
   

   $descripcionParentesco = htmlspecialchars($descripcionParentesco);


   $objetoParentesco = new parentesco($conexion, $idParentesco, $descripcionParentesco);

  switch($opcion){
      case 'Ingresar':
          $objetoParentesco->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoParentesco->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoParentesco->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioParentesco.php?msj=$mensaje");
?>
