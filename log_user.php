<?php $mensaje = ''; ?>
<?php include('conf/conn.php'); ?>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { 

        $userOrEmail = $conn->real_escape_string($_POST['userOrEmail']);
        $pass = $_POST['password'];  
        $sql = "SELECT * FROM users_om WHERE (username = '$userOrEmail' OR email = '$userOrEmail')";
        
        $result = $conn->query($sql);

        if ($result === false) {
            // Muestra el error de SQL si la consulta falla
            echo "Error en la consulta SQL: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                // Obtener los datos del usuario
                $user = $result->fetch_assoc();
        
                if (password_verify($pass, $user['pass'])) {
                    // Iniciar sesión y guardar los datos del usuario en la sesión
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['tipo_usuario'] = $user['tipo_user'];
                    $_SESSION['nombre_completo'] = $user['nombre'].' '.$user['apellido'];
        
                    echo "Login exitoso. Bienvenido, " . $user['username'] . "!";

                    header("Location: perfil.php");
                    exit();
                } else {
                    echo "Contraseña incorrecta.";
                }
            } else {
                echo "Usuario o correo electrónico no encontrado.";
            }
        }

        $conn->close();

} ?>


<!DOCTYPE html>
<html lang="en">
<?php include('recurrentes/head.php'); ?>
<body>
    <!-- Navigation-->
    <?php include('recurrentes/menu.php'); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">User Login</h1>
                <p class="lead fw-normal text-white-50 mb-0">Ingresa a tu cuenta</p>
            </div>
        </div>
    </header>
    <!-- Login Form Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="userOrEmail" type="text" placeholder="name@example.com" />
                                    <label for="email">Email o usuario</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="password" type="password" placeholder="Password" />
                                    <label for="password">Password</label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" value="" />
                                    <label class="form-check-label" for="rememberPasswordCheck">Recordar</label>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="#!">Olvido su password?</a>
                                    <button class="btn btn-outline-dark" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a href="user_reg.php">No tienes una cuenta? Registrate!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('recurrentes/foot.php'); ?>
</body>
</html>
