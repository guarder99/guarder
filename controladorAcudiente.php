<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/acudiente.php");

   $opcion = $_POST["fEnviar"];
   $idAcudiente = $_POST["fIdAcudiente"];
   $nombreAcudiente = $_POST["fNombreAcudiente"];
   $cedulaAcudiente = $_POST["fCedulaAcudiente"];
   $celularAcudiente = $_POST["fCelularAcudiente"];
   $parentescoAcudiente = $_POST["fParentescoAcudiente"];

   
   $nombreAcudiente = htmlspecialchars($nombreAcudiente);
   $cedulaAcudiente = htmlspecialchars($cedulaAcudiente);
   $celularAcudiente = htmlspecialchars($celularAcudiente);
   $parentescoAcudiente = htmlspecialchars($parentescoAcudiente);

   $objetoAcudiente = new acudiente($conexion, $idAcudiente, $nombreAcudiente, $cedulaAcudiente, $celularAcudiente, $parentescoAcudiente);

  switch($opcion){
      case 'Ingresar':
          $objetoAcudiente->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoAcudiente->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoAcudiente->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioAcudiente.php?msj=$mensaje");
?>
