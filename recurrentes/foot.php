<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Ofertas&Mas 2024</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<script>
$(document).ready(function() {
    $('input[name="cantidad"]').on('input', function() {
        var cantidad = $(this).val(); 
        var precio = parseFloat($(this).closest('.card-body').find('.precio-unitario').text());
        var total = cantidad * precio; 
        $(this).closest('.card-body').find('.precio-total').text(total.toFixed(2) + ' $'); 
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btn-comprar').addEventListener('click', function(e) {
        e.preventDefault(); 
        let formData = new FormData();
        let cantidad = document.querySelector('input[name="cantidad"]').value;
        let precio = document.querySelector('.precio-total').textContent;
        let idProducto = document.querySelector('.id_producto').value;

        let total = querySelector("total").value;
        let subtotal = querySelector("subtotal").value;
        let taxes = querySelector("taxes").value;
        let discount = querySelector("discount").value;
        let shipping = querySelector("shipping").value;
        let successUrl = querySelector("successUrl").value;
        let failUrl = querySelector("failUrl").value;
        let orderId = querySelector("orderId").value;
        let tel = querySelector("tel").value;

        formData.append('cantidad', cantidad);
        formData.append('precio', precio);
        formData.append('id_producto', idProducto);
        formData.append('total', total);
        formData.append('subtotal', subtotal);
        formData.append('taxes', taxes);
        formData.append('discount', discount);
        formData.append('shipping', shipping);
        formData.append('successUrl', successUrl);
        formData.append('failUrl', failUrl);
        formData.append('orderId', orderId);
        formData.append('tel', tel);
        
        fetch('detalle_compra.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  
        .then(data => {
            console.log('Success:', 'Compra Realizada');
            alert(data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cantidadInput = document.querySelector('input[name="cantidad"]');
        const precioUnitario = parseFloat(document.querySelector('.precio-unitario').innerText);
        const totalElement = document.querySelector('.precio-total');
        const totalHidden = document.querySelector('.total-hidden');

        function actualizarTotal() {
            const cantidad = parseInt(cantidadInput.value);
            const total = (cantidad * precioUnitario).toFixed(2);
            totalElement.innerText = total;
            totalHidden.value = total; // Actualizar el campo oculto con el nuevo total
        }

        cantidadInput.addEventListener('input', actualizarTotal);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailsModal = document.getElementById('detailsModal');
        
        detailsModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Botón que activó el modal
            const content = button.getAttribute('data-content'); // Obtener el contenido personalizado (opcional)
            const tipo_conteo = button.getAttribute('data-id'); // Obtener el ID del usuario
            const modalContent = detailsModal.querySelector('#modalContent');
            const detailLink = detailsModal.querySelector('#detailLink');

            // Mostrar un mensaje de carga mientras se obtiene la información
            modalContent.innerHTML = "<p>Cargando...</p>";

            // Realizar la solicitud fetch
            fetch(`detalle_perfil.php?tipo_conteo=${tipo_conteo}`)
                .then(response => response.text()) // Asumimos que detalle_perfil.php devuelve HTML para mostrar en el modal
                .then(data => {
                    // Actualizar el contenido del modal con la respuesta de detalle_perfil.php
                    modalContent.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                    modalContent.innerHTML = "<p>Error al cargar los detalles. Intenta nuevamente.</p>";
                });
            
            // Establecer enlace o realizar otras acciones (si es necesario)
            detailLink.href = "#"; // Modifica el enlace si es necesario
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ProductosCanjeados = document.getElementById('ProductosCanjeados');
        
        ProductosCanjeados.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Botón que activó el modal
            const content = button.getAttribute('data-content'); // Obtener el contenido personalizado (opcional)
            const tipo_conteo = button.getAttribute('data-id'); // Obtener el ID del usuario
            const modalContent = ProductosCanjeados.querySelector('#modalContent');
            const detailLink = ProductosCanjeados.querySelector('#detailLink');

            // Mostrar un mensaje de carga mientras se obtiene la información
            modalContent.innerHTML = "<p>Cargando...</p>";

            // Realizar la solicitud fetch
            fetch(`detalle_perfil.php?tipo_conteo=${tipo_conteo}`)
                .then(response => response.text()) // Asumimos que detalle_perfil.php devuelve HTML para mostrar en el modal
                .then(data => {
                    // Actualizar el contenido del modal con la respuesta de detalle_perfil.php
                    modalContent.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                    modalContent.innerHTML = "<p>Error al cargar los detalles. Intenta nuevamente.</p>";
                });
            
            // Establecer enlace o realizar otras acciones (si es necesario)
            detailLink.href = "#"; // Modifica el enlace si es necesario
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ProductosNoCanjeados = document.getElementById('ProductosNoCanjeados');
        
        ProductosNoCanjeados.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Botón que activó el modal
            const content = button.getAttribute('data-content'); // Obtener el contenido personalizado (opcional)
            const tipo_conteo = button.getAttribute('data-id'); // Obtener el ID del usuario
            const modalContent = ProductosNoCanjeados.querySelector('#modalContent');
            const detailLink = ProductosNoCanjeados.querySelector('#detailLink');

            // Mostrar un mensaje de carga mientras se obtiene la información
            modalContent.innerHTML = "<p>Cargando...</p>";

            // Realizar la solicitud fetch
            fetch(`detalle_perfil.php?tipo_conteo=${tipo_conteo}`)
                .then(response => response.text()) // Asumimos que detalle_perfil.php devuelve HTML para mostrar en el modal
                .then(data => {
                    // Actualizar el contenido del modal con la respuesta de detalle_perfil.php
                    modalContent.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                    modalContent.innerHTML = "<p>Error al cargar los detalles. Intenta nuevamente.</p>";
                });
            
            // Establecer enlace o realizar otras acciones (si es necesario)
            detailLink.href = "#"; // Modifica el enlace si es necesario
        });
    });
</script>
