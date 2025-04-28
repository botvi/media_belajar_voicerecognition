<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">

    <title>Menyusun Kata</title>
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
            background-image: url('{{ asset('web') }}/assets/img/bg-index2.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: #9999ff;
        }
        
        .abjad-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 30px;
            gap: 15px;
            padding: 0 15px;
        }
        
        .card {
            padding: 20px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.9);
        }

        .card-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            padding: 25px;
            margin: 20px auto;
            max-width: 800px;
        }

        .btn-kembali {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .btn-kembali img {
            transition: transform 0.3s ease-in-out;
            max-height: 60px;
            width: auto;
        }

        .letter-box {
            width: 50px;
            height: 50px;
            border: 2px solid #333;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 5px;
            font-size: 24px;
            background: white;
            cursor: move;
            border-radius: 8px;
        }

        .answer-container {
            display: flex;
            justify-content: center;
            min-height: 60px;
            margin: 20px 0;
            gap: 5px;
        }

        .letter-slot {
            width: 50px;
            height: 50px;
            border: 2px dashed #666;
            border-radius: 8px;
            margin: 5px;
        }

        .letters-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px 0;
            gap: 5px;
        }

        @media (max-width: 768px) {
            .card-container {
                margin: 15px;
                padding: 15px;
            }
            
            .letter-box {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
            
            .letter-slot {
                width: 40px;
                height: 40px;
            }
            
            .btn-kembali img {
                max-height: 50px;
            }
        }

        @media (max-width: 480px) {
            .card-container {
                margin: 10px;
                padding: 10px;
            }
            
            .letter-box {
                width: 35px;
                height: 35px;
                font-size: 18px;
            }
            
            .letter-slot {
                width: 35px;
                height: 35px;
            }
            
            .btn-kembali img {
                max-height: 40px;
            }
        }
    </style>
</head>
<body class="p-2">
    <div class="btn-kembali">
        <a href="{{ route('web.menuutama') }}"><img src="{{ asset('web') }}/assets/btn/btn-kembali.png" alt="Kembali"></a>
    </div>
    <div class="container card-container">
        <h1 class="text-center" style="color: #ff66b5;">MENYUSUN KATA</h1>
        <div class="abjad-container">
            <div class="card shadow border-0 mb-4">
                <div class="text-center mb-4" style="display: none;" id="soal">
                    <h3>Soal: <span id="soal"></span></h3>
                </div>
                <div class="answer-container" id="answerContainer"></div>
                <div class="letters-container" id="lettersContainer"></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let soalData = [];
        let currentIndex = 0;

        // Ambil data soal dari API
        fetch('{{ route("web.getmenyusunkata") }}')
            .then(response => response.json())
            .then(data => {
                soalData = data;
                tampilkanSoal();
            });

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function tampilkanSoal() {
            if (currentIndex < soalData.length) {
                document.getElementById('soal').textContent = soalData[currentIndex].soal;
                
                const answerContainer = document.getElementById('answerContainer');
                const lettersContainer = document.getElementById('lettersContainer');
                
                answerContainer.innerHTML = '';
                lettersContainer.innerHTML = '';

                const jawaban = soalData[currentIndex].jawaban.toUpperCase();
                const hurufAcak = shuffleArray(jawaban.split(''));

                // Buat slot jawaban
                for(let i = 0; i < jawaban.length; i++) {
                    const slot = document.createElement('div');
                    slot.className = 'letter-slot';
                    slot.setAttribute('data-index', i);
                    answerContainer.appendChild(slot);
                }

                // Buat kotak huruf yang bisa di-drag
                hurufAcak.forEach((huruf, index) => {
                    const box = document.createElement('div');
                    box.className = 'letter-box';
                    box.textContent = huruf;
                    box.draggable = true;
                    box.setAttribute('data-letter', huruf);
                    box.setAttribute('data-index', index); // Tambahkan indeks unik
                    
                    box.addEventListener('dragstart', (e) => {
                        e.dataTransfer.setData('text/plain', huruf);
                        e.dataTransfer.setData('index', index); // Simpan indeks
                        e.target.classList.add('dragging');
                    });

                    box.addEventListener('dragend', (e) => {
                        e.target.classList.remove('dragging');
                    });

                    lettersContainer.appendChild(box);
                });

                // Event listeners untuk drop zones
                const slots = document.querySelectorAll('.letter-slot');
                slots.forEach(slot => {
                    slot.addEventListener('dragover', (e) => {
                        e.preventDefault();
                    });

                    slot.addEventListener('drop', (e) => {
                        e.preventDefault();
                        const letter = e.dataTransfer.getData('text/plain');
                        const letterIndex = e.dataTransfer.getData('index');
                        const letterBox = document.querySelector(`.letter-box[data-index="${letterIndex}"]`);
                        
                        if(letterBox) {
                            if(slot.hasChildNodes()) {
                                // Jika slot sudah berisi, kembalikan huruf yang ada ke container
                                const existingLetter = slot.firstChild;
                                lettersContainer.appendChild(existingLetter);
                            }
                            slot.appendChild(letterBox);
                            checkAnswer();
                        }
                    });
                });
            } else {
                Swal.fire({
                    title: 'Selamat!',
                    text: 'Anda telah menyelesaikan semua soal!',
                    icon: 'success',
                    confirmButtonText: 'Main Lagi'
                }).then((result) => {
                    if (result.isConfirmed) {
                        currentIndex = 0;
                        tampilkanSoal();
                    }
                });
            }
        }

        function checkAnswer() {
            const slots = document.querySelectorAll('.letter-slot');
            let userAnswer = '';
            let isFull = true;

            slots.forEach(slot => {
                if(slot.hasChildNodes()) {
                    userAnswer += slot.firstChild.textContent;
                } else {
                    isFull = false;
                }
            });

            if(isFull) {
                if(userAnswer === soalData[currentIndex].jawaban.toUpperCase()) {
                    Swal.fire({
                        title: 'Benar!',
                        text: 'Jawaban Anda Benar',
                        icon: 'success',
                        confirmButtonText: 'Lanjut'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            currentIndex++;
                            tampilkanSoal();
                        }
                    });
                } else {
                    // Jika jawaban salah, kembalikan semua huruf ke container
                    const lettersContainer = document.getElementById('lettersContainer');
                    slots.forEach(slot => {
                        if(slot.hasChildNodes()) {
                            lettersContainer.appendChild(slot.firstChild);
                        }
                    });
                    
                    Swal.fire({
                        title: 'Salah!',
                        text: 'Silakan coba lagi',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        }
    </script>

</body>
</html>
