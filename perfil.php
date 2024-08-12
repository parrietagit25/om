<?php 
session_start();
if(!isset($_SESSION['user_id'])){ 
    header("Location: index.php");
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
                    <h1 class="display-4 fw-bolder">Ofertas&Mas</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Bienvenido al sistema</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                    <h2>Resumen</h2>
                    <br>
                    <br><br><br><br><br>
                    <br>
                    <br><br><br><br><br>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <?php include('recurrentes/foot.php'); ?>
    </body>
</html>
