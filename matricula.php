<?php
   class Matricula{
       private $_conexion;
       private $_idMatricula;
       private $_fechaMatricula;
       private $_valorMatricula;
       private $_idEstudiantesMatricula;
       private $_idCursosMatricula;
       
       
       private $_paginacion = 10;
       
       function __construct($conexion, $idMatricula, $fechaMatricula, $valorMatricula, $idEstudiantesMatricula, $idCursosMatricula){
           $this->_conexion = $conexion;
           $this->_idMatricula = $idMatricula;
           $this->_fechaMatricula = $fechaMatricula;
           $this->_valorMatricula = $valorMatricula;
           $this->_idEstudiantesMatricula = $idEstudiantesMatricula;
           $this->_idCursosMatricula = $idCursosMatricula;
           
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Matricula (idMatricula, fechaMatricula, valorMatricula, idEstudiantesMatricula, idCursosMatricula) values (NULL,'$this->_fechaMatricula','$this->_valorMatricula','$this->_idEstudiantesMatricula','$this->_idCursosMatricula')") or 
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Matricula SET fechaMatricula='$this->_fechaMatricula', valorMatricula='$this->_valorMatricula', idEstudiantesMatricula='$this->_idEstudiantesMatricula', idCursosMatricula='$this->_idCursosMatricula'
           WHERE idMatricula=$this->_idMatricula") or  die (mysqli_error($this->_conexion));
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Matricula
           WHERE idMatricula=$this->_idMatricula");
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idMatricula)/$this->_paginacion) AS cantidad FROM matricula")
                  or die(mysqli_error($this->_conexion));
           $unRegistro=mysqli_fetch_array($cantidadBloques);
           return $unRegistro['cantidad'];
       }
       function getRoles($idUsuario){
        $roles=mysqli_query($this->_conexion, "SELECT ".static::class."roles AS elpermiso FROM roles WHERE idRoles IN(SELECT idRolesUsuario FROM Usuario WHERE idusuario =$idUsuario)") or die (mysqli_error($this->_conexion));
        $unregistro=mysqli_fetch_array($roles);
        return $unregistro['elpermiso'];
    }
       function listar($pagina){
           if ($pagina<=0){
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Matricula ORDER BY idMatricula") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Matricula ORDER BY idMatricula
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>