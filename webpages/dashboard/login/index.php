<?php
session_start();
require 'funciones_basicas.php'; // Aquí se supone que tienes las funciones de inserción, login y recuperación

// Inicialización de variables para mensajes de error y éxito
$login_error = '';
$register_error = '';
$success_message = '';

// Gestión de peticiones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['login_username'];
        $password = $_POST['login_password'];
        if (empty($username) || empty($password)) {
            $login_error = 'Nombre de usuario o contraseña incorrectos.';
            return;
        }

        if (login($username, $password)) {
            echo "Login correcto";
            header('Location: ../'); // Redirigir a la página del dashboard
            exit;
        } else {
            $login_error = 'Nombre de usuario o contraseña incorrectos.';
        }
    } elseif (isset($_POST['register'])) {
        // Procesar el registro
        // Comprobar injecciones sql
        $username = $_POST['register_username'];
        $password = $_POST['register_password'];
        $email = $_POST['register_email'];

        if (register($username, $password, $email)) {
            $success_message = 'Registro exitoso. Ahora puedes iniciar sesión.';
        } else {
            $register_error = 'Error al registrar. El nombre de usuario o el correo electrónico ya existen.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="styles.css"> <!-- Suponiendo que tienes un archivo CSS para el estilo -->
</head>
<body>
    <div class="container">
        <h1>Bienvenido</h1>

        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <div class="form-container">
            <!-- Formulario de inicio de sesión -->
            <form action="index.php" method="POST">
                <h2>Iniciar sesión</h2>
                <input type="text" name="login_username" placeholder="Nombre de usuario" required>
                <input type="password" name="login_password" placeholder="Contraseña" required>
                <button type="submit" name="login">Iniciar sesión</button>
                <?php if (!empty($login_error)): ?>
                    <div class="error-message"><?php echo $login_error; ?></div>
                <?php endif; ?>
            </form>

            <!-- Formulario de registro -->
            <form action="index.php" method="POST">
                <h2>Registrarse</h2>
                <input type="text" name="register_username" placeholder="Nombre de usuario" required>
                <input type="password" name="register_password" placeholder="Contraseña" required>
                <input type="email" name="register_email" placeholder="Correo electrónico" required>
                <button type="submit" name="register">Registrarse</button>
                <?php if (!empty($register_error)): ?>
                    <div class="error-message"><?php echo $register_error; ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
