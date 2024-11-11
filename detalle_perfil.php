<?php 
session_start();
if(!isset($_SESSION['user_id'])){ 
    header("Location: index.php");
    }
    include('conf/conn.php');

    if (isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 1) {     ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = tabla_product_vendidos($conn, 1); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }elseif(isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 2) { ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = tabla_product_vendidos($conn, 2); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }elseif(isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 3) { ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = tabla_product_vendidos($conn, 3); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }elseif(isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 4) { ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = tabla_product_vendidos_socio($conn, 1, $_SESSION['user_id']); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }elseif(isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 5) { ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = tabla_product_vendidos_socio($conn, 2, $_SESSION['user_id']); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }elseif(isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 6) { ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = tabla_product_vendidos_socio($conn, 0, $_SESSION['user_id']); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }elseif(isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 7) { ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = reg_product_comprados_cliente($conn, 0, $_SESSION['user_id']); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }elseif(isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 8) { ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = reg_product_comprados_cliente($conn, 2, $_SESSION['user_id']); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }elseif(isset($_GET['tipo_conteo']) && $_GET['tipo_conteo'] == 9) { ?>

<table id="dataTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del comercio</th>
            <th>Email del comercio</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto</th>
            <th>QR</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>
        <?php $all_reg = reg_product_comprados_cliente($conn, 1, $_SESSION['user_id']); ?>
        <?php foreach ($all_reg as $key => $value) { ?>
        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['titulo']; ?></td>
            <td><?php echo $value['cantidad']; ?></td>
            <td><?php echo $value['monto_total']; ?></td>
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
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php }