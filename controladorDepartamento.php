<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/departamento.php");

   $opcion = $_POST["fEnviar"];
   $idDepartamento= $_POST["fIdDepartamento"];
   $nombreDepartamento = $_POST["fNombreDepartamento"];
   

   $nombreDepartamento = htmlspecialchars($nombreDepartamento);


   $objetoDepartamento = new departamento($conexion, $idDepartamento, $nombreDepartamento);

  switch($opcion){
      case 'Ingresar':
          $objetoDepartamento->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoDepartamento->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoDepartamento->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioDepartamento.php?msj=$mensaje");
?>
