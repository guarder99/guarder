<?php
   class Incidencia{
       private $_conexion;
       private $_idIncidencia;
       private $_fechayHoraIncidencia;
       private $_decripcionIncidencia;
       private $_idEnfermedadIncidencia;
       private $_idEstudianteIncidencia;
       private $_paginacion = 10;
       
       function __construct($conexion, $idIncidencia, $fechayHoraIncidencia, $descripcionIncidencia, $idEnfermedadIncidencia, $idEstudianteIncidencia){
           $this->_conexion = $conexion;
           $this->_idIncidencia = $idIncidencia;
           $this->_fechayHoraIncidencia = $fechayHoraIncidencia;
           $this->_descripcionIncidencia = $descripcionIncidencia;
           $this->_idEnfermedadIncidencia= $idEnfermedadIncidencia;
           $this->_idEstudianteIncidencia= $idEstudianteIncidencia;
           
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Incidencia (idIncidencia, fechayHoraIncidencia, descripcionIncidencia, idEnfermedadIncidencia, idEstudianteIncidencia) values (NULL,'$this->_fechayHoraIncidencia','$this->_descripcionIncidencia','$this->_idEnfermedadIncidencia','$this->_idEstudianteIncidencia')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Incidencia SET fechayHoraIncidencia='$this->_fechayHoraIncidencia', descripcionIncidencia='$this->_descripcionIncidencia', idEnfermedadIncidencia='$this->_idEnfermedadIncidencia',idEstudianteIncidencia='$this->_idEstudianteIncidencia'  
           WHERE idIncidencia=$this->_idIncidencia") or 
               die (mysqli_error($this->_conexion));
          session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));;
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Incidencia
           WHERE idIncidencia=$this->_idIncidencia");
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));;
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idIncidencia)/$this->_paginacion) AS cantidad FROM Incidencia")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Incidencia ORDER BY idIncidencia") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Incidencia ORDER BY idIncidencia
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>