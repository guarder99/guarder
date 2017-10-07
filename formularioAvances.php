<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Avances</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
    $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "avances";
      include_once("menu.php");
    ?>
    <div class="container-fluid">
    <header>
    <h1>Formulario Avances</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Fecha Avances</th>
        <th scope="col">Avances Fisicos</th>
        <th scope="col">Avances General</th>
        <th scope="col">Avances Verbal</th>
        <th scope="col">Avances Social</th>
        <th scope="col">Avances Matematicos</th>
        <th scope="col">IdEstuadinateAvances</th>
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/estudiante.php");
        $objetoEstudiante = new estudiante($conexion,0,'nombre','apellido', 'fechaNacimiento', 'genero', 'idMunicipio', 'idPadre', 'idMadre', 'idAcudiente', 'idCurso');
        $listaEstudiantes = $objetoEstudiante->listar(0);
    
        include_once("../modelo/avances.php");
        $objetoAvances = new avances($conexion,0,'fecha','avancesFisicos', 'avancesGeneral', 'avancesVerbal', 'avancesSocial', 'avancesMatematicos','idEstduiantevance');
        $listaAvances = $objetoAvances->listar($pagina);
        $permiso = $objetoAvances->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){ 
        while($unRegistro = mysqli_fetch_array($listaAvances)){
            echo '<tr><form id="fModificarAvances"'.$unRegistro["idAvances"].' action="../controlador/controladorAvances.php"
            method="post">';
            echo '<td><input class="form-control" type="hidden" name="fIdAvances" value="'.$unRegistro['idAvances'].'">';
            echo ' <input class="form-control" type="date" name="fFechaAvances" value="'.$unRegistro['fechaAvances'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fAvancesFisicos" value="'.$unRegistro['avancesFisicos'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fAvancesGeneral" value="'.$unRegistro['avancesGeneral'].'"></td>';
             echo '<td><input class="form-control" type="tex" name="fAvancesVerbal" value="'.$unRegistro['avancesVerbal'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fAvancesSocial" value="'.$unRegistro['avancesSocial'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fAvancesMatematicos" value="'.$unRegistro['avancesMatematicos'].'"></td>';
            echo '<td><select class="form-control" name="fIdEstudianteAvance">';
             while($registroEstudiante = mysqli_fetch_array($listaEstudiantes)){
                echo "<option value='".$registroEstudiante['idEstudiante']."'"; 
                if($unRegistro['idEstudianteAvance']==$registroEstudiante['idEstudiante']){
                  echo " selected ";
                  }
                   echo ">{$registroEstudiante['nombreEstudiante']}</option>";
               }
            mysqli_data_seek($listaEstudiantes,0);
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
         <tr><form id="fIngresarAvances" action="../controlador/ControladorAvances.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdAvances" value="0">
             <input class="form-control" type="date" name="fFechaAvances"></td>
             <td><input class="form-control" type="text" name="fAvancesFisicos"></td>
             <td><input class="form-control" type="text" name="fAvancesGeneral"></td>
             <td><input class="form-control" type="text" name="fAvancesVerbal" ></td>
             <td><input class="form-control" type="text" name="fAvancesSocial" ></td>
             <td><input class="form-control" type="text" name="fAvancesMatematicos" ></td>
             <td><select class="form-control" name="fIdEstudianteAvance">
                 <?php
                  while($registroEstudiante = mysqli_fetch_array($listaEstudiantes)){
                      echo '<option value="'.$registroEstudiante['idEstudiante'].'">' .$registroEstudiante['nombreEstudiante'].'</option>';
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
    $cantPaginas=$objetoAvances->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioAvances.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioAvances.php?pag='.$i.'">'.$i.'</a></li>';
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
    mysqli_free_result($listaEstudiantes);
    mysqli_free_result($listaAvances);
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