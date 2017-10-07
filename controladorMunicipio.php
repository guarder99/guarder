<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/municipio.php");

   $opcion = $_POST["fEnviar"];
   $idMunicipio= $_POST["fIdMunicipio"];
   $nombreMunicipio = $_POST["fNombreMunicipio"];
   $idDepartamentoMunicipio = $_POST["fIdDepartamentoMunicipio"];
   

   $nombreMunicipio = htmlspecialchars($nombreMunicipio);
   $idDepartamentoMunicipio = htmlspecialchars($idDepartamentoMunicipio);


   $objetoMunicipio = new municipio($conexion, $idMunicipio, $nombreMunicipio, $idDepartamentoMunicipio);

  switch($opcion){
      case 'Ingresar':
          $objetoMunicipio->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoMunicipio->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoMunicipio->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioMunicipio.php?msj=$mensaje");
?>
