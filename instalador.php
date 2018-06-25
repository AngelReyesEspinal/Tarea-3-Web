<!-- DEPENDENCIES -->
<?php 
    include('libreria/configx.php');
    include('libreria/conexion.php');
    include('libreria/crudInstalador.php');
    include('libreria/componentes.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Instalador</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- RESOURCES -->
        <link rel="stylesheet" href="css/estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    </head>
    <body>
        <!-- HEADER -->
        <nav>
            <div class='nav-wrapper red darken-1'>
                <a href='http://localhost/web/tarea3/instalador.php' class='brand-logo center'>DEBES CONFIGURAR TU BD</a>
            </div>
        </nav>

        <!--MAIN-->
        <main class="container"> 
            <!-- FORM -->
            <form action="" method="post" class="margenSuperiorInstalador">
                <div class="row">
                    
                    <?php 
                        input("el Host", "BD_HOST", "");
                        input("el Nombre de la Base de Datos", "BD_NAME", "");
                        input("el Usuario", "BD_USER", "");
                        input("La Contraseña", "BD_PASS", "");
                    ?>

                    <!-- submit -->
                    <button class='btn-large waves-effect red darken-1 right margenIzquierdo' type='submit'>
                        <i class='material-icons'>check</i>
                    </button>
                    <a href='instalador.php' class='waves-effect red darken-1 btn-large right'><i class='material-icons'>autorenew</i></a>
                </div>
            </form>

            <p style = "color: #b71c1c !important; font-size: 25px !important; text-align: center !important;"> <?php  echo $mensaje ?> </p>
        </main>
           
        <!-- FOOTER -->
        <?php include("footer.php"); ?>

        <!-- cdns -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    </body>
</html>