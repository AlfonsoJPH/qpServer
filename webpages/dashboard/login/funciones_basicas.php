<?php
    include_once 'db/funciones_db.php';
    function login($username, $password){
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $db = inicio_sesion("./");

        $query = "SELECT * FROM usuarios WHERE username = ?";
        try{
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $password_db = mysqli_fetch_assoc($result)["password"];
        } catch (Exception $e){
            echo <<< HTML
                <h2>NO SE HAN PODIDO INSERTAR LOS DATOS CORRECTAMENTE EN LA BD</h2>
            HTML;
            fin_sesion($db);
            return false;
        }
        fin_sesion($db);
        if (hash('sha256', $password."AJ1029PH")  == $password_db){
            $_SESSION["username"] = $username;
            $_SESSION["tokken"] = hash('sha256', $username . $password_db . "AJ1029PH");
        }
        return true;
    }

    function comprobar_login($path){
        if (session_status() !== PHP_SESSION_NONE){
            if (isset($_SESSION["tokken"])){
                $db = inicio_sesion($path);
                $query = "SELECT * FROM usuarios WHERE username = ?";
                try{
                    $stmt = mysqli_prepare($db, $query);
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $result = mysqli_fetch_assoc($result);
                    $password = $result["password"];
                    $autorizado = $result["autorizado"];
                } catch (Exception $e){
                    echo <<< HTML
                        <h2>NO SE HAN PODIDO INSERTAR LOS DATOS CORRECTAMENTE EN LA BD</h2>
                    HTML;
                    fin_sesion($db);
                    return false;
                }
                fin_sesion($db);
                if ($_SESSION["tokken"] == hash('sha256', $_SESSION["username"] . $password . "AJ1029PH")){
                    return $autorizado;
                }
            }
        }
        return false;
    }

    function logout(){
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION = array();
    }

    function register($username, $password, $email){
        $db = inicio_sesion("./");
        //hazlas seguro frente a inyecciones sql
        $query = "INSERT INTO usuarios(username, password, email) VALUES (?, ?, ?)";
        $password = hash('sha256', $password . "AJ1029PH");
        try{
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);
            mysqli_stmt_execute($stmt);
        } catch (Exception $e){
            echo <<< HTML
                <h2>NO SE HAN PODIDO INSERTAR LOS DATOS CORRECTAMENTE EN LA BD</h2>
            HTML;
            fin_sesion($db);
            return false;
        }

        fin_sesion($db);
        return true;
    }

    function autorizar($username){
        $db = inicio_sesion("./");
        $query = "UPDATE usuarios SET autorizado = 0 WHERE username = ?";
        try{
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
        } catch (Exception $e){
            echo <<< HTML
                <h2>NO SE HAN PODIDO INSERTAR LOS DATOS CORRECTAMENTE EN LA BD</h2>
            HTML;
            fin_sesion($db);
            return false;
        }

        fin_sesion($db);
        echo <<< HTML
            <h2>El usuario $username ha sido autorizado.</h2>
        HTML;
    }

?>
