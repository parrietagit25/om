<?php $mensaje = ''; ?>
<?php include('conf/conn.php'); ?>

<?php if(isset($_POST['reg_product'])){
unset($_POST['photo']);
unset($_POST['reg_product']);
$_POST['stat'] = 1;
insert_reg("products_om", $_POST, $conn);
$mensaje = 'Registre Realizado';
}

if(isset($_POST['actualizar_user'])){

    if($_POST['pass'] != ''){
    $_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    }else{
        unset($_POST['pass']);    
    }
    unset($_POST['actualizar_user']);
    $condicion = " id =".$_POST['id_user'];
    unset($_POST['id_user']);
    actualizarRegistro("users_om", $_POST, $condicion, $conn);    
    $mensaje = 'Registre Actualizado';
    
}

if(isset($_POST['eliminar_user'])){

    $condicion = " id =".$_POST['id_user'];
    eliminar_reg("users_om", $condicion, $conn);    
    $mensaje = 'Registre Eliminado';
    
}


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
                <h1 class="display-4 fw-bolder">Data Table</h1>
                <p class="lead fw-normal text-white-50 mb-0">View your saved records below</p>
            </div>
        </div>
    </header>
    <!-- DataTable Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Registrar Producto
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input class="form-control" type="text" placeholder="Titulo" name="titulo" />
                            <label for="username">Titulo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="descripcion" id=""></textarea>
                            <label for="email">Descripcion</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-control" id="id_business_partner" name="id_business_partner">
                                <option value="">Seleccionar Partner</option>
                                <?php $all_reg = all_reg_partner($conn); ?>
                                <?php foreach ($all_reg as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']. ' ' .$value['apellido']; ?></option>    
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-control" id="id_categoria" name="id_categoria">
                                <option value="">Seleccionar Categoria</option>
                                <?php $all_reg = all_reg("categorias_om", "", $conn); ?>
                                <?php foreach ($all_reg as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['descripcion']; ?></option>    
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="username" type="text" placeholder="Username" name="cantidad" />
                            <label for="username">Cantidad</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="text" placeholder="name@example.com" name="precio" />
                            <label for="email">Precio</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="file" name="photo" />
                            <label for="email">Subir Imagen</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="reg_product">Registrar </button>
                    </div>
                </form>
                </div>
            </div>
        </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Usuarios del sistema</h3></div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Titulo</th>
                                        <th>Partner</th>
                                        <th>Categoria</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Accionez</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $all_reg = all_reg_product_partner($conn); ?>
                                    <?php foreach ($all_reg as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['id']; ?></td>
                                        <td><?php echo $value['titulo']; ?></td>
                                        <td><?php echo $value['nombre']. ' ' .$value['apellido']; ?></td>
                                        <td><?php echo $value['descripcion']; ?></td>
                                        <td><?php echo $value['precio']; ?></td>
                                        <td><?php echo $value['cantidad']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-primary sm" data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $value['id']; ?>"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="" class="btn btn-danger sm" data-bs-toggle="modal" data-bs-target="#EliminarUser<?php echo $value['id']; ?>"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="EditModal<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Usuario</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-control" id="tipo_usuario" name="tipo_user">
                                                            <option value="">Seleccionar Tipo de Usuario</option>
                                                            <option value="1" <?php if($value['tipo_user'] == 1){ echo 'selected'; } ?>>Admin</option>
                                                            <option value="2" <?php if($value['tipo_user'] == 2){ echo 'selected'; } ?>>Cliente</option>
                                                            <option value="3" <?php if($value['tipo_user'] == 3){ echo 'selected'; } ?>>Partner</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" value="<?php echo $value['username']; ?>" id="username" type="text" placeholder="Username" name="username" />
                                                        <label for="username">Username</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" value="<?php echo $value['email']; ?>" id="email" type="email" placeholder="name@example.com" name="email" />
                                                        <label for="email">Email address</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" value="<?php echo $value['nombre']; ?>" id="firstName" type="text" placeholder="First Name" name="nombre" />
                                                        <label for="firstName">First Name</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" value="<?php echo $value['apellido']; ?>" id="lastName" type="text" placeholder="Last Name" name="apellido" />
                                                        <label for="lastName">Last Name</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm Password" name="pass" />
                                                        <label for="confirmPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" name="actualizar_user">Actualizar </button>
                                                    <input type="hidden" name="id_user" value="<?php echo $value['id']; ?>">
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="EliminarUser<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Usuario</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    Esta seguro que quiere eliminar a <?php echo $value['nombre']. ' ' .$value['apellido']; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-danger" name="eliminar_user">Eliminar </button>
                                                    <input type="hidden" name="id_user" value="<?php echo $value['id']; ?>">
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>

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
