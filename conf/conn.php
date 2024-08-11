<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "om";

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
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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
    $conn->close();
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
                         c.descripcion
                         FROM products_om p inner join users_om u on p.id_business_partner = u.id
                                            inner join categorias_om c on p.id_categoria = c.id");
    $registros = [];
    while($row = $reg->fetch_assoc()) {
        $registros[] = $row;
    }
    return $registros;
    $conn->close();
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


?>
