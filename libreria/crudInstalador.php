<?php
    function noMostrarError() {}
    set_error_handler("noMostrarError");

    $mensaje = '';
    
    if($_POST){
        $enviar = true;

        if($_POST["BD_HOST"] == "" || $_POST["BD_NAME"] == "" || $_POST["BD_USER"] == ""){
            $mensaje = "Hay campos vacios!";
            $enviar = false;
        }

        if($enviar){
            extract($_POST);
            $bdLink = mysqli_connect($BD_HOST, $BD_USER, $BD_PASS);
            
            if($bdLink){
                
                $sql = "CREATE DATABASE IF NOT EXISTS $BD_NAME";
                mysqli_query($bdLink, $sql);
                mysqli_select_db($bdLink, $BD_NAME);

                $sql = 
                "
                    CREATE TABLE `lista` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `elemento` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                    `tipo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
                    PRIMARY KEY (id)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                
                ";
                mysqli_query($bdLink, $sql);

                $config = 
                "   
                    <?php 
                        define('DB_HOST', '$BD_HOST');
                        define('DB_USER', '$BD_USER');
                        define('DB_PASS', '$BD_PASS');
                        define('DB_NAME', '$BD_NAME');
                    ?>
                ";
                
                file_put_contents("libreria/configx.php", $config);
                echo "<script> window.location = 'index.php' </script>";
            
            } else {
                $mensaje = 'Ha ocurrido un error, por favor revisa la información suministrada.';
            }
        }
    }

?>