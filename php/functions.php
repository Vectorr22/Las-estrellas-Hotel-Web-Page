<?php

function check_login($conexion){

    if(isset($_SESSION['user_data']))
    {
        $email = $_SESSION['user_data']['user_email'];
        $query = "select * from user_data where user_email = '$email' limit 1";
        $result = mysqli_query($conexion,$query);
        if($result && mysqli_num_rows($result)>0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    else
    {
        header("Location: login.php");
        die;
    }
}

function get_prices($reservation_data){
    $typeOfRoom = $reservation_data['tipo_Habitacion'];
    $num_habitaciones = $reservation_data['noHabitaciones'];
    switch($typeOfRoom)
    {
        case "sencilla":
            $night_price = 70;
            $check_in = $reservation_data['check_in'];
            $check_out = $reservation_data['check_out'];
            $dateIn = new DateTime($check_in);
            $dateOut = new DateTime($check_out);
            $diferencia = $dateIn->diff($dateOut);
            $noches = $diferencia->days;
            $costeHabitaciones = $night_price*$num_habitaciones;
            $subtotal_habitaciones = $costeHabitaciones * $noches;
            $iva = $subtotal_habitaciones * 0.16;
            $total = $subtotal_habitaciones + $iva;
            $prices = [
                'precio_noche' => $night_price,
                'noches' => $noches,
                'coste_habitaciones' => $costeHabitaciones,
                'subtotal_habitaciones' => $subtotal_habitaciones,
                'iva' => $iva,
                'total' => $total
            ];

            return $prices;

            break;

        case "doble":
            $night_price = 120;
            $check_in = $reservation_data['check_in'];
            $check_out = $reservation_data['check_out'];
            $dateIn = new DateTime($check_in);
            $dateOut = new DateTime($check_out);
            $diferencia = $dateIn->diff($dateOut);
            $noches = $diferencia->days;
            $costeHabitaciones = $night_price*$num_habitaciones;
            $subtotal_habitaciones = $costeHabitaciones * $noches;
            $iva = $subtotal_habitaciones * 0.16;
            $total = $subtotal_habitaciones + $iva;
            $prices = [
                'precio_noche' => $night_price,
                'noches' => $noches,
                'coste_habitaciones' => $costeHabitaciones,
                'subtotal_habitaciones' => $subtotal_habitaciones,
                'iva' => $iva,
                'total' => $total
            ];

            return $prices;
            break;

        case "deluxe":
            $night_price = 250;
            $check_in = $reservation_data['check_in'];
            $check_out = $reservation_data['check_out'];
            $dateIn = new DateTime($check_in);
            $dateOut = new DateTime($check_out);
            $diferencia = $dateIn->diff($dateOut);
            $noches = $diferencia->days;
            $costeHabitaciones = $night_price*$num_habitaciones;
            $subtotal_habitaciones = $costeHabitaciones * $noches;
            $iva = $subtotal_habitaciones * 0.16;
            $total = $subtotal_habitaciones + $iva;
            $prices = [
                'precio_noche' => $night_price,
                'noches' => $noches,
                'coste_habitaciones' => $costeHabitaciones,
                'subtotal_habitaciones' => $subtotal_habitaciones,
                'iva' => $iva,
                'total' => $total
            ];
            
            return $prices;
            break;

        case "lunaDeMiel":
            $night_price = 200;
            $check_in = $reservation_data['check_in'];
            $check_out = $reservation_data['check_out'];
            $dateIn = new DateTime($check_in);
            $dateOut = new DateTime($check_out);
            $diferencia = $dateIn->diff($dateOut);
            $noches = $diferencia->days;
            $costeHabitaciones = $night_price*$num_habitaciones;
            $subtotal_habitaciones = $costeHabitaciones * $noches;
            $iva = $subtotal_habitaciones * 0.16;
            $total = $subtotal_habitaciones + $iva;
            $prices = [
                'precio_noche' => $night_price,
                'noches' => $noches,
                'coste_habitaciones' => $costeHabitaciones,
                'subtotal_habitaciones' => $subtotal_habitaciones,
                'iva' => $iva,
                'total' => $total
            ];
            
            return $prices;

            break;
    }
}


function generarIdentificador() {
    // Generar dos letras aleatorias
    $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $letra1 = $letras[random_int(0, strlen($letras) - 1)];
    $letra2 = $letras[random_int(0, strlen($letras) - 1)];

    // Generar cuatro números aleatorios
    $numeros = random_int(1000, 9999);

    // Combinar letras y números en el formato deseado
    $identificador = $letra1 . $letra2 . '-' . $numeros;

    return $identificador;
}


