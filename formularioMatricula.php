<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Matriculas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
    $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "matricula";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Matriculas</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Fecha Matricula</th>
        <th scope="col">Valor Matricula</th>
        <th scope="col">IdEstudiantes</th>
        <th scope="col">IdCursos</th>
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/estudiante.php");
        $objetoEstudiante = new estudiante($conexion,0,'nombre','apellido', 'fechaNacimiento', 'genero', 'idMunicipio', 'idPadre', 'idMadre', 'idAcudiente', 'idCurso');
        $listaEstudiantes = $objetoEstudiante->listar(0);
        
        include_once("../modelo/cursos.php");
        $objetoCursos = new cursos($conexion,0,'grado','idProfesores', 'idNivel', 'idAuxiliar');
        $listaCursos = $objetoCursos->listar(0);
        
        include_once("../modelo/matricula.php");
        $objetoMatricula = new matricula($conexion,0,'fecha','valor', 'idProfesores', 'idCursos');
        $listaMatricula = $objetoMatricula->listar($pagina);
        $permiso = $objetoMatricula->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaMatricula)){
            echo '<tr><form id="fModificarMatricula"'.$unRegistro["idMatricula"].' action="../controlador/controladorMatriculas.php"
            method="post">';
            echo '<td><input class="form-control"  type="hidden" name="fIdMatricula" value="'.$unRegistro['idMatricula'].'">';
            echo ' <input class="form-control"  type="date" name="fFechaMatricula" value="'.$unRegistro['fechaMatricula'].'"></td>';
            echo '<td><input class="form-control"  type="text" name="fValorMatricula" value="'.$unRegistro['valorMatricula'].'"></td>';
            echo '<td><select class="form-control"  name="fIdEstudiantesMatricula">';
            while($registroEstudiante = mysqli_fetch_array($listaEstudiantes)){
                echo "<option value='".$registroEstudiante['idEstudiante']."'"; 
                if($unRegistro['idEstudiantesMatricula']==$registroEstudiante['idEstudiante']){
                  echo " selected ";
                  }
                   echo ">{$registroEstudiante['nombreEstudiante']}</option>";
               }
            mysqli_data_seek($listaEstudiantes,0);
             echo '</select></td>';
             echo '<td><select class="form-control"  name="fIdCursosMatricula">';
            while($registroCursos = mysqli_fetch_array($listaCursos)){
                echo "<option value='".$registroCursos['idCursos']."'"; 
                if($unRegistro['idCursosMatricula']==$registroCursos['idCursos']){
                  echo " selected ";
                  }
                   echo ">{$registroCursos['gradosCursos']}</option>";
               }
            mysqli_data_seek($listaCursos,0);
             echo '</select></td>';
            echo '<td>';
             if (stripos($permiso,"u")!==false){
            echo '<button class="btn btn-primary" type="Submit" name="fEnviar" value="Modificar" class=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
            }  //fin permiso u 
            if (stripos($permiso,"d")!==false){
            echo '<button class="btn btn-danger" type="submit" name="fEnviar" value="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>';
           } //fin permiso d
            echo  '</td>';
            echo '</form></tr>';
      } //fin while
}//fin permiso r
?>
<?php
    if (stripos($permiso,"c")!==false){  
?>
         <tr><form id="fIngresarMatriculas" action="../controlador/ControladorMatriculas.php" method="post">
             <td><input class="form-control"  type="hidden" name="fIdMatricula" value="0">
             <input class="form-control"  type="date" name="fFechaMatricula"></td>
             <td><input class="form-control"  type="text" name="fValorMatricula"></td>
             <td><select class="form-control"  name="fIdEstudiantesMatricula">
             <?php
                 while($registroEstudiante = mysqli_fetch_array($listaEstudiantes)){
                      echo '<option value="'.$registroEstudiante['idEstudiante'].'">' .$registroEstudiante['nombreEstudiante'].'</option>';
                  }
                 ?>
                 </select></td>
             <td><select class="form-control"  name="fIdCursosMatricula">
             <?php
              while($registroCursos = mysqli_fetch_array($listaCursos)){
                  echo '<option value="'.$registroCursos['idCursos'].'">' .$registroCursos['gradosCursos'].'</option>';
              }
                 ?>
                 </select></td>
             <td><button class="btn btn-primary" type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
             </button>
                 <button class="btn btn-primary" type="reset" name="fEnviar" value="Limpiar"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></button></td>
         </form></tr>
         <?php
   }//fin permiso c
?> 
        </tbody>
    </table>
        <nav><ul class="pagination">
<?php
    $cantPaginas=$objetoMatricula->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioMatricula.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioMatricula.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioMatricula.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaCursos);
    mysqli_free_result($listaEstudiantes);
    mysqli_free_result($listaMatricula);
    $objetoConexion->desconectar($conexion);
?>
        </div>
    </body>
</html>
<?php
}else{
    header("location:../index.php");
}
?>