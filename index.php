<?php
    include("libreria/crud.php"); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Tarea III</title>

        <!-- Resources -->
        <link rel="stylesheet" href="css/estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    </head>
    <body>
        <!-- HEADER -->
        <?php include("header.php"); ?>

        <!-- MAIN -->
        <main class="container marginTop">
    
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">add</i>
                        <input id="elemento" type="text" class="validate" name="elemento" require/>
                        <label for="elemento">Elemento </label>
                    </div>

                    <br/>
                    <div class="col s3">
                        <p>
                            <label>
                                <input class="with-gap" name="radios" type="radio" checked  value="A" id="A"/>
                                <span>Lista A</span>
                            </label>
                            <label>
                                <input class="with-gap" name="radios" type="radio" value="B" id="B"/>
                                <span>Lista B</span>
                            </label>
                        </p> 
                    </div>

                    <div class="col s3">
                        <button class="btn waves-effect red darken-1" onclick="Agregar($('#elemento').val(), $('input:radio[name=radios]:checked').val())">
                            Agregar
                        </button>
                    </div>       
                </div>
            </div>
            
            <hr/>

            <div class="row">
                <!-- Lista A -->
                <div class="col s5">
                    <h3>Lista A</h3>
        
                    <div class="card red darken-1 formatoCarta">
                        <div class="card-content white-text">
                            <?php 
                                $elementosA = mostrarElementos("SELECT * FROM lista WHERE tipo = 'A'");
                                if($elementosA != null){
                                    foreach ($elementosA as $elemento) { ?>
                                            
                                    <li id="<?php echo $elemento->id ?>" type="square" class="elemento" onclick="seleccionar(<?php echo $elemento->id ?>, '<?php echo $elemento->elemento ?>', 'A')"> 
                                        <?php echo $elemento->elemento ?> 
                                    </li>
                                
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="col s2">
                    <button class="btn waves-effect red darken-1 margenes" onclick="cambiarDeListado('B')"> >>>>>> </button>
                    <button class="btn waves-effect red darken-1 margenes" onclick="cambiarDeListado('A')"> <<<<<< </button>
                    <button class="btn waves-effect red darken-1 margenes" onclick="eliminar()"> ELIMINAR </button>
                </div>

                <!-- Lista B -->
                <div class="col s5">
                    <h3>Lista B</h3>
                    
                    <div class="card red darken-1 formatoCarta">
                        <div class="card-content white-text">
                            <?php 
                                $elementosB = mostrarElementos("SELECT * FROM Lista WHERE tipo = 'B'");
                                if($elementosB != null){
                                    foreach ($elementosB as $elemento) { ?>
                                            
                                    <li id="<?php echo $elemento->id ?>" type="square" class="elemento" onclick="seleccionar(<?php echo $elemento->id ?>, '<?php echo $elemento->elemento ?>', 'ListaB')"> 
                                        <?php echo $elemento->elemento ?> 
                                    </li>
                                
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>    
            </div>
        </main>

        <!-- FOOTER -->
        <?php include("footer.php"); ?>
        
        <!-- cdns -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        
        <!-- Scripts js -->
        <script type="text/javascript">
            var elementos = [];
        
            // Constructor del objeto Elemento
            function Elemento(id, elemento, lista){
                this.id = id;
                this.elemento = elemento; 
                this.lista = lista;
            }

            //Metodo Agregar
            function Agregar(elemento, lista){             
                if($("#elemento").val() != ""){
                    var parametros = {
                        accion: 'Agregar',
                        elemento: elemento,
                        lista: lista
                    }
                    
                    $.ajax({
                        data: parametros,
                        url:  "libreria/crud.php",
                        type: 'post',
                        success:  function (response) {
                            window.location = 'index.php'
                        }
                    });
                } else {
                    alert('¡Debes escribir un elemento a agregar!');
                }
            }
            
            // Metodo seleccionar
            function seleccionar(id, elemento, lista){
                var existeElemento = false;
                var posicionElemento;
                var toast = "";
                    
                for (let i = 0; i < elementos.length; i++) {
                    if(elementos[i].id == id){ 
                        posicionElemento = i; 
                        existeElemento = true;
                    }
                }
            
                if(existeElemento){
                    document.getElementById(id).className = 'elementoDeseleccionado';
                    (lista == 'A' ? toast = '¡Deseleccionaste un elemento de la Lista A!'  : toast = '¡Deseleccionaste un elemento de la Lista B!')
                    M.toast({html: toast });
                    elementos.splice(posicionElemento, 1);       
                } else {
                    document.getElementById(id).className = 'elementoSeleccionado'; 
                    (lista == 'A' ? toast = '¡Seleccionaste un elemento de la Lista A!'  : toast = '¡Seleccionaste un elemento de la Lista B!')
                    M.toast({html: toast });
                    var elemento = new Elemento(id, elemento, lista);
                    elementos.push(elemento);              
                }            
            }
            
            // Metodo eliminar
            function eliminar(){
                if(elementos != ""){
                    for (let i = 0; i < elementos.length; i++) {
                        var parametros = {
                            accion: 'Eliminar',
                            id: elementos[i].id,
                        }
                        
                        $.ajax({
                            data: parametros,
                            url:  "libreria/crud.php",
                            type: 'post',
                            success:  function (response) {
                                window.location = 'index.php'
                            }
                        });
                    }
                } else {
                    alert("Debes seleccionar almenos un elemento.");
                }
            }

            // Metodo cambiar listado
            function cambiarDeListado(listaTarget){
                for (let i = 0; i < elementos.length; i++) {
                    var parametros = {
                        accion: 'Cambiar',
                        id: elementos[i].id,
                        lista: listaTarget
                    }
                    
                    $.ajax({
                        data: parametros,
                        url:  "libreria/crud.php",
                        type: 'post',
                        success:  function (response) {
                            window.location = 'index.php'
                        }
                    });
                }
            }
        </script>
    </body>
</html>