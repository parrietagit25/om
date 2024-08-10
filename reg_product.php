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
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Productos</h3></div>
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
                                    <!-- Example rows; you would dynamically generate these rows with your data -->
                                    <tr>
                                        <td>1</td>
                                        <td>john_doe</td>
                                        <td>john@example.com</td>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>Doe</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>jane_doe</td>
                                        <td>jane@example.com</td>
                                        <td>Jane</td>
                                        <td>Doe</td>
                                        <td>Doe</td>
                                    </tr>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</body>
</html>
