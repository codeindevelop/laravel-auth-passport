<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام در سایت</title>
</head>

<body>

    <h2>سلام {{ $first_name }}</h2>
    <p>ثبت نام شما با موفقیت انجام شد جهت فعالسازی حساب خود روی لینک زیر کلیک کنید</p>

    <a href={{ env('EMAIL_ACTIVE_LINK_PREFIX') . $activation_token  }}>فعالسازی اکانت</a>



</body>

</html>