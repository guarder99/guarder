<?php
   include_once("../modelo/conexion.php");
   $objetoConexion = new conexion();
   $conexion = $objetoConexion->conectar();

   include_once("../modelo/avances.php");

   $opcion = $_POST["fEnviar"];
   $idAvances = $_POST["fIdAvances"];
   $fechaAvances = $_POST["fFechaAvances"];
   $avancesFisicos = $_POST["fAvancesFisicos"];
   $avancesGeneral = $_POST["fAvancesGeneral"];
   $avancesVerbal = $_POST["fAvancesVerbal"];
   $avancesSocial = $_POST["fAvancesSocial"];
   $avancesMatematicos = $_POST["fAvancesMatematicos"];
   $idEstudianteAvance = $_POST["fIdEstudianteAvance"];

   
   $fechaAvances = htmlspecialchars($fechaAvances);
   $avancesFisicos = htmlspecialchars($avancesFisicos);
   $avancesGeneral = htmlspecialchars($avancesGeneral);
   $avancesVerbal = htmlspecialchars($avancesVerbal);
   $avancesSocial = htmlspecialchars($avancesSocial);
   $avancesMatematicos = htmlspecialchars($avancesMatematicos);
   $idEstudianteAvance = htmlspecialchars($idEstudianteAvance);

   $objetoAvances = new avances($conexion, $idAvances, $fechaAvances, $avancesFisicos, $avancesGeneral, $avancesVerbal, $avancesSocial, $avancesMatematicos, $idEstudianteAvance);

  switch($opcion){
      case 'Ingresar':
          $objetoAvances->insertar();
          $mensaje = "Ingresado";
      break;
      case 'Modificar':
          $objetoAvances->modificar();
          $mensaje = "Modificado";
      break;
      case 'Eliminar':
          $objetoAvances->eliminar();
          $mensaje = "Eliminado";
      break;                      
  }
$objetoConexion->desconectar($conexion);
header("location:../vista/formularioAvances.php?msj=$mensaje");
?>
