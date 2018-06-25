<?php
    include("libreria/../configx.php");
    include("libreria/../conexion.php");
    
    if($_POST){
        $conn = Conexion::getInstancia();
        $accion = $_POST['accion'];
    
        switch ($accion):
            case 'Agregar':
                if($_POST['elemento'] != ""){
                    agregarElemento($_POST['elemento'], $_POST['lista'], $conn);
                }
                break;
            case 'Eliminar':
                eliminarElemento($_POST['id'] + 0, $conn);
                break;
            default:
                cambiarDeListado($_POST["id"], $_POST["lista"], $conn);
                break;
        endswitch;
    }

    # AGREGAR
    function agregarElemento($elemento, $lista, $conn){
        # Validar que no existe ese elemento:
        $elementos = mostrarElementos("SELECT * FROM Lista");
        $noExisteElemento = true;

        foreach ($elementos as $element) {
            if(strtoupper($element->elemento) == strtoupper($elemento)){
                $noExisteElemento = false;
            }
        }

        if($noExisteElemento){
            $sql = "INSERT INTO lista (elemento, tipo) VALUES  (?,?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $elemento, $lista);
            mysqli_stmt_execute($stmt);
        }
    }

    # MOSTRAR
    function mostrarElementos($sql){
        $conn = Conexion::getInstancia();
        $rs = mysqli_query($conn, $sql);

        $datos = array();
        
        while ($fila = mysqli_fetch_object($rs)) {
            $datos[] = $fila;
        }

        return $datos;
    }

    # ELIMINAR
    function eliminarElemento($id, $conn){
        $sql = "DELETE FROM lista WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }

    # CAMBIAR DE LISTA
    function cambiarDeListado($id, $lista, $conn){
        $sql = "UPDATE lista SET tipo = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $lista, $id);
        mysqli_stmt_execute($stmt);
    }
?>