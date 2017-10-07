<?php
   class Nivel{
       private $_conexion;
       private $_idNivel;
       private $_nombreNivel;
       private $_paginacion = 10;
       
       function __construct($conexion, $idNivel, $nombreNivel){
           $this->_conexion = $conexion;
           $this->_idNivel = $idNivel;
           $this->_nombreNivel= $nombreNivel;
           
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Nivel (idNivel, nombreNivel) values (NULL,'$this->_nombreNivel')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Nivel SET nombreNivel='$this->_nombreNivel'
           WHERE idNivel=$this->_idNivel") or 
               die (mysqli_error($this->_conexion));
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Nivel
           WHERE idNivel=$this->_idNivel");
            session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idNivel)/$this->_paginacion) AS cantidad FROM nivel")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Nivel ORDER BY idNivel") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Nivel ORDER BY idNivel
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>