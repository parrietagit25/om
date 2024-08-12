<?php require 'vendor/autoload.php'; 
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
?>
<?php $mensaje = ''; ?>
<?php include('conf/conn.php'); ?>
<?php if(isset($_POST['reg_ueer'])){

        $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        unset($_POST['reg_ueer']);
        $_POST['stat'] = 1;
        $_POST['tipo_user'] = 2;

        insert_reg("users_om", $_POST, $conn);

        $mensaje = 'Registre Realizado';

          // Incluir el autoload de Composer para PHPMailer

        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor de correo SMTP
            $mail->isSMTP();
            $mail->Host = 'mail.ofmptygroup.com';  // Servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'pedro.arrieta@ofmptygroup.com';  // Usuario SMTP
            $mail->Password = '';  // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Encriptación TLS
            $mail->Port = 465;  // Puerto TCP para TLS

            // Destinatarios
            $mail->setFrom('ofertasymas@ofmptygroup.com', 'Ofmpt y Group');  // Correo y nombre del remitente
            $mail->addAddress('destinatario@example.com', 'Nombre del Destinatario');  // Añadir destinatario

            // Contenido del correo
            $mail->isHTML(true);  // Establecer el correo como HTML
            $mail->Subject = 'Aquí está tu PDF';
            $mail->Body = 'Este es el cuerpo del correo. Adjunto encontrarás el PDF que solicitaste.';

            // Adjuntar el archivo PDF generado
            $mail->addAttachment('documento.pdf');  // Adjuntar el PDF

            // Enviar el correo
            $mail->send();
            echo 'El mensaje ha sido enviado con éxito';
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
        }

} ?>
<!DOCTYPE html>
<html lang="en">
<?php include('recurrentes/head.php'); ?>
<body>
    <!-- Navigation-->
    <?php include('recurrentes/menu.php'); ?>
    <!-- Header-->
    <?php echo $mensaje; ?>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">User Registration</h1>
                <p class="lead fw-normal text-white-50 mb-0">Create your account below</p>
            </div>
        </div>
    </header>
    <!-- Registration Form Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Register</h3></div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="username" type="text" placeholder="Username" name="username" />
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="email" type="email" placeholder="name@example.com" name="email" />
                                    <label for="email">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="firstName" type="text" placeholder="First Name" name="nombre" />
                                    <label for="firstName">First Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="lastName" type="text" placeholder="Last Name" name="apellido" />
                                    <label for="lastName">Last Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="password" type="password" placeholder="Password" />
                                    <label for="password">Password</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm Password" name="pass" />
                                    <label for="confirmPassword">Confirm Password</label>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid"><button class="btn btn-outline-dark" type="submit" name="reg_ueer">Crear Cuenta</button></div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a href="log_user.php">Tienes una cuenta? inicia session</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('recurrentes/foot.php'); ?>
</body>
</html>
