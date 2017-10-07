<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/roles.php");

   $opcion = $_POST["fEnviar"];
   $idRoles = $_POST["fIdRoles"];
   $nombreRoles = $_POST["fNombreRoles"];
   $estudianteRoles = $_POST["fEstudianteRoles"];
   $municipioRoles = $_POST["fMunicipioRoles"];
   $departamentoRoles = $_POST["fDepartamentoRoles"];
   $padresRoles = $_POST["fPadresRoles"];
   $parentescoRoles = $_POST["fParentescoRoles"];
   $incidenciaRoles = $_POST["fIncidenciaRoles"];
   $enfermedadRoles = $_POST["fEnfermedadRoles"];
   $restriccionesRoles = $_POST["fRestriccionesRoles"];
   $avancesRoles = $_POST["fAvancesRoles"];
   $profesoresRoles = $_POST["fProfesoresRoles"];
   $cursosRoles = $_POST["fCursosRoles"];
   $nivelRoles = $_POST["fNivelRoles"];
   $matriculaRoles = $_POST["fMatriculaRoles"];
   $mensualidadRoles = $_POST["fMensualidadRoles"];
   $acudienteRoles = $_POST["fAcudienteRoles"];
   $usuarioRoles = $_POST["fUsuarioRoles"];
   $rolesRoles = $_POST["fRolesRoles"];
   
   $nombreRoles = htmlspecialchars($nombreRoles);
   $estudianteRoles = htmlspecialchars($estudianteRoles);
   $municipioRoles = htmlspecialchars($municipioRoles);
   $departamentoRoles = htmlspecialchars($departamentoRoles);
   $padresRoles = htmlspecialchars($padresRoles);
   $parentescoRoles = htmlspecialchars($parentescoRoles);
   $incidenciaRoles = htmlspecialchars($incidenciaRoles);
   $enfermedadRoles = htmlspecialchars($enfermedadRoles);
   $restriccionesRoles = htmlspecialchars($restriccionesRoles);
   $avancesRoles = htmlspecialchars($avancesRoles);
   $profesoresRoles = htmlspecialchars($profesoresRoles);
   $cursosRoles = htmlspecialchars($cursosRoles);
   $nivelRoles = htmlspecialchars($nivelRoles);
   $matriculaRoles = htmlspecialchars($matriculaRoles);
   $mensualidadRoles = htmlspecialchars($mensualidadRoles);
   $acudienteRoles = htmlspecialchars($acudienteRoles);
   $usuarioRoles = htmlspecialchars($usuarioRoles);
   $rolesRoles = htmlspecialchars($rolesRoles);

   $objetoRoles = new roles($conexion, $idRoles, $nombreRoles, $estudianteRoles, $municipioRoles, $departamentoRoles, $padresRoles, $parentescoRoles, $incidenciaRoles, $enfermedadRoles, $restriccionesRoles, $avancesRoles, $profesoresRoles, $cursosRoles, $nivelRoles, $matriculaRoles, $mensualidadRoles, $acudienteRoles, $usuarioRoles, $rolesRoles);


  switch($opcion){
      case 'Ingresar':
          $objetoRoles->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoRoles->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoRoles->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioRoles.php?msj=$mensaje");
?>