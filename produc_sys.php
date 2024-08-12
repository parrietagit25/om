<?php 
session_start();
if(!isset($_SESSION['user_id'])){ 
    header("Location: index.php");
    } ?>
<?php $mensaje = ''; ?>
<?php include('conf/conn.php'); ?>

<?php if(isset($_POST['reg_product'])){

unset($_POST['photo']);
unset($_POST['reg_product']);
$_POST['stat'] = 1;
insert_reg("products_om", $_POST, $conn);
$ultimo_id = ultimo_id("products_om", $conn);

if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] != 4) {

    foreach ($ultimo_id as $key => $value) {
        $id_ulti = $value['id'];
    }

    $nombre = $conn->real_escape_string($_POST['titulo']);
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        //echo "El archivo ". htmlspecialchars(basename($_FILES["photo"]["name"])). " ha sido subido.";
        $sql = "UPDATE products_om SET photo = '".$target_file."' WHERE id = '".$id_ulti."'";
        if ($conn->query($sql) === TRUE) {
            //echo "Registro guardado correctamente en la base de datos.";
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        //echo "Lo siento, hubo un error al subir tu archivo.";
    }
}

$mensaje = 'Registre Realizado';

}

if(isset($_POST['update_product'])){

    //unset($_POST['photo']);
    unset($_POST['update_product']);
    $condicion = " id =".$_POST['id_product'];  

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] != 4) {

        $nombre = $conn->real_escape_string($_POST['titulo']);
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $sql = "UPDATE products_om SET photo = '".$target_file."' WHERE id = '".$_POST['id_product']."'";
            if ($conn->query($sql) === TRUE) {
            } else {
            }
        } else {
        }
    }

    unset($_POST['id_product']);
    actualizarRegistro("products_om", $_POST, $condicion, $conn);  

    $mensaje = 'Registro Actualizado';
    
}

if(isset($_POST['eliminar_product'])){

    $condicion = " id =".$_POST['id_product'];
    eliminar_reg("products_om", $condicion, $conn);    
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
                <form action="" method="POST" enctype="multipart/form-data">
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
                                        <th>Foto</th>
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
                                        <td><img src="<?php echo $value['photo']; ?>" width="100"> </td>
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
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Productos</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" type="text" placeholder="Titulo" name="titulo" value="<?php echo $value['titulo']; ?>" />
                                                        <label for="username">Titulo</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="descripcion" id=""><?php echo $value['descripcion']; ?></textarea>
                                                        <label for="email">Descripcion</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <select class="form-control" id="id_business_partner" name="id_business_partner">
                                                            <option value="">Seleccionar Partner</option>
                                                            <?php $all_reg = all_reg_partner($conn); ?>
                                                            <?php foreach ($all_reg as $key => $value2) { ?>
                                                                <option value="<?php echo $value2['id']; ?>" <?php if($value2['id'] == $value['id_business_partner']){ echo 'selected'; } ?>><?php echo $value2['nombre']. ' ' .$value2['apellido']; ?></option>    
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <select class="form-control" id="id_categoria" name="id_categoria">
                                                            <option value="">Seleccionar Categoria</option>
                                                            <?php $all_reg = all_reg("categorias_om", "", $conn); ?>
                                                            <?php foreach ($all_reg as $key => $value3) { ?>
                                                                <option value="<?php echo $value3['id']; ?>" <?php if($value3['id'] == $value['id_categoria']){ echo 'selected'; } ?>><?php echo $value3['descripcion']; ?></option>    
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="username" type="text" placeholder="Username" name="cantidad" value="<?php echo $value['cantidad']; ?>" />
                                                        <label for="username">Cantidad</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="email" type="text" placeholder="name@example.com" name="precio" value="<?php echo $value['precio']; ?>" />
                                                        <label for="email">Precio</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <p>Imagen actual</p>
                                                        <img src="<?php echo $value['photo']; ?>" width="300">
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" type="file" name="photo" />
                                                        <label for="email">Subir Nueva Imagen</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" name="update_product">Actualizar </button>
                                                    <input type="hidden" name="id_product" value="<?php echo $value['id']; ?>">
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="EliminarUser<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Producto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="POST">
                                                <div class="modal-body">
                                                    Esta seguro que quiere eliminar el producto de <?php echo $value['nombre']. ' ' .$value['apellido']; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-danger" name="eliminar_product">Eliminar </button>
                                                    <input type="hidden" name="id_product" value="<?php echo $value['id']; ?>">
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
