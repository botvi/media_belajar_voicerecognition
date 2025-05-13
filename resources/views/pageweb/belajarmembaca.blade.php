<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">

    <title>Belajar Membaca</title>
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

        #displayText {
            font-size: 2rem;
            margin: 20px 0;
            padding: 15px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8);
        }

        .btn {
            padding: 10px 25px;
            font-size: 1.1rem;
            border-radius: 10px;
            margin: 10px 5px;
        }

        #result {
            font-size: 1.8rem;
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8);
        }

        .incorrect {
            color: red;
        }

        .correct {
            color: green;
        }

        @media (max-width: 768px) {
            .card-container {
                margin: 15px;
                padding: 15px;
            }
            
            #displayText {
                font-size: 1.5rem;
            }
            
            .btn {
                padding: 8px 20px;
                font-size: 1rem;
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
            
            #displayText {
                font-size: 1.2rem;
            }
            
            .btn {
                padding: 6px 15px;
                font-size: 0.9rem;
                width: 100%;
                margin: 5px 0;
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
        <h1 class="text-center" style="color: #ff66b5;">BELAJAR MEMBACA</h1>
        <div class="abjad-container">
            <form id="listening-quiz-form">
                <div class="card shadow border-0 mb-4">
                    <p style="font-size: 18px; font-weight: 500;">Ucapkan kata yang muncul di bawah ini:</p>
                    <div class="audio-container text-center p-3">
                        <div id="displayText">- Kata Muncul Disini -</div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                        <button type="button" class="btn btn-primary"  id="startBtn" onclick="requestMicrophonePermission()">Mulai</button>
                        <button type="button" class="btn btn-danger" id="stopBtn" onclick="stopRecognition()">Berhenti</button>
                        <button type="button" class="btn btn-success" onclick="nextWord()" id="nextBtn" style="display:none;">Selanjutnya</button>
                    </div>
                </div>
                <p id="result" class="text-center">Hasil akan muncul di sini...</p>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentIndex = 0;
        let texts = [];
        let score = 0;
        let correctWords = new Set();
        
        // Tambahkan variabel audio
        const audioBenar = new Audio('{{ asset("sound/benar.mp3") }}');
        const audioSalah = new Audio('{{ asset("sound/salah.mp3") }}');
        const audioSelesai = new Audio('{{ asset("sound/selesai.mp3") }}');
    
        fetch('/getbelajarmembaca')
            .then(response => response.json())
            .then(data => {
                texts = data;
                getRandomText();
            })
            .catch(error => console.error('Error fetching texts:', error));
    
        let targetText = '';
        let spokenWords = [];
        let recognition;

        function requestMicrophonePermission() {
            Swal.fire({
                title: 'Izin Penggunaan Mikrofon',
                text: 'Aplikasi ini membutuhkan akses ke mikrofon Anda. Apakah Anda mengizinkan?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Izinkan',
                cancelButtonText: 'Tolak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    navigator.mediaDevices.getUserMedia({ audio: true })
                        .then(function(stream) {
                            stream.getTracks().forEach(track => track.stop());
                            startRecognition();
                        })
                        .catch(function(err) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Tidak dapat mengakses mikrofon. Pastikan Anda telah memberikan izin di pengaturan browser.',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        });
                }
            });
        }
    
        function getRandomText() {
            targetText = texts[currentIndex];
            spokenWords = [];
            correctWords.clear();
            document.getElementById('nextBtn').style.display = 'none';
            document.getElementById('startBtn').style.display = 'block';
            document.getElementById('stopBtn').style.display = 'block';
            updateDisplay();
            if (recognition) {
                recognition.stop();
                recognition = null;
            }
        }
    
        function updateDisplay() {
            const words = targetText.split(' ');
            let displayHTML = words
                .map((word, index) => {
                    if (correctWords.has(index)) {
                        return `<span class="correct">${word}</span>`;
                    } else if (spokenWords[index] === false) {
                        return `<span class="incorrect">${word}</span>`;
                    }
                    return `<span>${word}</span>`;
                })
                .join(' ');
            document.getElementById('displayText').innerHTML = displayHTML;
        }
    
        function startRecognition() {
            if (!recognition) {
                recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
                recognition.lang = 'id-ID';
                recognition.continuous = true;
    
                recognition.onresult = function (event) {
                    const spokenText = event.results[event.results.length - 1][0].transcript.trim().toLowerCase();
                    document.getElementById('result').innerText = 'Anda mengatakan: ' + spokenText;
    
                    const words = targetText.split(' ');
                    const spokenArray = spokenText.split(' ');
    
                    words.forEach((word, index) => {
                        if (spokenArray.includes(word.toLowerCase())) {
                            correctWords.add(index);
                        } else {
                            audioSalah.play();
                            Swal.fire({
                                icon: 'error',
                                title: 'Salah!',
                                text: 'Coba lagi ya!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });

                    updateDisplay();
    
                    if (correctWords.size === words.length) {
                        score++;
                        recognition.stop();
                        audioBenar.play();
                        Swal.fire({
                            icon: 'success',
                            title: 'Bagus!',
                            text: 'Semua kata telah diucapkan dengan benar!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            if (currentIndex < texts.length - 1) {
                                document.getElementById('nextBtn').style.display = 'block';
                                document.getElementById('startBtn').style.display = 'none';
                                document.getElementById('stopBtn').style.display = 'none';
                            } else {
                                showFinalResult();
                            }
                        });
                    }
                };
    
                recognition.onerror = function (event) {
                    alert('Error: ' + event.error);
                };
            }
    
            recognition.start();
        }
    
        function stopRecognition() {
            if (recognition) {
                recognition.stop();
            }
        }

        function nextWord() {
            currentIndex++;
            getRandomText();
        }
    
        function showFinalResult() {
            const finalScore = (score / texts.length) * 100;
            audioSelesai.play();
            
            Swal.fire({
                icon: 'success',
                title: 'Selamat!',
                html: `
                    <p>Yeayyy,kamu telah menyelesaikan semua soal!</p>
                    <p>Skor kamu: ${finalScore}%</p>
                `,
                allowOutsideClick: false,
                confirmButtonText: 'Kembali',
                timer: 5000,
                timerProgressBar: true
            }).then(() => {
                window.location.href = "{{ route('web.belajarmembaca') }}";
            });
        }
    </script>
</body>
</html>
