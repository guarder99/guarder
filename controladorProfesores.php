<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/profesores.php");

   $opcion = $_POST["fEnviar"];
   $idProfesores = $_POST["fIdProfesores"];
   $documentoProfesores = $_POST["fDocumentoProfesores"];
   $nombreProfesores = $_POST["fNombreProfesores"];
   $celularProfesores = $_POST["fCelularProfesores"];
   $direccionProfesores = $_POST["fDireccionProfesores"];
   $correoProfesores = $_POST["fCorreoProfesores"];
   $fechaIngreso = $_POST["fFechaIngreso"];
   $idEstudiantesProfesores = $_POST["fIdEstudiantesProfesores"];
   $esAuxiliar = (isset($_POST["fEsAuxiliar"]))?"si":"no";
   $idEsAuxiliar = $_POST["fIdEsAuxiliar"];

   $documentoProfesores          = htmlspecialchars($documentoProfesores);
   $nombreProfesores             = htmlspecialchars($nombreProfesores);
   $celularProfesores            = htmlspecialchars($celularProfesores);
   $direccionProfesores          = htmlspecialchars($direccionProfesores);
   $correoProfesores             = htmlspecialchars($correoProfesores );
   $fechaIngreso                 = htmlspecialchars($fechaIngreso );
   $idEstudiantesProfesores      = htmlspecialchars($idEstudiantesProfesores );
   $esAuxiliar                   = htmlspecialchars($esAuxiliar);
   $idEsAuxiliar                   = htmlspecialchars($idEsAuxiliar);

   $objetoProfesores = new profesores($conexion, $idProfesores, $documentoProfesores, $nombreProfesores, $celularProfesores, $direccionProfesores, $correoProfesores, $fechaIngreso, $idEstudiantesProfesores, $esAuxiliar, $idEsAuxiliar);

  switch($opcion){
      case 'Ingresar':
          $objetoProfesores->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoProfesores->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoProfesores->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioProfesores.php?msj=$mensaje");
?>
