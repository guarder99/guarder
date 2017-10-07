<?php
   class Municipio{
       private $_conexion;
       private $_idMunicipio;
       private $_nombreMunicipio;
       private $_idDepartamentoMunicipio;
       private $_paginacion = 10;
       
       function __construct($conexion, $idMunicipio, $nombreMunicipio, $idDepartamentoMunicipio){
           $this->_conexion = $conexion;
           $this->_idMunicipio = $idMunicipio;
           $this->_nombreMunicipio = $nombreMunicipio;
           $this->_idDepartamentoMunicipio = $idDepartamentoMunicipio;
           
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           echo "INSERT INTO Municipio (idMunicipio, nombreMunicipio, idDepartamentoMunicipio) values (NULL,'$this->_nombreMunicipio', '$this->_idDepartamentoMunicipio')";
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Municipio (idMunicipio, nombreMunicipio, idDepartamentoMunicipio) values (NULL,'$this->_nombreMunicipio', '$this->_idDepartamentoMunicipio')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Municipio SET nombreMunicipio='$this->_nombreMunicipio', idDepartamentoMunicipio='$this->_idDepartamentoMunicipio'
           WHERE idMunicipio=$this->_idMunicipio") or 
               die (mysqli_error($this->_conexion));
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Municipio
           WHERE idMunicipio=$this->_idMunicipio") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idMunicipio)/$this->_paginacion) AS cantidad FROM municipio")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Municipio ORDER BY idMunicipio") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Municipio ORDER BY idMunicipio
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>