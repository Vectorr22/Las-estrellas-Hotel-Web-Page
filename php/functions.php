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