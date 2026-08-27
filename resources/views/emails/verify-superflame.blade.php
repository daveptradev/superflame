<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>SUPERFLAME VERIFY</title>
</head>

<body style="
margin:0;
padding:0;
background:#050505;
font-family:Arial,sans-serif;
">

<div style="
max-width:700px;
margin:auto;
padding:60px 30px;
text-align:center;
color:white;
">

    <h1 style="
    color:#ff1f1f;
    font-size:52px;
    margin-bottom:20px;
    letter-spacing:2px;
    ">
        SUPERFLAME
    </h1>

    <div style="
    background:#0f0f0f;
    border:1px solid #222;
    border-radius:24px;
    padding:60px 40px;
    ">

        <h2 style="
        font-size:42px;
        margin-bottom:20px;
        line-height:1.2;
        ">
            VERIFY YOUR <br>

            <span style="color:#ff1f1f;">
                EMAIL ADDRESS
            </span>
        </h2>

        <p style="
        color:#999;
        font-size:16px;
        line-height:1.8;
        margin-top:30px;
        ">

            Welcome to SUPERFLAME.

            <br><br>

            Click the button below to activate your account.

        </p>

        <a href="{{ $url }}"
            style="
            display:inline-block;
            margin-top:40px;
            background:#ff1f1f;
            color:white;
            padding:18px 40px;
            border-radius:14px;
            text-decoration:none;
            font-weight:bold;
            letter-spacing:1px;
            font-size:15px;
            ">

            VERIFY EMAIL

        </a>

        <p style="
        margin-top:50px;
        color:#555;
        font-size:13px;
        line-height:1.8;
        ">

            If you did not create an account,
            no further action is required.

        </p>

    </div>

    <p style="
    margin-top:40px;
    color:#444;
    font-size:12px;
    ">

        © {{ date('Y') }} SUPERFLAME

    </p>

</div>

</body>
</html>