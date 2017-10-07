<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Acudiente</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
     
<body>
    
    <?php
      $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "acudiente";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Acudiente</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Nombre Acudiente</th>
        <th scope="col">Cedula</th>
        <th scope="col">Celular</th>
        <th scope="col">Parentesco</th>
        
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/acudiente.php");
        $objetoAcudiente = new acudiente($conexion,0,'nombre', 'cedula', 'celular', 'parentesco');
        $listaAcudientes = $objetoAcudiente->listar($pagina);
        $permiso = $objetoAcudiente->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){  
        while($unRegistro = mysqli_fetch_array($listaAcudientes)){
            echo '<tr><form id="fModificarAcudiente"'.$unRegistro["idAcudiente"].' action="../controlador/controladorAcudiente.php"
            method="post">';
            echo '<td><input class="form-control"  type="hidden" name="fIdAcudiente" value="'.$unRegistro['idAcudiente'].'">';
            echo '<input  class="form-control"  type="text" name="fNombreAcudiente" value="'.$unRegistro['nombreAcudiente'].'"></td>';
            echo '<td><input class="form-control"  type="number" name="fCedulaAcudiente" value="'.$unRegistro['cedulaAcudiente'].'"></td>';
            echo '<td><input class="form-control"  type="number" name="fCelularAcudiente" value="'.$unRegistro['celularAcudiente'].'"></td>';
            echo '<td><input class="form-control"  type="text" name="fParentescoAcudiente" value="'.$unRegistro['parentescoAcudiente'].'"></td>';
             echo '<td>';
            if (stripos($permiso,"u")!==false){
               echo '<button class="btn btn-primary" type="Submit" name="fEnviar" value="Modificar" class=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
             }  //fin permiso u
             if (stripos($permiso,"d")!==false){
                echo '<button class="btn btn-danger" type="submit" name="fEnviar" value="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
             } //fin permiso d
             echo '</td>';
            echo '</form></tr>';
    } //fin while
}//fin permiso r
?>
<?php
    if (stripos($permiso,"c")!==false){  
?>
         <tr><form id="fIngresarAcudiente" action="../controlador/ControladorAcudiente.php" method="post">
             <td><input class="form-control"  type="hidden" name="fIdAcudiente" value="0">
             <input class="form-control"  type="text" name="fNombreAcudiente"></td>
             <td><input class="form-control"  type="number" name="fCedulaAcudiente"></td>
             <td><input class="form-control"  type="number" name="fCelularAcudiente" ></td>
             <td><input class="form-control"  type="text" name="fParentescoAcudiente" ></td>
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
    $cantPaginas=$objetoAcudiente->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioAcudiente.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioAcudiente.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioAcudiente.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
        
    <?php 
    mysqli_free_result($listaAcudientes);
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