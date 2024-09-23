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
                <h1 class="display-4 fw-bolder">Canjear Promociones</h1>
            </div>
        </div>
    </header>
    <!-- Registration Form Section-->
    <section class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Escanee el código QR</h3>
                    </div>
                    <div class="card-body">
                        <div id="qr-reader" style="width: 300px;"></div>
                        <div id="qr-reader-results"></div>
                        <button id="start-scan" class="btn btn-primary mt-4">Escanear Código QR</button>
                        <div id="result" class="mt-4"></div>
                        <div id="actions" style="display: none;">
                            <button id="canjear-btn" class="btn btn-success mt-4">Canjear</button>
                            <button id="cancelar-btn" class="btn btn-danger mt-4">Cancelar</button>
                        </div>
                        <div id="actions_canjeado" style="display: none;">
                            <h3 style="color:red;">Ya este codigo fue canjeado</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('recurrentes/foot.php'); ?>

    <!-- Incluir correctamente la biblioteca de html5-qrcode -->
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>

    <!-- JavaScript para escanear el QR, validar en la base de datos y manejar las acciones -->
    <script>
        let qrData;

        document.getElementById("start-scan").addEventListener("click", function() {
            const html5QrCode = new Html5Qrcode("qr-reader");
            html5QrCode.start(
                { facingMode: "environment" }, // Usar la cámara trasera
                {
                    fps: 10,    // Velocidad de escaneo de 10 frames por segundo
                    qrbox: { width: 250, height: 250 }  // Tamaño del cuadro de escaneo
                },
                qrCodeMessage => {
                    // Mostrar el código escaneado
                    document.getElementById("qr-reader-results").innerHTML = `Código QR: ${qrCodeMessage}`;
                    
                    // Detener el escaneo
                    html5QrCode.stop().then(() => {
                        console.log("Escaneo detenido");
                    }).catch(err => {
                        console.error("Error al detener el escaneo: ", err);
                    });

                    // Realizar una solicitud a PHP para validar el código en la base de datos
                    fetch('validar_qr.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ codigo_qr: qrCodeMessage }),
                    })
                    .then(response => response.text())  // Primero tratamos la respuesta como texto para ver qué devuelve
                    .then(text => {
                        try {
                            const data = JSON.parse(text);  // Intentamos convertir la respuesta a JSON
                            if (data.success) {
                                qrData = data;
                                
                                // Mostrar los datos de la venta si es válido
                                document.getElementById("result").innerHTML = `
                                    <h5>Datos de la Venta</h5>
                                    <p>Fecha de compra: ${data.Fecha}</p>
                                    <p>Cliente: ${data.nombre} ${data.apellido}</p>
                                    <p>Email: ${data.Email}</p>
                                    <p>Producto: ${data.titulo}</p>
                                    <p>Monto unidad: ${data.monto}</p>
                                    <p>Cantidad: ${data.cantidad}</p>
                                    <p>Monto total: ${data.monto_total}</p>
                                    <p>Estado: ${data.stat}</p>`;
                                
                                // Mostrar los botones "Canjear" y "Cancelar"
                                document.getElementById("actions").style.display = "block";
                                
                                if (data.stat == 'Canjeado') {
                                    document.getElementById("actions").style.display = "none";
                                    document.getElementById("actions_canjeado").style.display = "block";
                                }

                            } else {
                                document.getElementById("result").innerHTML = `<p class="text-danger">${data.message}</p>`;
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                            console.log('Respuesta recibida:', text);
                            document.getElementById("result").innerHTML = `<p class="text-danger">Error al procesar la respuesta del servidor.</p>`;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById("result").innerHTML = `<p class="text-danger">Ocurrió un error al validar el código QR.</p>`;
                    });

                },
                errorMessage => {
                    // Mensajes de error durante el escaneo
                    console.log("QR no detectado.", errorMessage);
                }
            );
        });

        // Manejar el botón "Canjear"
        document.getElementById("canjear-btn").addEventListener("click", function() {
            // Actualizar el estado de la venta en la base de datos
            fetch('canjear_venta.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: qrData.id }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("result").innerHTML += `<p class="text-success">La promoción ha sido canjeada exitosamente.</p>`;
                    document.getElementById("actions").style.display = "none";
                } else {
                    document.getElementById("result").innerHTML += `<p class="text-danger">${data.message}</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("result").innerHTML += `<p class="text-danger">Ocurrió un error al canjear la promoción.</p>`;
            });
        });

        // Manejar el botón "Cancelar"
        document.getElementById("cancelar-btn").addEventListener("click", function() {
            window.location.reload();
        });
    </script>
</body>
</html>
