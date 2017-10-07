<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Usuario</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
      $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "Usuario";
      include_once("menu.php");
    ?>
    <div class="container">
    <header>
    <h1>Formulario Usuario</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Clave</th>
        <th scope="col">Fecha Registro</th>
        <th scope="col">Celular</th>
        <th scope="col">IdRoles</th>
        
        <th scope="col"></th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/roles.php");
        $objetoRoles = new roles($conexion,0,'nombre', 'estudiantes', 'municipio', 'departamento', 'padres', 'parentesco', 'incidente', 'enfermedad', 'restricciones', 'avances', 'profesores', 'cursos', 'nivel', 'matricula', 'mensualidad', 'acudiente', 'usuario', 'rol');
        $listaRoles = $objetoRoles->listar(0);
        
        include_once("../modelo/usuario.php");
        $objetoUsuario = new usuario($conexion,0,'nombre', 'correo', 'claves', 'fechaRegistro', 'celular', 'idRoles');
        $listaUsuarios = $objetoUsuario->listar($pagina);
        $permiso = $objetoUsuario->getRoles($_SESSION['id']);
        
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaUsuarios)){
            echo '<tr><form id="fModificarUsuario"'.$unRegistro["idUsuario"].' action="../controlador/controladorUsuario.php"
            method="post">';
            echo '<td><input class="form-control"  type="hidden" name="fIdUsuario" value="'.$unRegistro['idUsuario'].'">';
            echo '<input class="form-control" type="text" name="fNombreUsuario" value="'.$unRegistro['nombreUsuario'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fCorreoUsuario" value="'.$unRegistro['correoUsuario'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fClaveUsuario" value="'.$unRegistro['claveUsuario'].'"></td>';
            echo '<td><input class="form-control" type="date" name="fFechaRegistroUsuario" value="'.$unRegistro['fechaRegistroUsuario'].'"></td>';
            echo '<td><input class="form-control" type="text" name="fCelularUsuario" value="'.$unRegistro['celularUsuario'].'"></td>';
            echo '<td><select class="form-control" name="fIdRolesUsuario">';
             while($registroRoles = mysqli_fetch_array($listaRoles)){
                echo "<option value='".$registroRoles['idRoles']."'"; 
                if($unRegistro['idRolesUsuario']==$registroRoles['idRoles']){
                  echo " selected ";
                  }
                   echo ">{$registroRoles['nombreRoles']}</option>";
               }
            mysqli_data_seek($listaRoles,0);
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
         <tr><form id="fIngresarUsuario" action="../controlador/ControladorUsuario.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdUsuario" value="0">
             <input class="form-control" type="text" name="fNombreUsuario"></td>
             <td><input class="form-control" type="text" name="fCorreoUsuario" ></td>
             <td><input class="form-control" type="text" name="fClaveUsuario" ></td>
             <td><input class="form-control" type="date" name="fFechaRegistroUsuario" ></td>
             <td><input class="form-control" type="text" name="fCelularUsuario" ></td>
             <td><select class="form-control" name="fIdRolesUsuario" >
                 <?php
                 while($registroRoles = mysqli_fetch_array($listaRoles)){
                     echo '<option  value="'.$registroRoles['idRoles'].'">' .$registroRoles['nombreRoles'].'</option>';
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
    $cantPaginas=$objetoUsuario->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioUsuario.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioUsuario.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioUsuario.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaRoles);
    mysqli_free_result($listaUsuarios);
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