<?php
   class Padres{
       private $_conexion;
       private $_idPadres;
       private $_nombrePadres;
       private $_apellidoPadres;
       private $_documentoPadres;
       private $_celularPadres;
       private $_direccionPadres;
       private $_correoPadres;
       private $_estratoPadres;
       private $_idParentescoPadres;
       private $_paginacion = 10;
       
       function __construct($conexion, $idPadres, $nombrePadres, $apellidoPadres,  $documentoPadres, $celularPadres, $direccionPadres, $correoPadres, $estratoPadres, $idParentescoPadres){
           $this->_conexion = $conexion;
           $this->_idPadres = $idPadres;
           $this->_nombrePadres = $nombrePadres;
           $this->_apellidoPadres = $apellidoPadres;
           $this->_documentoPadres = $documentoPadres;
           $this->_celularPadres = $celularPadres;
           $this->_direccionPadres = $direccionPadres;
           $this->_correoPadres= $correoPadres;
           $this->_estratoPadres = $estratoPadres;
           $this->_idParentescoPadres = $idParentescoPadres;        
           
       }
       
       function __get($k){
           return $this->$k;
       }
       
       function __set($k,$v){
           $this->$k = $v;
       }
       
       function insertar(){ 
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Padres (idPadres, nombrePadres, apellidoPadres, documentoPadres, celularPadres, direccionPadres, correoPadres, estratoPadres, idParentescoPadres ) values (NULL, '$this->_nombrePadres', '$this->_apellidoPadres', '$this->_documentoPadres', '$this->_celularPadres', '$this->_direccionPadres', '$this->_correoPadres', '$this->_estratoPadres', '$this->_idParentescoPadres')") or die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Padres SET nombrePadres='$this->_nombrePadres', apellidoPadres='$this->_apellidoPadres',  documentoPadres='$this->_documentoPadres', celularPadres='$this->_celularPadres', direccionPadres='$this->_direccionPadres', correoPadres='$this->_correoPadres',  estratoPadres='$this->_estratoPadres', idParentescoPadres= '$this->_idParentescoPadres' WHERE idPadres=$this->_idPadres") or   die (mysqli_error($this->_conexion));
           session_start();
          $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
       function eliminar(){
           $elminacion = mysqli_query($this->_conexion,"DELETE FROM Padres WHERE idPadres=$this->_idPadres");
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idPadres)/$this->_paginacion) AS cantidad FROM padres") or die(mysqli_error($this->_conexion));
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Padres ORDER BY idPadres") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Padres ORDER BY idPadres LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>