<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/matricula.php");

   $opcion = $_POST["fEnviar"];
   $idMatricula = $_POST["fIdMatricula"];
   $fechaMatricula = $_POST["fFechaMatricula"];
   $valorMatricula = $_POST["fValorMatricula"];
   $idEstudiantesMatricula = $_POST["fIdEstudiantesMatricula"];
   $idCursosMatricula = $_POST["fIdCursosMatricula"];

   
   $fechaMatricula = htmlspecialchars($fechaMatricula);
   $valorMatricula = htmlspecialchars($valorMatricula);
   $idEstudiantesMatricula = htmlspecialchars($idEstudiantesMatricula);

   $objetoMatricula = new matricula($conexion, $idMatricula, $fechaMatricula, $valorMatricula, $idEstudiantesMatricula, $idCursosMatricula);

  switch($opcion){
      case 'Ingresar':
          $objetoMatricula->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoMatricula->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoMatricula->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioMatricula.php?msj=$mensaje");
?>
