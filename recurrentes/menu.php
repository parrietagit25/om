<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Ofertas&Mas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Inicio</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">HOTELES</a></li>
                                <li><a class="dropdown-item" href="#!">RESTAURANTES</a></li>
                                <li><a class="dropdown-item" href="#!">BIENESTAR</a></li>
                                <li><a class="dropdown-item" href="#!">DIVERSION</a></li>
                            </ul>
                        </li>
                        <?php if(!isset($_SESSION['user_id'])){ ?> 
                        <li class="nav-item"><a class="nav-link" href="user_reg.php">Registrate</a></li>
                        <li class="nav-item"><a class="nav-link" href="log_user.php">Ingresa</a></li>
                        <?php } ?>
                        <?php if(isset($_SESSION['user_id'])){ ?> 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Perfil</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if($_SESSION['tipo_usuario']==2){ ?> 
                                <li><a class="dropdown-item" href="#!">Mis Compras</a></li>
                                <?php } ?>
                                <?php if($_SESSION['tipo_usuario']==3){ ?> 
                                <li><a class="dropdown-item" href="#!">Mis Promosiones</a></li>
                                <?php } ?>
                                <?php if($_SESSION['tipo_usuario']==1){ ?> 
                                <li><a class="dropdown-item" href="produc_act.php">Productos Activos</a></li>
                                <li><a class="dropdown-item" href="ventas.php">Ventas</a></li>
                                <li><a class="dropdown-item" href="produc_sys.php">Reg. Productos</a></li>
                                <li><a class="dropdown-item" href="users_sys.php">Reg. Usuarios</a></li>
                                <?php } ?>
                                <li><a class="dropdown-item" href="salir.php">Salir</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>