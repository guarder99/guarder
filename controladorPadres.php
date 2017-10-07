<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/padres.php");

   $opcion = $_POST["fEnviar"];
   $idPadres = $_POST["fIdPadres"];
   $nombrePadres = $_POST["fNombrePadres"];
   $apellidoPadres = $_POST["fApellidoPadres"];
   $documentoPadres = $_POST["fDocumentoPadres"];
   $celularPadres = $_POST["fCelularPadres"];
   $direccionPadres = $_POST["fDireccionPadres"];
   $correoPadres = $_POST["fCorreoPadres"];
   $estratoPadres = $_POST["fEstratoPadres"];
   $idParentescoPadres = $_POST["fIdParentescoPadres"];

   $nombrePadres        = htmlspecialchars($nombrePadres);
   $apellidoPadres      = htmlspecialchars($apellidoPadres);
   $documentoPadres     = htmlspecialchars($documentoPadres);
   $celularPadres       = htmlspecialchars($celularPadres);
   $direccionPadres     = htmlspecialchars($direccionPadres );
   $correoPadres        = htmlspecialchars($correoPadres);
   $estratoPadres     = htmlspecialchars($estratoPadres );
   $idParentescoPadres   = htmlspecialchars($idParentescoPadres);

   $objetoPadres = new padres($conexion, $idPadres, $nombrePadres, $apellidoPadres, $documentoPadres, $celularPadres, $direccionPadres, $correoPadres, $estratoPadres, $idParentescoPadres);

  switch($opcion){
      case 'Ingresar':
          $objetoPadres->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoPadres->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoPadres->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioPadres.php?msj=$mensaje");
?>
