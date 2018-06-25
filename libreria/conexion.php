<?php
    class Conexion{
        private static $instancia = null;
        private $con;

        function __construct(){
            $this->con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("<script> window.location = 'instalador.php' </script>");
        }

        public static function getInstancia(){
            if(self::$instancia == null)
                self::$instancia = new Conexion();
            
            return self::$instancia->con;
        }

        function __destruct(){
            mysqli_close($this->con);
        }
    }
?>