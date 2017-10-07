<?php
   class Cursos{
       private $_conexion;
       private $_idCursos;
       private $_gradosCursos;
       private $_idProfesoresCursos;
       private $_idNivelCursos;
       private $_idAuxiliarCursos;
       
       
       private $_paginacion = 10;
       
       function __construct($conexion, $idCursos, $gradosCursos, $idProfesoresCursos, $idNivelCursos, $idAuxiliarCursos){
           $this->_conexion = $conexion;
           $this->_idCursos = $idCursos;
           $this->_gradosCursos = $gradosCursos;
           $this->_idProfesoresCursos = $idProfesoresCursos;
           $this->_idNivelCursos = $idNivelCursos;
           $this->_idAuxiliarCursos = $idAuxiliarCursos;
           
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Cursos (idCursos, gradosCursos, idProfesoresCursos, idNivelCursos, idAuxiliarCursos) values (NULL,'$this->_gradosCursos','$this->_idProfesoresCursos','$this->_idNivelCursos','$this->_idAuxiliarCursos')") or 
               die (mysqli_error($this->_conexion));
            session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Cursos SET gradosCursos='$this->_gradosCursos', idProfesoresCursos='$this->_idProfesoresCursos', idNivelCursos='$this->_idNivelCursos', idAuxiliarCursos='$this->_idAuxiliarCursos'
           WHERE idCursos=$this->_idCursos") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));;
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Cursos
           WHERE idCursos=$this->_idCursos");
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));;
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idCursos)/$this->_paginacion) AS cantidad FROM cursos")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Cursos ORDER BY idCursos") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Cursos ORDER BY idCursos
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>