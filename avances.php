<?php
   class Avances{
       private $_conexion;
       private $_idAvances;
       private $_fechaAvances;
       private $_avancesFisicos;
       private $_avancesGeneral;
       private $_avancesVerbal;
       private $_avancesSocial;
       private $_avancesMatematicos;
       private $_idEstudianteAvance;
       
       private $_paginacion = 10;
       
       function __construct($conexion, $idAvances, $fechaAvances, $avancesFisicos, $avancesGeneral, $avancesVerbal, $avancesSocial,$avancesMatematicos, $idEstudianteAvance){
           $this->_conexion = $conexion;
           $this->_idAvances = $idAvances;
           $this->_fechaAvances = $fechaAvances;
           $this->_avancesFisicos = $avancesFisicos;
           $this->_avancesGeneral = $avancesGeneral;
           $this->_avancesVerbal = $avancesVerbal;
           $this->_avancesSocial = $avancesSocial;
           $this->_avancesMatematicos = $avancesMatematicos;
           $this->_idEstudianteAvance = $idEstudianteAvance;
       }
       function __get($k){
           return $this->$k;
       }
       function __set($k,$v){
           $this->$k = $v;
       }
       function insertar(){
           $insercion = mysqli_query($this->_conexion,"INSERT INTO Avances (idAvances, fechaAvances, avancesFisicos, avancesGeneral, avancesVerbal, avancesSocial, avancesMatematicos, idEstudianteAvance) values (NULL,'$this->_fechaAvances','$this->_avancesFisicos','$this->_avancesGeneral','$this->_avancesVerbal','$this->_avancesSocial','$this->_avancesMatematicos','$this->_idEstudianteAvance')") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));
           return $insercion;
          }
       
       function modificar(){
           $modificacion = mysqli_query($this->_conexion,"UPDATE Avances SET fechaAvances='$this->_fechaAvances', avancesFisicos='$this->_avancesFisicos', avancesGeneral='$this->_avancesGeneral', avancesVerbal='$this->_avancesGeneral', avancesSocial='$this->_avancesSocial', avancesMatematicos='$this->_avancesMatematicos', idEstudianteAvance='$this->_idEstudianteAvance'
           WHERE idAvances=$this->_idAvances") or 
               die (mysqli_error($this->_conexion));
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Modifico".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));;
           return $modificacion;
       }
       function eliminar(){
           $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Avances
           WHERE idAvances=$this->_idAvances");
           session_start();
           $auditoria = mysqli_query($this->_conexion,"INSERT INTO Auditoria (idAuditoria,descripcionAuditoria,idUsuarioAuditoria,fechaAuditoria) values (NULL,'Elimino".static::class."',".$_SESSION['id'].",CURDATE())") or die (mysqli_error($this->_conexion));;
           return $eliminacion;
       }
       function cantidadPaginas(){
           $cantidadBloques=mysqli_query($this->_conexion,
                "SELECT CEIL(COUNT(idAvances)/$this->_paginacion) AS cantidad FROM avances")
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
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Avances ORDER BY idAvances") or 
               die (mysqli_error($this->_conexion));
           }else{
               $paginacionMax = $pagina * $this->_paginacion;
               $paginacionMin = $paginacionMax - $this->_paginacion;
               $listado = mysqli_query($this->_conexion,"SELECT * FROM Avances ORDER BY idAvances
               LIMIT $paginacionMin, $paginacionMax") or die(mysqli_error($this->_conexion));
           }
           return $listado;
       }    
   }
?>