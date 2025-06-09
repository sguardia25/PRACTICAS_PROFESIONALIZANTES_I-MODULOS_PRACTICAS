<?php
    class conexion{
        
        private $host="10.0.24.101";
        private $bd="jxkhkuhk_cen";
        private $usuario="jxkhkuhk_cen";
        private $contraseña="xo0RB+f-E}71";
        private $charset="utf8";
        public $conexion=null;
        function conectar(){
            try{
                $this->conexion=new PDO("mysql:host=$this->host;dbname=$this->bd", $this->usuario, $this->contraseña, 
                array(PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',));
            }catch (PDOException $error){
                echo $error->getMessage();
            }

        }
    }
    $conexion = new conexion();
    $conexion->conectar();
?>