<?php
    # INPUTS
    function input($id, $nombre, $tipo="", $contenido=""){
        if($contenido == "")
            if(isset($_POST[$nombre]))
                $contenido = $_POST[$nombre];

        $input = " <input id='$id' type='text' class='validate' value='$contenido' name='$nombre'> "; 

        if($tipo == "textarea")
            $input = " <textarea id='$id' class='materialize-textarea' name='$nombre'> $contenido </textarea> ";
        
        echo 
        "
            <div class='input-field col s12'>
                <i class='material-icons prefix'>verified_user</i>
                $input
                <label for='$id' class='negrita'>Introduzca $id:</label> 
            </div>
        ";
    }
?>