<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Mensualidad</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
      $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "mensualidad";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Mensualidad</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Valor Mensualidad</th>
        <th scope="col">Mes Pago</th>
        <th scope="col">Fecha Mensualidad</th>
        <th scope="col">IdEstudiantes</th>
        
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/estudiante.php");
        $objetoEstudiante = new estudiante($conexion,0,'nombre','apellido', 'fechaNacimiento', 'genero', 'idMunicipio', 'idPadre', 'idMadre', 'idAcudiente', 'idCurso');
        $listaEstudiantes = $objetoEstudiante->listar(0);
        
        include_once("../modelo/mensualidad.php");
        $objetoMensualidad = new mensualidad($conexion,0,'valor','mesPago', 'fecha', 'idEstudiante');
        $listaMensualidades = $objetoMensualidad->listar($pagina);
        $permiso = $objetoMensualidad->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaMensualidades)){
            echo '<tr><form id="fModificarMensualidad"'.$unRegistro["idMensualidad"].' action="../controlador/controladorMensualidad.php"
            method="post">';
            echo '<td><input class="form-control" type="hidden" name="fIdMensualidad" value="'.$unRegistro['idMensualidad'].'">';
            echo ' <input class="form-control" type="number" name="fValorMensualidad" value="'.$unRegistro['valorMensualidad'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fMesPagoMensualidad" value="'.$unRegistro['mesPagoMensualidad'].'"></td>';
            echo '<td><input class="form-control" type="date" name="fFechaMensualidad" value="'.$unRegistro['fechaMensualidad'].'"></td>';
             echo '<td><select class="form-control" name="fIdEstudiantesMensualidad">';
               while($registroEstudiante = mysqli_fetch_array($listaEstudiantes)){
                echo "<option value='".$registroEstudiante['idEstudiante']."'"; 
                if($unRegistro['idEstudiantesMensualidad']==$registroEstudiante['idEstudiante']){
                  echo " selected ";
                  }
                   echo ">{$registroEstudiante['nombreEstudiante']}</option>";
               }
            mysqli_data_seek($listaEstudiantes,0);
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
         <tr><form id="fIngresarCursos" action="../controlador/ControladorMensualidad.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdMensualidad" value="0">
             <input class="form-control" type="text" name="fValorMensualidad"></td>
             <td><input class="form-control" type="text" name="fMesPagoMensualidad"></td>
             <td><input class="form-control" type="date" name="fFechaMensualidad"></td>
             <td><select class="form-control"name="fIdEstudiantesMensualidad">
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
    $cantPaginas=$objetoMensualidad->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioEstudiante.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioMensualidad.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioMensualidad.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaEstudiantes);
    mysqli_free_result($listaMensualidades);
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