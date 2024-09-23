<?php
session_start();
/*
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
*/
if (!isset($_GET['producto'])) {
    header("Location: index.php");
}

/*
include('src/BgFirma.php');

use Bg\BgFirma;

// Obtener el dominio del servidor
//$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
//$domain = $protocol . $_SERVER['HTTP_HOST'];

// verificar credenciales
//$response = BgFirma::checkCredentials($_ENV['ID_DEL_COMERCIO'], $_ENV['CLAVE_SECRETA'], $domain);
/*
echo $_ENV['ID_DEL_COMERCIO'].'<br>'; 
echo $_ENV['CLAVE_SECRETA'].'<br>'; 
echo $domain.'<br>';
echo '<pre>';
echo  var_dump($response);
echo '</pre>';
*/
/*
if ($response && $response['success']) {

} else {
    echo '<style>';
    include 'main.css';
    echo '</style>';
    echo "<div class='alert'>Algo salio mal. Contacta con el administrador</div>";
}*/
?>

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

                                    <?php if(isset($_SESSION['user_id'])){ ?>

                                    <form action="paguelo_facil.php" method="POST">
                                        <div class="d-flex align-items-center mb-3">
                                            <input class="form-control me-3" type="number" name="cantidad" value="1" min="1" style="width: 100px;" />
                                            <span class="fw-bolder">Precio unitario: <span class="precio-unitario"><?php echo $value['precio']; ?></span> $</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="fw-bolder">Total: <span class="precio-total"><?php echo $value['precio']; ?></span> $</span>
                                        </div>
                                        <input type="hidden" name="total" class="total-hidden" value="<?php echo $value['precio']; ?>">
                                        <input type="hidden" name="titulo" class="total-hidden" value="<?php echo $value['titulo']; ?>">
                                        <input type="hidden" name="id_product" value="<?php echo $value['id']; ?>">
                                        <input type="hidden" name="monto_unitario" value="<?php echo $value['precio']; ?>">
                                        <button type="submit" class="btn btn-outline-dark mt-auto">
                                            <img src="https://assets.paguelofacil.com/images/btn-svg/btn_es.svg" alt="Pagar con PagueloFacil">
                                        </button>
                                    </form>

                                    <?php }else{ ?> 

                                        <div class="d-flex align-items-center mb-3">
                                            <input class="form-control me-3" type="number" name="cantidad" value="1" min="1" style="width: 100px;" />
                                            <span class="fw-bolder">Precio unitario: <span class="precio-unitario"><?php echo $value['precio']; ?></span> $</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="fw-bolder">Total: <span class="precio-total"><?php echo $value['precio']; ?></span> $</span>
                                        </div>
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
        <script src="env.js"></script>
        <script src="bg-payment.js"></script>
    </body>
</html>
