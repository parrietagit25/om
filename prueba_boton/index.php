<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>SDK PHP</title>
</head>

<body>
  <div class="text-center" style="margin-bottom:0">
    <h1>SDK PHP</h1>
  </div>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark"></nav>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <form id="yappyForm" action="Payment_Controller.php" method="post">
          <div class="form-group">
            <input type="hidden" class="form-control" id="total" name="total" value="1.00">
            <input type="hidden" class="form-control" id="subtotal" name="subtotal" value="1.07">
            <input type="hidden" class="form-control" id="taxes" name="taxes" value="0.07">
            <input type="hidden" class="form-control" id="discount" name="discount" value="0.00">
            <input type="hidden" class="form-control" id="shipping" name="shipping" value="0.00">
            <input type="hidden" class="form-control" id="successUrl" name="successUrl">
            <input type="hidden" class="form-control" id="failUrl" name="failUrl">
            <input type="hidden" class="form-control" id="orderId" name="orderId" value="12345">
            <input type="hidden" class="form-control" id="tel" name="tel" value="66666666">
          </div>
        </form>

        <div id="Yappy_Checkout_Button"></div>

      </div>
    </div>
  </div>
</body>
<script src="env.js"></script>
<script src="bg-payment.js"></script>

</html>
