<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Cursos</title>
   <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
    
<body>
    <?php
      $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "cursos";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Cursos</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Grados</th>
        <th scope="col">IdProfesores</th>
        <th scope="col">IdNivel</th>
        <th scope="col">IdAuxiliar</th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/profesores.php");
        $objetoProfesores = new profesores($conexion,0,'documento','nombre', 'celular', 'direccion', 'e-mail', 'fecha', 'idEstudiante', 'esAuxiliar', 'idEsAuxiliar');
        $listaProfesores = $objetoProfesores->listar(0);
        
        include_once("../modelo/nivel.php");
        $objetoNivel= new Nivel($conexion,0,'nombre');
        $listaNiveles = $objetoNivel->listar(0);
        
        include_once("../modelo/cursos.php");
        $objetoCursos = new cursos($conexion,0,'grado','idProfesores', 'idNivel', 'idAuxiliar');
        $listaCursos = $objetoCursos->listar($pagina);
        $permiso = $objetoCursos->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){ 
        while($unRegistro = mysqli_fetch_array($listaCursos)){
            echo '<tr><form id="fModificarCursos"'.$unRegistro["idCursos"].' action="../controlador/controladorCursos.php"
            method="post">';
            echo '<td><input class="form-control" type="hidden" name="fIdCursos" value="'.$unRegistro['idCursos'].'">';
            echo ' <input class="form-control" type="text" name="fGradosCursos" value="'.$unRegistro['gradosCursos'].'"></td>';
            echo '<td><select class="form-control" name="fIdProfesoresCursos">';
            while ($registroProfesor = mysqli_fetch_array($listaProfesores)){
               echo "<option value='".$registroProfesor['idProfesores']."'"; 
               if ($unRegistro['idProfesoresCursos']==$registroProfesor['idProfesores']){
                   echo " selected ";        
               }
                echo ">{$registroProfesor['nombreProfesores']}</option>";
            }
            mysqli_data_seek($listaProfesores,0);
            echo '</select></td>';
            echo '<td><select class="form-control"  name="fIdNivelCursos">';
            while ($registroNivel = mysqli_fetch_array($listaNiveles)){
               echo "<option value='".$registroNivel['idNivel']."'"; 
               if ($unRegistro['idNivelCursos']==$registroNivel['idNivel']){
                   echo " selected ";
                   
               }
                echo ">{$registroNivel['nombreNivel']}</option>";
            }
            mysqli_data_seek($listaNiveles,0);
            echo '</select></td>';
             echo '<td><select class="form-control" name="fIdAuxiliarCursos">';
             while ($registroAuxiliar = mysqli_fetch_array($listaProfesores)){
               echo "<option value='".$registroAuxiliar['idProfesores']."'"; 
               if ($unRegistro['idAuxiliarCursos']==$registroAuxiliar['idProfesores']){
                   echo " selected ";        
               }
                echo ">{$registroAuxiliar['nombreProfesores']}</option>";
            }
            mysqli_data_seek($listaProfesores,0);
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
         <tr><form id="fIngresarCursos" action="../controlador/ControladorCursos.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdCursos" value="0">
             <input class="form-control" type="text" name="fGradosCursos"></td>
             <td><select class="form-control" name="fIdProfesoresCursos">
                 <?php
                  while($registroProfesor = mysqli_fetch_array($listaProfesores)){
                      echo '<option value="'.$registroProfesor['idProfesores'].'">' .$registroProfesor['nombreProfesores'].'</option>';
                  }
                 mysqli_data_seek($listaProfesores,0);
                 ?>
                 </select></td>
             <td><select class="form-control" name="fIdNivelCursos" >
                 <?php
                 while ($registroNivel = mysqli_fetch_array($listaNiveles)){
                     echo '<option value="'.$registroNivel['idNivel'].'">' .$registroNivel['nombreNivel'].'</option>';
                 }
                 ?>
                 </select></td>
             <td><select class="form-control" name="fIdAuxiliarCursos">
             <?php
                  while($registroAuxiliar = mysqli_fetch_array($listaProfesores)){
                      echo '<option value="'.$registroAuxiliar['idProfesores'].'">' .$registroAuxiliar['nombreProfesores'].'</option>';
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
    $cantPaginas=$objetoCursos->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioCursos.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioCursos.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioMunicipio.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaProfesores);
    mysqli_free_result($listaNiveles);
    mysqli_free_result($listaCursos);
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