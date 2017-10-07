<?php
   class Acudiente{
       private $_conexion;
       private $_idAcudiente;
       private $_nombreAcudiente;
       private $_cedulaAcudiente;
       private $_celularAcudiente;
       private $_parentescoAcudiente;
       
       private $_paginacion = 10;
       
       function __construct($conexion, $idAcudiente, $nombreAcudiente, $cedulaAcudiente, $celularAcudiente, $parentescoAcudiente){
           $this->_conexion = $conexion;
           $this->_idAcudiente = $idAcudiente;
           $this->_nombreAcudiente = $nombreAcudiente;
           $this->_cedulaAcudiente = $cedulaAcudiente;
           $this->_celularAcudiente = $celularAcudiente;
           $this->_parentescoAcudiente = $parentescoAcudiente;
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Acudiente (idAcudiente, nombreAcudiente, cedulaAcudiente,  celularAcudiente, parentescoAcudiente) values (NULL,'$this->_nombreAcudiente','$this->_cedulaAcudiente','$this->_celularAcudiente','$this->_parentescoAcudiente')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Acudiente SET nombreAcudiente='$this->_nombreAcudiente',  cedulaAcudiente='$this->_cedulaAcudiente', celularAcudiente='$this->_celularAcudiente',parentescoAcudiente='$this->_parentescoAcudiente'
           WHERE idAcudiente=$this->_idAcudiente") or   die (mysqli_error($this->_conexion));
            session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $modificacion;
       }
       function eliminar(){
           $elminacion = mysqli_query($this->_conexion,"DELETE FROM Acudiente
           WHERE idAcudiente=$this->_idAcudiente");
            session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idAcudiente)/$this->_paginacion) AS cantidad FROM acudiente")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Acudiente ORDER BY idAcudiente") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Acudiente ORDER BY idAcudiente
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>