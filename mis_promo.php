<?php 
session_start();
if(!isset($_SESSION['user_id'])){ 
    header("Location: index.php");
    exit();
}
?>
<?php $mensaje = ''; ?>
<?php include('conf/conn.php'); ?>
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
                <h1 class="display-4 fw-bolder">Mis Promociones vendidas</h1>
                <p class="lead fw-normal text-white-50 mb-0">Promociones </p>
            </div>
        </div>
    </header>
    <!-- Registration Form Section-->
    <section class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Mis ventas</h3>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Cliente</th>
                                    <th>Email</th>
                                    <th>Producto</th>
                                    <th>Monto</th>
                                    <th>QR</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $all_reg = reg_product_vendidos($conn, $_SESSION['user_id']); ?>
                                <?php foreach ($all_reg as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td><?php echo $value['titulo']; ?></td>
                                    <td><?php echo $value['monto_total']; ?></td>
                                    <!-- Imagen QR con enlace al modal -->
                                    <td>
                                        <?php if (!empty($value['codigo_qr'])) { ?>
                                            <a href="qr/qr_<?php echo $value['codigo_qr']; ?>.png" target="_blank" rel="">
                                                <img src="qr/qr_<?php echo $value['codigo_qr']; ?>.png" width="50" class="qr-img" data-toggle="modal" data-target="#qrModal" data-qr="qr/qr_<?php echo $value['codigo_qr']; ?>.png">
                                            </a>
                                            <?php } else { ?>
                                            <span>No disponible</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php if($value['stat']==1){ echo 'Sin canjear'; }else{ echo 'Canjeado'; } ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('recurrentes/foot.php'); ?>
</body>
</html>
