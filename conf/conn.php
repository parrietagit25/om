<?php
/* local */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "om";  

/* web 
$servername = "localhost";
$username = "ofmptygr_autopedro";
$password = "Chicho1787$$$";
$dbname = "ofmptygr_om"; */

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
//echo "Conexión exitosa a la base de datos 'om'";

function insert_reg($tabla, $datos, $conn){
    
    $columnas = implode(", ", array_keys($datos));
    $valores = implode("', '", array_values($datos));

    $sql = "INSERT INTO $tabla ($columnas) VALUES ('$valores')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro insertado correctamente";
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }

    //$conn->close();
}

function insert_reg_doc($tabla, $datos, $conn){
    
    $columnas = implode(", ", array_keys($datos));
    $valores = implode("', '", array_values($datos));

    $sql = "INSERT INTO $tabla ($columnas) VALUES ('$valores')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro insertado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //$conn->close();
}

function all_reg($tabla, $where, $conn){
    $reg = $conn->query("SELECT * FROM $tabla");
    $registros = [];
    while($row = $reg->fetch_assoc()) {
        $registros[] = $row;
    }
    return $registros;
    //$conn->close();
}

function all_reg_product_partner($conn){
    $reg = $conn->query("SELECT 
                         p.id, 
                         p.titulo, 
                         p.descripcion, 
                         u.nombre, 
                         u.apellido, 
                         p.precio, 
                         p.cantidad, 
                         c.descripcion, 
                         p.id_business_partner, 
                         p.id_categoria, 
                         p.photo
                         FROM products_om p inner join users_om u on p.id_business_partner = u.id
                                            inner join categorias_om c on p.id_categoria = c.id");
    $registros = [];
    while($row = $reg->fetch_assoc()) {
        $registros[] = $row;
    }
    return $registros;
    //$conn->close();
}

function reg_product_partner_id($conn, $id_pro){

    $reg = $conn->query("SELECT 
                            p.id, 
                            p.titulo, 
                            p.descripcion, 
                            u.nombre, 
                            u.apellido, 
                            p.precio, 
                            p.cantidad, 
                            c.descripcion, 
                            p.id_business_partner, 
                            p.id_categoria, 
                            p.photo
                            FROM products_om p inner join users_om u on p.id_business_partner = u.id
                                            inner join categorias_om c on p.id_categoria = c.id
                            WHERE
                            p.id = '".$id_pro."'");
    $registros = [];
    while($row = $reg->fetch_assoc()) {
    $registros[] = $row;
    }
    return $registros;
    //$conn->close();

}

function reg_product_vendidos($conn, $id_pro){
                
    $reg = $conn->query("SELECT
                        v.id,
                        u.nombre, 
                        u.apellido, 
                        u.email, 
                        p.titulo, 
                        v.monto_total, 
                        v.codigo_promo, 
                        v.stat, 
                        v.codigo_qr
                        FROM ventas v INNER JOIN users_om u on v.id_user = u.id
                                    INNER JOIN products_om p on v.id_product = p.id
                        WHERE 
                        p.id_business_partner = '".$id_pro."'");
    
    $registros = [];
    while($row = $reg->fetch_assoc()) {
    $registros[] = $row;
    }
    return $registros;
    //$conn->close();

}

function reg_product_comprados($conn, $id_pro){
                
    $reg = $conn->query("SELECT
                        v.id,
                        u.nombre, 
                        u.apellido, 
                        u.email, 
                        p.titulo, 
                        v.monto_total, 
                        v.codigo_promo
                        FROM ventas v INNER JOIN users_om u on v.id_user = u.id
                                    INNER JOIN products_om p on v.id_product = p.id
                        WHERE 
                        v.id_user = '".$id_pro."'");
    
    $registros = [];
    while($row = $reg->fetch_assoc()) {
    $registros[] = $row;
    }
    return $registros;
    //$conn->close();

}

function all_reg_partner($conn){
    $reg = $conn->query("SELECT * FROM users_om WHERE tipo_user = 3");
    $registros = [];
    while($row = $reg->fetch_assoc()) {
        $registros[] = $row;
    }
    return $registros;
    //$conn->close();
}

function actualizarRegistro($tabla, $datos, $condicion, $conn) {

    $sets = [];
    foreach ($datos as $columna => $valor) {
        $sets[] = "$columna = '$valor'";
    }
    $sets_string = implode(", ", $sets);
    $sql = "UPDATE $tabla SET $sets_string WHERE $condicion";
    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente";
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
    //$conn->close();
}

function eliminar_reg($tabla, $condicion, $conn){
    $reg = $conn->query("DELETE FROM $tabla WHERE $condicion");
    echo "Registro Eliminado";
}

function ultimo_id($tabla, $conn){
    $reg = $conn->query("SELECT max(id) as id FROM $tabla");
    $registros = [];
    while($row = $reg->fetch_assoc()) {
        $registros[] = $row;
    }
    return $registros;
}

function select_datos_id($tabla, $conn, $condicion){
    $reg = $conn->query("SELECT * FROM $tabla WHERE $condicion");
    $registros = [];
    while($row = $reg->fetch_assoc()) {
        $registros[] = $row;
    }
    return $registros;
}

function contar_productos($id_user, $id_condicion, $conn){

    if ($id_condicion == 1) {
        $condicion = ' and v.stat = 2 ';
    }elseif ($id_condicion == 2) {
        $condicion = ' and v.stat = 1 ';
    }else {
        $condicion = '';
    }

    $reg = $conn->query("SELECT
                        count(*) as contar
                        FROM ventas v INNER JOIN users_om u on v.id_user = u.id
                                      INNER JOIN products_om p on v.id_product = p.id
                        WHERE 
                        v.id_user = '".$id_user."'
                        $condicion");
    ///$registros = [];
    while($row = $reg->fetch_assoc()) {
        $registros = $row['contar'];
    }
    return $registros;

}


?>
