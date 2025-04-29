<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">

    <title>Mengenal Abjad</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Load font TimKid */
        @font-face {
            font-family: 'TimKid';
            src: url('{{ asset('web') }}/assets/font/TimKid.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'TimKid', sans-serif;
            background-image: url('{{ asset('web') }}/assets/img/bg-index2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #9999ff;
        }
        
        .abjad-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 50px;
            gap: 10px;
        }
        
        .abjad-item {
            font-size: 2.5rem;
            width: 100px;
            height: 100px;
            margin: 5px;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.2s;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .abjad-item:hover {
            transform: scale(1.1);
        }

        .card-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .btn-kembali img {
            transition: transform 0.3s ease-in-out;
            margin-top: 20px;
        }

        .btn-kembali img:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .abjad-item {
                font-size: 2rem;
                width: 80px;
                height: 80px;
            }
        }

        @media (max-width: 480px) {
            .abjad-item {
                font-size: 1.5rem;
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body class="p-2">
    
    <div class="container card-container">
        <h1 class="text-center" style="color: #ff66b5;">MENGENAL ABJAD</h1>
        <div class="abjad-container">
            @foreach($alfabet[0]['alfabet'] as $huruf)
            <div class="abjad-item text-light" style="background-color: #{{ str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT) }};" data-sound="{{ asset($huruf['suara']) }}">
                {{ $huruf['huruf'] }}
            </div>
            @endforeach
        </div>
        <div class="text-center btn-kembali">
            <a href="{{ route('web.menuutama') }}"><img src="{{ asset('web') }}/assets/btn/btn-kembali.png" height="80px" alt="Kembali"></a>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var items = document.querySelectorAll('.abjad-item');
            items.forEach(function(item) {
                item.addEventListener('click', function() {
                    var sound = item.getAttribute('data-sound');
                    var audio = new Audio(sound);
                    audio.play();
                });
            });
        });
    </script>
</body>
</html>
