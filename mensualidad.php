<?php
   class Mensualidad{
       private $_conexion;
       private $_idMensualidad;
       private $_valorMensualidad;
       private $_mesPagoMensualidad;
       private $_fechaMensualidad;
       private $_idEstudiantesMensualidad;
       
       
       private $_paginacion = 10;
       
       function __construct($conexion, $idMensualidad, $valorMensualidad, $mesPagoMensualidad, $fechaMensualidad, $idEstudiantesMensualidad){
           $this->_conexion = $conexion;
           $this->_idMensualidad = $idMensualidad;
           $this->_valorMensualidad = $valorMensualidad;
           $this->_mesPagoMensualidad = $mesPagoMensualidad;
           $this->_fechaMensualidad = $fechaMensualidad;
           $this->_idEstudiantesMensualidad = $idEstudiantesMensualidad;
       }
       
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }

       function insertar(){ 
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Mensualidad (idMensualidad, valorMensualidad, mesPagoMensualidad, fechaMensualidad, idEstudiantesMensualidad) values (NULL,'$this->_valorMensualidad','$this->_mesPagoMensualidad','$this->_fechaMensualidad','$this->_idEstudiantesMensualidad')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Mensualidad SET valorMensualidad='$this->_valorMensualidad', mesPagoMensualidad='$this->_mesPagoMensualidad', fechaMensualidad='$this->_fechaMensualidad', idEstudiantesMensualidad='$this->_idEstudiantesMensualidad'
           WHERE idMensualidad=$this->_idMensualidad") or 
               die (mysqli_error($this->_conexion));
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Mensualidad
           WHERE idMensualidad=$this->_idMensualidad");
            session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idMensualidad)/$this->_paginacion) AS cantidad FROM mensualidad")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Mensualidad ORDER BY idMensualidad") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Mensualidad ORDER BY idMensualidad
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>