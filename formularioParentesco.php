<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Parentesco</title>
     <title>Formulario Mensualidad</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
    $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "parentesco";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Parentesco</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Descripcion Parentesco</th>
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/parentesco.php");
        $objetoParentesco = new Parentesco($conexion,0,'descripcion');
        $listaParentescos = $objetoParentesco->listar($pagina);
        $permiso = $objetoParentesco->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaParentescos)){
            echo '<tr><form id="fModificarParentesco"'.$unRegistro["idParentesco"].' action="../controlador/controladorParentesco.php"
            method="post">';
            echo '<td><input class="form-control"  type="hidden" name="fIdParentesco" value="'.$unRegistro['idParentesco'].'">';
            echo ' <input class="form-control"  type="text" name="fDescripcionParentesco" value="'.$unRegistro['descripcionParentesco'].'"></td>';
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
         <tr><form id="fIngresarParentesco" action="../controlador/ControladorParentesco.php" method="post">
             <td><input class="form-control"  type="hidden" name="fIdParentesco" value="0">
             <input class="form-control"  type="text" name="fDescripcionParentesco"></td>
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
    $cantPaginas=$objetoParentesco->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioParentesco.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioParentesco.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioParentesco.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaParentescos);
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