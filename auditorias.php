<?php
   class Auditoria{
       private $_conexion;
       private $_idAuditoria;
       private $_FechaAuditoria;
       private $_DescripcionAuditoria;
       private $_idUsuarioAuditoria;
       
       
       private $_paginacion = 10;
       
       function __construct($conexion, $idAuditoria, $FechaAuditoria, $DescripcionAuditoria, $idUsuarioAuditoria){
           $this->_conexion = $conexion;
           $this->_idAuditoria = $idAuditoria;
           $this->_FechaAuditoria = $FechaAuditoria;
           $this->_DescripcionAuditoria = $DescripcionAuditoria;
           $this->_idUsuarioAuditoria = $idUsuarioAuditoria;
           
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
       
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria, FechaAuditoria, DescripcionAuditoria, idUsuarioAuditoria) values (NULL,'$this->_FechaAuditoria','$this->_DescripcionAuditoria','$this->_idUsuarioAuditoria')") or 
               die (mysqli_error($this->_conexion));
           //$auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class.",".$_SESSION['idUsuario']."'CUERDATE()')");
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Auditoria SET FechaAuditoria='$this->_FechaAuditoria', descripcionAuditoria='$this->_descripcionAuditoria', idUsuarioAuditoria='$this->_idUsuarioAuditoria'
           WHERE idAuditoria=$this->_idAuditoria") or 
               die (mysqli_error($this->_conexion));
           //$auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class.",".$_SESSION['idUsuario']."'CUERDATE()')");
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Auditoria
           WHERE idAuditoria=$this->_idAuditoria");
           //$auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Inserto".static::class.",".$_SESSION['idUsuario']."'CUERDATE()')");
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idAuditoria)/$this->_paginacion) AS cantidad FROM auditoria")
                  or die(mysqli_error($this->_conexion));
           $unRegistro=mysqli_fetch_array($cantidadBloques);
           return $unRegistro['cantidad'];
       }
       function listar($pagina){
           if ($pagina<=0){
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Auditoria ORDER BY idAuditoria") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Auditoria ORDER BY idAuditoria
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>