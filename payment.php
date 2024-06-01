<?php
session_start();
include("php/connection.php");
include("php/functions.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/style.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=AeeYokM7sww9YP_8sCt1oJmjPJiV4gwsRv5CKDdP4c-wQBwkpVh6Gzu7fUx6lQd3tkN3v_vmOkss0F7h"></script>
</head>

<body class="body_login">
    <container>
        <div class="login_container">
            <h1>Complete su pago</h1>
            <div id="paypal-button-container"></div>
        </div>

    </container>

    <script>
        var phpPrice = <?php echo json_encode($_SESSION['totalPrice'], JSON_UNESCAPED_UNICODE); ?>;

        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: phpPrice
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    console.log('Payment completed:', details);
                    window.location.href = "php/generarPDF.php";
                });
            },
            onCancel: function(data) {
                <?php
                $query = "DELETE FROM user_reservation 
            WHERE reservation_id = (
                SELECT reservation_id FROM (
                    SELECT reservation_id FROM user_reservation ORDER BY reservation_id DESC LIMIT 1
                ) AS subquery
            );
            ";
                $result = mysqli_query($conexion, $query);
                ?>
                alert("Compra cancelada");
            },
            onError: function(err) {
                <?php
                $query = "DELETE FROM user_reservation 
                    WHERE reservation_id = (
                        SELECT reservation_id FROM (
                            SELECT reservation_id FROM user_reservation ORDER BY reservation_id DESC LIMIT 1
                        ) AS subquery
                    );
                    ";
                $result = mysqli_query($conexion, $query);
                ?>
                alert("Error de transaccion");
            }
        }).render('#paypal-button-container');
    </script>

</body>

</html>