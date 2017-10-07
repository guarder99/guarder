<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Enfermedad</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
     $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "enfermedad";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Enfermedad</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Descripcion Enfermedad</th>
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/enfermedad.php");
        $objetoEnfermedad = new Enfermedad($conexion,0,'descripcion');
        $listaEnfermedades = $objetoEnfermedad->listar($pagina);
        $permiso = $objetoEnfermedad->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaEnfermedades)){
            echo '<tr><form id="fModificarEnfermedad"'.$unRegistro["idEnfermedad"].' action="../controlador/controladorEnfermedad.php"
            method="post">';
            echo '<td><input class="form-control" type="hidden" name="fIdEnfermedad" value="'.$unRegistro['idEnfermedad'].'">';
            echo ' <input class="form-control" type="text" name="fDescripcionEnfermedad" value="'.$unRegistro['descripcionEnfermedad'].'"></td>';
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
         <tr><form id="fIngresarEnfermedad" action="../controlador/ControladorEnfermedad.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdEnfermedad" value="0">
             <input class="form-control" type="text" name="fDescripcionEnfermedad"></td>
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
    $cantPaginas=$objetoEnfermedad->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioEnfermedad.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioEnfermedad.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioEnfermedad.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaEnfermedades);
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