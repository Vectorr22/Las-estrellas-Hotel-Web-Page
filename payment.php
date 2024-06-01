<?php
session_start();
include("php/connection.php");
include("php/functions.php");

// Verificar que la reserva esté en la sesión
if (!isset($_SESSION['reservation'])) {
    die("No reservation data found.");
}

$reservation_id = $_SESSION['reservation']['id'];  // Ajusta esto según cómo almacenes la reserva
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete su pago</title>
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
            }
            // onCancel: function(data) {
            //     console.log("Payment cancelled:", data);
            //     <?php
                    //     // Solo elimina la reserva si la transacción es cancelada
                    //     $query = "DELETE FROM user_reservation WHERE reservation_id = $reservation_id";
                    //     $result = mysqli_query($conexion, $query);
                    //     if (!$result) {
                    //         error_log("Error deleting reservation on cancel: " . mysqli_error($conexion));
                    //     } else {
                    //         error_log("Reservation deleted on cancel: $reservation_id");
                    //     }
                    //     
                    ?>
            //     alert("Compra cancelada");
            // },
            // onError: function(err) {
            //     console.log("Payment error:", err);
            //     <?php
                    //     // Solo elimina la reserva si hay un error en la transacción
                    //     $query = "DELETE FROM user_reservation WHERE reservation_id = $reservation_id";
                    //     $result = mysqli_query($conexion, $query);
                    //     if (!$result) {
                    //         error_log("Error deleting reservation on error: " . mysqli_error($conexion));
                    //     } else {
                    //         error_log("Reservation deleted on error: $reservation_id");
                    //     }
                    //     
                    ?>
            //     alert("Error de transaccion");
            // }
        }).render('#paypal-button-container');
    </script>

</body>

</html>