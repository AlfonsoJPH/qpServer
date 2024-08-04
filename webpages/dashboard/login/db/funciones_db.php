<?php
    function inicio_sesion($path){
        $mensaje = json_decode(file_get_contents("{$path}db/acceso.json"), true);
        $db = mysqli_connect($mensaje["DB_HOST"], $mensaje["DB_USER"], $mensaje["DB_PASSWORD"], $mensaje["DB_NAME"]);
        if ($db) {
            $msgconex = 'Conexión con éxito';
            mysqli_set_charset($db, 'utf8');
        } else {
            $msgconex = 'Error de conexión (' . mysqli_connect_errno() . '): ' . mysqli_connect_error();
        }
        return $db;
    }
    function fin_sesion($db){
        mysqli_close($db);
    }
    function insertar_usuario($db,$username,$password,$email){
        $query = "INSERT INTO usuarios(username, password, email) VALUES ('$username', '$password', '$email')";
        if(mysqli_query($db, $query)){
            echo <<< HTML
                <h2>SE HAN INSERTADO CORRECTAMENTE LOS DATOS</h2>
            HTML;
        } else {
            echo <<< HTML
                <h2>NO SE HAN PODIDO INSERTAR LOS DATOS CORRECTAMENTE EN LA BD</h2>
            HTML;
        }
    }

?>
