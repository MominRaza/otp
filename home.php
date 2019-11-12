<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP</title>
</head>
<body>
    Hi <?php session_start(); echo $_SESSION['user_name']; ?> Your OTP is Verified.
</body>
</html>