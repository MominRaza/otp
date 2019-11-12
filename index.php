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
        <input type="text" name="uname" id="name" placeholder="Enter Name" required>
        <input type="Number" name="number" id="number"  placeholder="Enter Number"  required>
        <input type="submit" name="sendotp" value="Send OTP">
    </form>
</body>
</html>


<?php

session_start();

$authKey = "258990A7r0joW3KPi65c51e3c6";
$senderId = "ITSMEZ";

if(isset($_POST['sendotp']))
{
    $_SESSION['user_name'] = $_POST['uname'];
    $uname = $_SESSION['user_name'];

    $_SESSION['mobile_number'] = $_POST['number'];

    $mobileNumber = $_SESSION['mobile_number'];

    $message = 'Hi '.$uname.' welcome. Your verification code is ##OTP##';

        
    //Prepare you post parameters
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $message,
        'sender' => $senderId
    );

    //API URL
    $url="http://control.msg91.com/api/sendotp.php";

    $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
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
            header('location: otp_verify.php');
        }
        else
        {
            echo 'Your OTP "'.$json->message.'"';
        }
    }
}

?>