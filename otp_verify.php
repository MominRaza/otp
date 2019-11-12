<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP</title>
</head>
<body>
    <form action="" method="post">
        <input type="Number" name="otpnumber"  placeholder="Enter OTP"  required>
        <input type="submit" name="verifyotp" value="Veryfy OTP">
    </form>
</body>
</html>


<?php

session_start();

$authKey = "258990A7r0joW3KPi65c51e3c6";
$senderId = "ITSMEZ";

if(isset($_POST['verifyotp']))
{
    $mobileNumber = $_SESSION['mobile_number'];
    $otpverify = $_POST['otpnumber'];

    //API URL
    $url="https://control.msg91.com/api/verifyRequestOTP.php?authkey=$authKey&mobile=$mobileNumber&otp=$otpverify";

    $curl = curl_init($url);

    curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) 
    {
    echo "cURL Error #:" . $err;
    }
    else {
        $json = json_decode($response);

        if($json->type == 'success')
        {
            header('location: home.php');
        }
        else
        {
            echo 'Your OTP "'.$json->message.'"';
        }
    }
}

?>