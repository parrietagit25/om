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
                    <p class="lead fw-normal text-white-50 mb-0">Bienvenido - Resumen </p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <?php if($_SESSION['tipo_usuario'] == 3){ ?> 
        
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 justify-content-center">
                    <!-- Tarjeta 1: Productos Comprados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos Vendidos</h5>
                                <p class="card-text"><h1><?php echo contar_productos_socio($_SESSION['user_id'], 0, $conn); ?></h1></p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal" data-content="Detalles de Productos Vendidos" data-id="4">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta 2: Productos Canjeados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos Canjeados</h5>
                                <p class="card-text"><h1><?php echo contar_productos_socio($_SESSION['user_id'], 2, $conn); ?></h1></p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ProductosCanjeados" data-content="Detalles de Productos Vendidos" data-id="5">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta 3: Productos No Canjeados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos No Canjeados </h5>
                                <p class="card-text"><h1><?php echo contar_productos_socio($_SESSION['user_id'], 1, $conn); ?></h1</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ProductosNoCanjeados" data-content="Detalles de Productos Vendidos" data-id="6">Ver Detalles</a>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Monto total productos vendidos </h5>
                                <p class="card-text"><h1><?php echo monto_productos_socio($_SESSION['user_id'], 0, $conn).' $'; ?></h1</p>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Monto total productos canjeados</h5>
                                <p class="card-text"><h1><?php echo (monto_productos_socio($_SESSION['user_id'], 2, $conn) ?? 0) . ' $'; ?></h1</p>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Monto total productos no canjeados </h5>
                                <p class="card-text"><h1><?php echo monto_productos_socio($_SESSION['user_id'], 1, $conn).' $'; ?></h1</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        
        <?php }elseif($_SESSION['tipo_usuario'] == 2){ ?>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 justify-content-center">
                    <!-- Tarjeta 1: Productos Comprados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos Comprados</h5>
                                <p class="card-text"><h1><?php echo contar_productos($_SESSION['user_id'], 0, $conn); ?></h1></p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal" data-content="Detalles de Productos Vendidos" data-id="7">Ver Detalles</a>
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
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ProductosCanjeados" data-content="Detalles de Productos Vendidos" data-id="8">Ver Detalles</a>
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
                                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ProductosNoCanjeados" data-content="Detalles de Productos Vendidos" data-id="9">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php }if($_SESSION['tipo_usuario'] == 1){ ?> 
        
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 justify-content-center">
                    <!-- Tarjeta 1: Productos Comprados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos Vendidos</h5>
                                <p class="card-text"><h1><?php echo contar_productos_admin(0, 0, $conn); ?></h1></p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal" data-content="Detalles de Productos Vendidos" data-id="1">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta 2: Productos Canjeados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos Canjeados</h5>
                                <p class="card-text"><h1><?php echo contar_productos_admin(0, 2, $conn); ?></h1></p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ProductosCanjeados" data-content="Detalles de Productos Vendidos" data-id="2">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta 3: Productos No Canjeados -->
                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Productos No Canjeados </h5>
                                <p class="card-text"><h1><?php echo contar_productos_admin(0, 1, $conn); ?></h1</p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ProductosNoCanjeados" data-content="Detalles de Productos Vendidos" data-id="3">Ver Detalles</a>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Monto total productos vendidos </h5>
                                <p class="card-text"><h1><?php echo monto_productos_admin(0, 0, $conn).' $'; ?></h1</p>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Monto total productos canjeados</h5>
                                <p class="card-text"><h1><?php echo (monto_productos_admin(0, 2, $conn) ?? 0) . ' $'; ?></h1</p>
                            </div>
                        </div>
                    </div>

                    <div class="col mb-5">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <h5 class="card-title">Monto total productos no canjeados </h5>
                                <p class="card-text"><h1><?php echo monto_productos_admin(0, 1, $conn).' $'; ?></h1</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        
        <?php } ?>


        <!-- Modal -->
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Productos Vendidos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se mostrará el contenido dinámico del modal -->
                        <p id="modalContent"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ProductosCanjeados" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Productos Canjeados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se mostrará el contenido dinámico del modal -->
                        <p id="modalContent"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ProductosNoCanjeados" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Productos No Canjeados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se mostrará el contenido dinámico del modal -->
                        <p id="modalContent"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Footer-->
         <br>
         <br>
         <br>
        <?php include('recurrentes/foot.php'); ?>
    </body>
</html>
