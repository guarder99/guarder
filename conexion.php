<?php 
 class Conexion{
    function conectar(){
        $conexion= mysqli_connect("localhost","root","","guarder");
        mysqli_query($conexion,"SET NAMES 'utf8'");
        return $conexion;
    }
     function desconectar($conexion){
         mysqli_close($conexion);
     }
 }
?>