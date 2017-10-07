<?php
session_start();
if(isset($_SESSION['id'])){  
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulario Roles</title>
     <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.min.js"></script>
    </head>
<body>
    <?php
      $pagina = (isset($_GET['pag']))?$_GET['pag']:1;
      $formulario = "roles";
      include_once("menu.php");
    ?>
    <div class="container-fluid">
    <header>
    <h1>Formulario Roles</h1>
    </header>
 <table class="table-striped">
    <tbody>
    <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Estudiante</th>
        <th scope="col">Municipio</th>
        <th scope="col">Departamento</th>
        <th scope="col">Padres</th>
        <th scope="col">Parentesco</th>
        <th scope="col">Incidencia</th>
        <th scope="col">Enfermedad</th>
        <th scope="col">Restricciones</th>
        <th scope="col">Avances</th>
        <th scope="col">Profesores</th>
        <th scope="col">Cursos</th>
        <th scope="col">Nivel</th>
        <th scope="col">Matricula</th>
        <th scope="col">Mensualidad</th>
        <th scope="col">Acudiente</th>
        <th scope="col">Usuario</th>
        <th scope="col">Roles</th>
    </tr>
    
<?php
        include_once("../modelo/conexion.php");
        $objetoConexion = new conexion();
        $conexion = $objetoConexion->conectar();
        
        include_once("../modelo/roles.php");
        $objetoRoles = new roles($conexion,0,'nombre', 'estudiante', 'municipio', 'departamento', 'padres', 'parentesco', 'incidente', 'enfermedad', 'restricciones', 'avances', 'profesores', 'cursos', 'nivel', 'matricula', 'mensualidad', 'acudiente', 'usuario', 'roles');
        $listaRoles = $objetoRoles->listar($pagina);
        $permiso = $objetoRoles->getRoles($_SESSION['id']);
        echo $permiso;
        if (stripos($permiso,"r")!==false){
        while($unRegistro = mysqli_fetch_array($listaRoles)){
            echo '<tr><form id="fModificarRoles"'.$unRegistro["idRoles"].' action="../controlador/controladorRoles.php"
            method="post">';
            echo '<td><input class="form-control" type="hidden" name="fIdRoles" value="'.$unRegistro['idRoles'].'">';
            echo '<input class="form-control" type="text" name="fNombreRoles" value="'.$unRegistro['nombreRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fEstudianteRoles" value="'.$unRegistro['estudianteRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fMunicipioRoles" value="'.$unRegistro['municipioRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fDepartamentoRoles" value="'.$unRegistro['departamentoRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fPadresRoles" value="'.$unRegistro['padresRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fParentescoRoles" value="'.$unRegistro['parentescoRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fIncidenciaRoles" value="'.$unRegistro['incidenciaRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fEnfermedadRoles" value="'.$unRegistro['enfermedadRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fRestriccionesRoles" value="'.$unRegistro['restriccionesRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fAvancesRoles" value="'.$unRegistro['avancesRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fProfesoresRoles" value="'.$unRegistro['profesoresRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fCursosRoles" value="'.$unRegistro['cursosRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fNivelRoles" value="'.$unRegistro['nivelRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fMatriculaRoles" value="'.$unRegistro['matriculaRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fMensualidadRoles" value="'.$unRegistro['mensualidadRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fAcudienteRoles" value="'.$unRegistro['acudienteRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fUsuarioRoles" value="'.$unRegistro['usuarioRoles'].'"></td>';
            echo '<td><input class="form-control" type="tex" name="fRolesRoles" value="'.$unRegistro['rolesRoles'].'"></td>';
            echo '<td>';
             if (stripos($permiso,"u")!==false){
            echo '<button class="btn btn-primary" class="btn btn-primary" type="Submit" name="fEnviar" value="Modificar" class=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
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
         <tr><form id="fIngresarRoles" action="../controlador/ControladorRoles.php" method="post">
             <td><input class="form-control" type="hidden" name="fIdRoles" value="0">
             <input class="form-control" type="text" name="fNombreRoles"></td>
             <td><input class="form-control" type="text" name="fEstudianteRoles" ></td>
             <td><input class="form-control" type="text" name="fMunicipioRoles" ></td>
             <td><input class="form-control" type="text" name="fDepartamentoRoles" ></td>
             <td><input class="form-control" type="text" name="fPadresRoles" ></td>
             <td><input class="form-control" type="text" name="fParentescoRoles" ></td>
             <td><input class="form-control" type="text" name="fIncidenciaRoles" ></td>
             <td><input class="form-control" type="text" name="fEnfermedadRoles" ></td>
             <td><input class="form-control" type="text" name="fRestriccionesRoles" ></td>
             <td><input class="form-control" type="text" name="fAvancesRoles" ></td>
             <td><input class="form-control" type="text" name="fProfesoresRoles" ></td>
             <td><input class="form-control" type="text" name="fCursosRoles" ></td>
             <td><input class="form-control" type="text" name="fNivelRoles" ></td>
             <td><input class="form-control" type="text" name="fMatriculaRoles" ></td>
             <td><input class="form-control" type="text" name="fMensualidadRoles" ></td>
             <td><input class="form-control" type="text" name="fAcudienteRoles" ></td>
             <td><input class="form-control" type="text" name="fUsuarioRoles" ></td>
             <td><input class="form-control" type="text" name="fRolesRoles" ></td>
            <td><button class="btn btn-primary" class="btn btn-primary" type="submit" name="fEnviar" value="Ingresar"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
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
    $cantPaginas=$objetoRoles->cantidadPaginas();
    if($cantPaginas>1){
        if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
            echo '<li><a href="formularioRoles.php?pag='.($pagina-1).'" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for($i=1;$i<=$cantPaginas;$i++){
            if($i==$pagina){
              echo '<li class="active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="formularioRoles.php?pag='.$i.'">'.$i.'</a></li>';
            }
        }
        if($pagina<$cantPaginas){ //mostrar el de ir adelantee cuando no sea la ultima pagina
            echo '<li><a href="formularioRoles.php?pag='.($pagina+1).'" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
		
?>	
	</ul>
</nav>
    <?php 
    mysqli_free_result($listaRoles);
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