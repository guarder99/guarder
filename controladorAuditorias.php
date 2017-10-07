<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/auditorias.php");

   $opcion = $_POST["fEnviar"];
   $idAuditoria = $_POST["fIdAuditoria"];
   $FechaAuditoria = $_POST["fFechaAuditoria"];
   $DescripcionAuditoria = $_POST["fDescripcionAuditoria"];
   $idUsuarioAuditoria = $_POST["fIdUsuarioAuditoria"];

   
   $FechaAuditoria = htmlspecialchars($FechaAuditoria);
   $DescripcionAuditoria = htmlspecialchars($DescripcionAuditoria);
   $idUsuarioAuditoria = htmlspecialchars($idUsuarioAuditoria);

   $objetoAuditoria = new auditoria($conexion, $idAuditoria, $FechaAuditoria, $DescripcionAuditoria, $idUsuarioAuditoria);


  switch($opcion){
      case 'Ingresar':
          $objetoAuditoria->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoAuditoria->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoAuditoria->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioAuditorias.php?msj=$mensaje");
?>