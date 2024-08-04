<?php
    include_once 'login/db/funciones_db.php';
    include_once 'login/funciones_basicas.php';
    session_start();
    if (isset($_POST["cerrar_sesion"])) {
        $_SESSION = array();
        header('Location: login/');
        exit;
    }


    if (!isset($_SESSION["tokken"])) {
        header('Location: login/');
        echo "No hay sesión iniciada";
        exit;
    }
    if (!comprobar_login("./login/")) {
        header('Location: login/');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <style>
        html {
            background: #232327;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap; /* Esta línea permite que los elementos se envuelvan a la siguiente línea si no hay suficiente espacio */
        }

        #container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap; /* Esta línea permite que los elementos se envuelvan a la siguiente línea si no hay suficiente espacio */


        }
        a {
            margin: 10px;
            font-size: 6vh;
            font-weight: bold;
            padding: 5vh;
            background: blue;
            color: white; /* Agrega color al texto para mayor contraste */
            text-decoration: none; /* Elimina la subrayado predeterminado de los enlaces */
            border-radius: 3vh;
            border: 1vh solid white;
        }
        #jellyfin {
            background: linear-gradient(90deg, #6E4693 0%, #149CD9 100%);
        }
        #sonarr {
            background: #00C8F9;
        }
        #lidarr {
            background: #085230;
        }
        #netdata {
            background: #00AB44;
        }
        #pihole {
            background: #F70000;
        }
        #jackett {
            background: #F0AD4E;
        }
        #qbittorrent {
            background: linear-gradient(90deg, #6CB2F8 0%, #3974BA 100%);
        }
        footer {
            position: fixed;
            bottom: 0;
            padding: 10px;
            width: 100%;
            text-align: center;
            background: #232327;
            color: white;
        }


    </style>
</head>
<body>
    <div id="container">
        <?php
            $ip = $_SERVER['HTTP_HOST'];

            // Definimos los IDs de los enlaces
            $ids = array("jellyfin", "sonarr", "lidarr", "netdata", "pihole", "jackett", "qbittorrent");

            // Generamos los enlaces
            foreach ($ids as $id) {
                echo "<a href='https://$ip/$id' id='$id'>$id</a><br>";
            }
        ?>
    </div>
</body>
<footer>
    <form method="post">
        <input type="submit" name="cerrar_sesion" value="Cerrar sesión">
    </form>
</html>
