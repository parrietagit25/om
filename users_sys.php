<?php $mensaje = ''; ?>
<?php include('conf/conn.php'); ?>
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
                <h1 class="display-4 fw-bolder">Data Table</h1>
                <p class="lead fw-normal text-white-50 mb-0">View your saved records below</p>
            </div>
        </div>
    </header>
    <!-- DataTable Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Usuarios del sistema</h3></div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Nombre</th>
                                        <th>Tipo de Usuario</th>
                                        <th>Accionez</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $all_reg = all_reg("users_om", "", $conn); ?>
                                    <?php foreach ($all_reg as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['username']; ?></td>
                                        <td><?php echo $value['email']; ?></td>
                                        <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
                                        <td><?php echo $value['tipo_user']; ?></td>
                                        <td><?php echo $value['id']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('recurrentes/foot.php'); ?>
    
    <!-- DataTables JS and CSS -->
   

</body>
</html>
