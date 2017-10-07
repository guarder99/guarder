<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/estudiante.php");

   $opcion = $_POST["fEnviar"];
   $idEstudiante = $_POST["fIdEstudiante"];
   $nombreEstudiante = $_POST["fNombreEstudiante"];
   $apellidoEstudiante = $_POST["fApellidoEstudiante"];
   $fechaNacimientoEstudiante = $_POST["fFechaNacimientoEstudiante"];
   $generoEstudiante = $_POST["fGeneroEstudiante"];
   $idMunicipioEstudiante = $_POST["fIdMunicipioEstudiante"];
   $idPadreEstudiante = $_POST["fIdPadreEstudiante"];
   $idMadreEstudiante = $_POST["fIdMadreEstudiante"];
   $idAcudienteEstudiante = $_POST["fIdAcudienteEstudiante"];
   $idCursoEstudiante = $_POST["fIdCursoEstudiante"];

   $nombreEstudiante = htmlspecialchars($nombreEstudiante);
   $apellidoEstudiante = htmlspecialchars($apellidoEstudiante);
   $fechaNacimientoEstudiante = htmlspecialchars($fechaNacimientoEstudiante);
   $generoEstudiante = htmlspecialchars($generoEstudiante);
   $idMunicipioEstudiante = htmlspecialchars($idMunicipioEstudiante);
   $idPadreEstudiante = htmlspecialchars($idPadreEstudiante);
   $idMadreEstudiante = htmlspecialchars($idMadreEstudiante);
   $idAcudienteEstudiante = htmlspecialchars($idAcudienteEstudiante);
   $idCursoEstudiante = htmlspecialchars($idCursoEstudiante);


   $objetoEstudiante = new estudiante($conexion, $idEstudiante, $nombreEstudiante, $apellidoEstudiante, $fechaNacimientoEstudiante, $generoEstudiante, $idMunicipioEstudiante, $idPadreEstudiante, $idMadreEstudiante, $idAcudienteEstudiante, $idCursoEstudiante);

  switch($opcion){
      case 'Ingresar':
          $objetoEstudiante->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoEstudiante->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoEstudiante->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioEstudiante.php?msj=$mensaje");
?>
