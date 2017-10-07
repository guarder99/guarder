<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Padres</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
    $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "padres";
      include_once("menu.php");
    ?>
    <div class="container-fluid">
    <header>
    <h1>Formulario Padres</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Nombre Padre</th>
        <th scope="col">Apellido Padre</th>
        <th scope="col">Documento</th>
        <th scope="col">Celular</th>
        <th scope="col">Direccion</th>
        <th scope="col">Correo</th>
        <th scope="col">Estrato</th>
        <th scope="col">Parentesco</th>
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/parentesco.php");
        $objetoParentesco = new Parentesco($conexion,0,'descripcion');
        $listaParentescos = $objetoParentesco->listar(0);
        
        include_once("../modelo/padres.php");
        $objetoPadres = new padres($conexion,0,'nombre','apellido', 'documento', 'celular', 'direccion', 'correo', 'estrato', 'parentesco', 'idParentesco');
        $listaPadres = $objetoPadres->listar($pagina);
        $permiso = $objetoPadres->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaPadres)){
            echo '<tr><form id="fModificarPadres"'.$unRegistro["idPadres"].' action="../controlador/controladorPadres.php"
            method="post">';
            echo '<td><input class="form-control"  type="hidden"  name="fIdPadres"           value="'.$unRegistro['idPadres'].'">';
            echo '    <input class="form-control"  type="text"    name="fNombrePadres"       value="'.$unRegistro['nombrePadres'].'"></td>';
            echo '<td><input class="form-control"   type="text"    name="fApellidoPadres"     value="'.$unRegistro['apellidoPadres'].'"></td>';
            echo '<td><input class="form-control"  type="number"  name="fDocumentoPadres"    value="'.$unRegistro['documentoPadres'].'"></td>';
            echo '<td><input class="form-control"   type="number"  name="fCelularPadres"      value="'.$unRegistro['celularPadres'].'"></td>';
            echo '<td><input class="form-control"  type="text"    name="fDireccionPadres"    value="'.$unRegistro['direccionPadres'].'"></td>';
            echo '<td><input class="form-control"  type="email"   name="fCorreoPadres"       value="'.$unRegistro['correoPadres'].'"></td>';
            echo '<td><input class="form-control" type="number"  name="fEstratoPadres"      value="'.$unRegistro['estratoPadres'].'"></td>';
            echo '<td><select  class="form-control" name="fIdParentescoPadres">';
            while($registroParentesco = mysqli_fetch_array($listaParentescos)){
                echo "<option value='".$registroParentesco['idParentesco']."'";
                if($unRegistro['idParentescoPadres']==$registroParentesco['idParentesco']){
                  echo " selected ";
                }
                echo ">{$registroParentesco['descripcionParentesco']}</option>";
             }
            mysqli_data_seek($listaParentescos,0);
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
   
         <tr><form id="fIngresarPadres" action="../controlador/ControladorPadres.php" method="post">
             <td><input type="hidden" name="fIdPadres" value="0">
             <input class="form-control"  type="text" name="fNombrePadres"></td>
             <td><input class="form-control"  type="text" name="fApellidoPadres"></td>
             <td><input class="form-control"  type="number" name="fDocumentoPadres"></td>
             <td><input class="form-control"  type="number" name="fCelularPadres"></td>
             <td><input class="form-control"  type="text" name="fDireccionPadres"></td>
             <td><input class="form-control" type="email" name="fCorreoPadres"></td>
             <td><input class="form-control" type="number" name="fEstratoPadres"></td>
             <td><select class="form-control"  name="fIdParentescoPadres" >
             <?php
                 while($registroParentesco = mysqli_fetch_array($listaParentescos)){
                     echo '<option value="'.$registroParentesco['idParentesco'].'">'.$registroParentesco['descripcionParentesco'].'</option>';
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
    $cantPaginas=$objetoPadres->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioPadres.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioPadres.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioPadres.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaParentescos);
    mysqli_free_result($listaPadres);
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