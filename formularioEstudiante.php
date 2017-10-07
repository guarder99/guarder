<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Estudiante</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
    $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "estudiante";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Estudiantes</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Nombre Estudiante</th>
        <th scope="col">Apellido Estudiante</th>
        <th scope="col">Fecha Nacimiento</th>
        <th scope="col">Genero</th>
        <th scope="col">IdMunicipio</th>
        <th scope="col">IdPadre</th>
        <th scope="col">IdMadre</th>
        <th scope="col">IdAcudiente</th>
        <th scope="col">IdCurso</th>
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/municipio.php");
        $objetoMunicipio = new municipio($conexion,0,'nombre','idDepartamentoMunicipio');
        $listaMunicipios = $objetoMunicipio->listar(0);
        
        include_once("../modelo/padres.php");
        $objetoPadres = new padres($conexion,0,'nombre','apellido', 'documento', 'celular', 'direccion', 'correo', 'estrato', 'parentesco', 'idParentesco');
        $listaPadres = $objetoPadres->listar(0);
        
        include_once("../modelo/acudiente.php");
        $objetoAcudiente = new acudiente($conexion,0,'nombre', 'cedula', 'celular', 'parentesco');
        $listaAcudientes = $objetoAcudiente->listar(0);
       
        include_once("../modelo/cursos.php");
        $objetoCursos = new cursos($conexion,0,'grado','idProfesores', 'idNivel', 'idAuxiliar');
        $listaCursos = $objetoCursos->listar(0);
        
        include_once("../modelo/estudiante.php");
        $objetoEstudiante = new estudiante($conexion,0,'nombre','apellido', 'fechaNacimiento', 'genero', 'idMunicipio', 'idPadre', 'idMadre', 'idAcudiente', 'idCurso');
        $listaEstudiantes = $objetoEstudiante->listar($pagina);
        $permiso = $objetoEstudiante->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaEstudiantes)){
            echo '<tr><form id="fModificarEstudiantes"'.$unRegistro["idEstudiante"].' action="../controlador/controladorEstudiante.php"
            method="post">';
            echo '<td><input class="form-control" type="hidden" name="fIdEstudiante" value="'.$unRegistro['idEstudiante'].'">';
            echo ' <input class="form-control" type="text" name="fNombreEstudiante" value="'.$unRegistro['nombreEstudiante'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fApellidoEstudiante" value="'.$unRegistro['apellidoEstudiante'].'"></td>';
            echo '<td><input class="form-control" type="date" name="fFechaNacimientoEstudiante" value="'.$unRegistro['fechaNacimientoEstudiante'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fGeneroEstudiante" value="'.$unRegistro['generoEstudiante'].'"></td>';
            echo '<td><select class="form-control" name="fIdMunicipioEstudiante">';
            while($registroMunicipio = mysqli_fetch_array($listaMunicipios)){
                echo "<option value={$registroMunicipio['idMunicipio']}";
                if ($unRegistro['idMunicipioEstudiante']==$registroMunicipio['idMunicipio']){
                    echo " selected ";
                }
                echo ">{$registroMunicipio['nombreMunicipio']}</option>";
            }
            mysqli_data_seek($listaMunicipios,0);
                echo '</select></td>';
            echo '<td><select class="form-control" name="fIdPadreEstudiante">';
            while($registroPadre = mysqli_fetch_array($listaPadres)){
                echo "<option value={$registroPadre['idPadres']}";
                if ($unRegistro['idPadreEstudiante']==$registroPadre['idPadres']){
                    echo " selected ";
                }
                echo ">{$registroPadre['nombrePadres']}</option>";
            }
            mysqli_data_seek($listaPadres,0);
                echo '</select></td>';
            echo '<td><select class="form-control" name="fIdMadreEstudiante">';
            while($registroMadre = mysqli_fetch_array($listaPadres)){
                echo "<option value={$registroMadre['idPadres']}";
                if ($unRegistro['idMadreEstudiante']==$registroMadre['idPadres']){
                    echo " selected ";
                }
                echo ">{$registroMadre['nombrePadres']}</option>";
            }
            mysqli_data_seek($listaPadres,0);
                echo '</select></td>';
            echo '<td><select class="form-control" name="fIdAcudienteEstudiante">';
            while($registroAcudiente = mysqli_fetch_array($listaAcudientes)){
                echo "<option value={$registroAcudiente['idAcudiente']}";
                if ($unRegistro['idAcudienteEstudiante']==$registroAcudiente['idAcudiente']){
                    echo " selected ";
                }
                echo ">{$registroAcudiente['nombreAcudiente']}</option>";
            }
            mysqli_data_seek($listaAcudientes,0);
                echo '</select></td>';
            echo '<td><select class="form-control" name="fIdCursoEstudiante">';
            while($registroCurso = mysqli_fetch_array($listaCursos)){
                echo "<option value={$registroCurso['idCursos']}";
                if ($unRegistro['idCursoEstudiante']==$registroCurso['idCursos']){
                    echo " selected ";
                }
                echo ">{$registroCurso['gradosCursos']}</option>";
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
         <tr><form id="fIngresarEstudiantes" action="../controlador/ControladorEstudiante.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdEstudiante" value="0">
             <input class="form-control" type="text" name="fNombreEstudiante"></td>
             <td><input class="form-control" type="text" name="fApellidoEstudiante"></td>
             <td><input class="form-control" type="date" name="fFechaNacimientoEstudiante"></td>
             <td><input class="form-control" type="text" name="fGeneroEstudiante" ></td>
             <td><select class="form-control" name="fIdMunicipioEstudiante" >
                 <?php
                  while($registroMunicipio = mysqli_fetch_array($listaMunicipios)){
                      echo '<option value="'.$registroMunicipio['idMunicipio'].'">' .$registroMunicipio['nombreMunicipio'].'</option>';
                  }
                 ?>
                 </select></td>
             <td><select class="form-control" name="fIdPadreEstudiante" >
                 <?php
                  while($registroPadre = mysqli_fetch_array($listaPadres)){
                      echo '<option value="'.$registroPadre['idPadres'].'">' .$registroPadre['nombrePadres'].'</option>';
                  }
                 mysqli_data_seek($listaPadres,0);
                 ?> 
                 </select></td>
             <td><select class="form-control" name="fIdMadreEstudiante" >
                 <?php
                  while($registroMadre = mysqli_fetch_array($listaPadres)){
                      echo '<option value="'.$registroMadre['idPadres'].'">' .$registroMadre['nombrePadres'].'</option>';
                  }
                 ?>
                 </select></td>
             <td><select class="form-control" name="fIdAcudienteEstudiante" >
             <?php
                  while($registroAcudiente = mysqli_fetch_array($listaAcudientes)){
                      echo '<option value="'.$registroAcudiente['idAcudiente'].'">' .$registroAcudiente['nombreAcudiente'].'</option>';
                  } 
                 ?>
                 </select></td>   
             <td><select class="form-control" name="fIdCursoEstudiante">
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
    $cantPaginas=$objetoEstudiante->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioEstudiante.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioEstudiante.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioEstudiante.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaCursos);
    mysqli_free_result($listaAcudientes);
    mysqli_free_result($listaPadres);
    mysqli_free_result($listaMunicipios);
    mysqli_free_result($listaEstudiantes);
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