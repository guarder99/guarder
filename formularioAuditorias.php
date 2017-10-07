<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Auditoria</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
     $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "auditoria";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Auditoria</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">FechaAuditoria</th>
        <th scope="col">DescripcionAuditoria</th>
        <th scope="col">idUsuario</th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/usuario.php");
        $objetoUsuario = new usuario($conexion,0,'nombre', 'correo', 'claves', 'fechaRegistro', 'celular', 'idRoles');
        $listaUsuarios = $objetoUsuario->listar(0);
        
        include_once("../modelo/auditorias.php");
        $objetoAuditoria = new auditoria($conexion,0,'fecha', 'Descripcion', 'idUsuario');
        $listaAuditorias = $objetoAuditoria->listar($pagina);
        while($unRegistro = mysqli_fetch_array($listaAuditorias)){
            echo '<tr><form id="fModificarAuditoria"'.$unRegistro["idAuditoria"].' action="../controlador/controladorAuditorias.php"
            method="post">';
            echo '<td><input class="form-control" type="hidden" name="fIdAuditoria" value="'.$unRegistro['idAuditoria'].'">';
            echo '<input class="form-control" type="date" name="fFechaAuditoria" value="'.$unRegistro['FechaAuditoria'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fDescripcionAuditoria" value="'.$unRegistro['DescripcionAuditoria'].'"></td>';
            echo '<td><select class="form-control" name="fIdUsuarioAuditoria">';
             while($registroUsuario = mysqli_fetch_array($listaUsuarios)){
                echo "<option value='".$registroUsuario['idUsuario']."'"; 
                if($unRegistro['idUsuarioAuditoria']==$registroUsuario['idUsuario']){
                  echo " selected ";
                  }
                   echo ">{$registroUsuario['nombreUsuario']}</option>";
               }
            mysqli_data_seek($listaUsuarios,0);
             echo '</select></td>';
            echo '</form></tr>';
        }
        ?>
         <tr><form id="fIngresarAuditoria" action="../controlador/ControladorAuditorias.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdAuditoria" value="0">
             <input class="form-control" type="date" name="fFechaAuditoria"></td>
             <td><input class="form-control" type="text" name="fDescripcionAuditoria"></td>
             <td><select class="form-control" name="fIdUsuarioAuditoria">
                 <?php
                 while($registroUsuario = mysqli_fetch_array($listaUsuarios)){
                     echo '<option  value="'.$registroUsuario['idUsuario'].'">' .$registroUsuario['nombreUsuario'].'</option>';
                 }
                 ?>
                 </select></td>
         </form></tr>
        
        </tbody>
    </table>
         <nav><ul class="pagination">
<?php
    $cantPaginas=$objetoAuditoria->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioAuditorias.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioAuditorias.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioAuditorias.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaUsuarios);
    mysqli_free_result($listaAuditorias);
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