<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/cursos.php");

   $opcion = $_POST["fEnviar"];
   $idCursos = $_POST["fIdCursos"];
   $gradosCursos = $_POST["fGradosCursos"];
   $idProfesoresCursos = $_POST["fIdProfesoresCursos"];
   $idNivelCursos = $_POST["fIdNivelCursos"];
   $idAuxiliarCursos = $_POST["fIdAuxiliarCursos"];

   
   $gradosCursos = htmlspecialchars($gradosCursos);
   $idProfesoresCursos = htmlspecialchars($idProfesoresCursos);
   $idNivelCursos = htmlspecialchars($idNivelCursos);
   $idAuxiliarCursos = htmlspecialchars($idAuxiliarCursos);

   $objetoCursos = new cursos($conexion, $idCursos, $gradosCursos, $idProfesoresCursos, $idNivelCursos, $idAuxiliarCursos);

  switch($opcion){
      case 'Ingresar':
          $objetoCursos->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoCursos->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoCursos->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioCursos.php?msj=$mensaje");
?>
