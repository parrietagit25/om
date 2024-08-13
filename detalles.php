<?php session_start(); ?>
<?php if(!isset($_GET['producto'])){ 
     header("Location: index.php");
} ?>
<?php include('conf/conn.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php include('recurrentes/head.php'); ?>
    <body>
        <?php include('recurrentes/menu.php'); ?>
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Ofertas&Mas</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Detalles de la oferta</p>
                </div>
            </div>
        </header>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row justify-content-center">
                <?php $all_reg = reg_product_partner_id($conn, $_GET['producto']); ?>
                    <?php foreach ($all_reg as $key => $value) { ?>
                    <div class="col-md-8 mb-5">
                        <div class="row">
                            <div class="col-md-5">
                                <img class="img-fluid" src="<?php echo $value['photo']; ?>" alt="..." />
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="fw-bolder"><?php echo $value['titulo']; ?></h5>
                                    <p class="mt-3"><?php echo $value['descripcion']; ?></p>
                                    <div class="d-flex align-items-center mb-3">
                                        <input class="form-control me-3" type="number" name="cantidad" value="1" min="1" style="width: 100px;" />
                                        <span class="fw-bolder">Precio unitario: <span class="precio-unitario"><?php echo $value['precio']; ?></span> $</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="fw-bolder">Total: <span class="precio-total"><?php echo $value['precio']; ?></span> $</span>
                                    </div>
                                    <?php if(isset($_SESSION['user_id'])){ ?>
                                    <a class="btn btn-outline-dark mt-auto" id="btn-comprar">Comprar</a>
                                    <?php }else{ ?> 
                                    <a href="log_user.php" class="btn btn-outline-dark mt-auto">Ingresa</a>
                                    <?php } ?>
                                    <input type="hidden" class="id_producto" value="<?php echo $value['id']; ?>">
                                    <input type="hidden" name="monto" value="<?php echo $value['precio']; ?>">    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </section>
        <?php include('recurrentes/foot.php'); ?>
    </body>
</html>
