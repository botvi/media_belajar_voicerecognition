<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">

    <title>Media Pembelajaran</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'TimKid';
            src: url('{{ asset('web') }}/assets/font/TimKid.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'TimKid', sans-serif;
            background-image: url('{{ asset('web') }}/assets/img/bg-index2.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .greeting-text {
            color: #ff66b5;
            text-align: center;
            animation: floating 3s infinite;
            -webkit-text-stroke: 1px black;
        }
        .greeting-text-title {
            color: #ffffff;
            text-align: center;
            -webkit-text-stroke: 1px black;
            /* animation: floating 3s infinite; */
        }

        .btn-mulai img {
            transition: transform 0.3s ease-in-out;
        }
        .btn-mulai img:hover {
            transform: scale(1.1);
        }

        @keyframes floating {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .rotate-message h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="p-2">
    <div class="container">
        <h1 class="greeting-text-title">Media Pembelajaran</h1>
        <h2 class="greeting-text">Mari Belajar</h2>
        <h3 class="greeting-text">Secara Interaktif</h3>
        <div class="text-center btn-mulai mt-4">
            <a href="{{ route('web.menuutama') }}"><img src="{{ asset('web') }}/assets/btn/btn-mulai.png" height="80px" alt=""></a>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
