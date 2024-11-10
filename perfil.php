<?php 
session_start();
if(!isset($_SESSION['user_id'])){ 
    header("Location: index.php");
} 

include('conf/conn.php'); 
?>
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
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 justify-content-center">
                    <!-- Tarjeta 1: Productos Comprados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos Comprados</h5>
                                <p class="card-text"><h1><?php echo contar_productos($_SESSION['user_id'], 3, $conn); ?></h1></p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta 2: Productos Canjeados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos Canjeados</h5>
                                <p class="card-text"><h1><?php echo contar_productos($_SESSION['user_id'], 2, $conn); ?></h1></p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-success">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta 3: Productos No Canjeados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos No Canjeados </h5>
                                <p class="card-text"><h1><?php echo contar_productos($_SESSION['user_id'], 1, $conn); ?></h1</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-warning">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
         <br>
         <br>
         <br>
        <?php include('recurrentes/foot.php'); ?>
    </body>
</html>
