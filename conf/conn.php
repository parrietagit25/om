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

function all_reg($tabla, $where, $conn){
    $reg = $conn->query("SELECT * FROM $tabla");
    $registros = [];
    while($row = $reg->fetch_assoc()) {
        $registros[] = $row;
    }
    echo '<pre>';
    echo var_dump($registros);
    echo '<pre>';
    return $registros;
    $conn->close();
}


?>
