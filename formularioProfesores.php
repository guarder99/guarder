<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Profesores</title>
     <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
    $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "profesores";
      include_once("menu.php");
    ?>
    <div class="container-fluid">
    <header>
    <h1>Formulario Profesores</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Documento</th>
        <th scope="col">Nombre</th>
        <th scope="col">Celular</th>
        <th scope="col">Direccion</th>
        <th scope="col">Correo</th>
        <th scope="col">Fecha Ingreso </th>
        <th scope="col">IdEstudiante</th>
        <th scope="col">Es Auxiliar</th>
        <th scope="col">IdEsAuxiliar</th>
        <th scope="col"></th>
    </tr>
    
<?php
        
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/estudiante.php");
        $objetoEstudiante = new estudiante($conexion,0,'nombre','apellido', 'fechaNacimiento', 'genero', 'idMunicipio', 'idPadre', 'idMadre', 'idAcudiente', 'idCurso');
        $listaEstudiantes = $objetoEstudiante->listar(0);
        
        include_once("../modelo/profesores.php");
        $objetoProfesores = new profesores($conexion,0,'documento','nombre', 'celular', 'direccion', 'e-mail', 'fecha', 'idEstudiante', 'esAuxiliar', 'idEsAuxiliar');
        $listaProfesores = $objetoProfesores->listar($pagina);
        $permiso = $objetoProfesores->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaProfesores)){
            echo '<tr><form id="fModificarEstudiantes"'.$unRegistro["idProfesores"].' action="../controlador/controladorProfesores.php"
            method="post">';
            echo '<td><input class="form-control" type="hidden" name="fIdProfesores" value="'.$unRegistro['idProfesores'].'">';
            echo ' <input class="form-control" type="number" name="fDocumentoProfesores" value="'.$unRegistro['documentoProfesores'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fNombreProfesores" value="'.$unRegistro['nombreProfesores'].'"></td>';
            echo '<td><input class="form-control" type="number" name="fCelularProfesores" value="'.$unRegistro['celularProfesores'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fDireccionProfesores" value="'.$unRegistro['direccionProfesores'].'"></td>';
            echo '<td><input class="form-control" type="email" name="fCorreoProfesores" value="'.$unRegistro['correoProfesores'].'"></td>';
            echo '<td><input class="form-control" type="date" name="fFechaIngreso" value="'.$unRegistro['fechaIngreso'].'"></td>';
            echo '<td><select class="form-control" name="fIdEstudiantesProfesores">';
            while($registroEstudiante = mysqli_fetch_array($listaEstudiantes)){
                echo "<option value='".$registroEstudiante['idEstudiante']."'"; 
                if($unRegistro['idEstudiantesProfesores']==$registroEstudiante['idEstudiante']){
                  echo " selected ";
                  }
                   echo ">{$registroEstudiante['nombreEstudiante']}</option>";
               }
            mysqli_data_seek($listaEstudiantes,0);
             echo '</select></td>';
            echo '<td><input class="form-control" type="checkbox" name="fEsAuxiliar" '.(($unRegistro['esAuxiliar']=="si")?"checked":"").'></td>';
            echo '<td><input class="form-control" type="number" name="fIdEsAuxiliar" value="'.$unRegistro['idEsAuxiliar'].'"></td>';
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
         <tr><form id="fIngresarProfesores" action="../controlador/ControladorProfesores.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdProfesores" value="0">
             <input class="form-control" type="text" name="fDocumentoProfesores"></td>
             <td><input class="form-control" type="text" name="fNombreProfesores"></td>
             <td><input class="form-control" type="number" name="fCelularProfesores"></td>
             <td><input class="form-control" type="text" name="fDireccionProfesores"></td>
             <td><input class="form-control" type="email" name="fCorreoProfesores"></td>
             <td><input class="form-control" type="date" name="fFechaIngreso"></td>
             <td><select class="form-control" name="fIdEstudiantesProfesores">
                 <?php 
                  while($registroEstudiante = mysqli_fetch_array($listaEstudiantes)){
                      echo '<option value="'.$registroEstudiante['idEstudiante'].'">' .$registroEstudiante['nombreEstudiante'].'</option>';
                  }
                 ?>
             
                 </select></td>
             <td><input class="form-control" type="checkbox" name="fEsAuxiliar"></td>
             <td><input class="form-control" type="number" name="fIdEsAuxiliar" ></td>
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
    $cantPaginas=$objetoProfesores->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioProfesores.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioProfesores.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioProfesores.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaEstudiantes);                   
    mysqli_free_result($listaProfesores);
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