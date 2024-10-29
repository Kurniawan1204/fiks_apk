<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" href="{{ asset('style/images/1.1.png') }}">
    <link rel="shortcut icon" href="{{ asset('style/images/1.1.png') }}">
    <title>Halaman Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>   
    body {
        align-items: center;
            justify-content: center;
            min-height: 100vh;
               
        }    
        .register-container {
            margin-top: 50px;
        }
        .nav-logo {
            width: 100px;
        }
        .logo_register {
            width: 100%;
            max-width: 800px;
            height: 560px;
            display: block;
            margin: 0 auto;
            animation: slideUp 0.8s ease-in-out;

        }   
         @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.8s ease-in-out;

        }

    

        .input-group-text {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class=" text-center">
        <a href="{{ route('register') }}">
            <img class="nav-logo" src="{{ asset('style/images/1.3.png') }}">
        </a>
    </div>

    <div class="container register-container">
        <div class="row justify-content-center align-items-center">
            <!-- Image Section -->
            <div class="col-md-6 text-center">
                <img class="logo_register" src="{{ asset('style/images/2.2.jpg') }}" alt="Register Illustration">
            </div>
            
            <!-- Form Section -->
            <div class="col-md-4">
                <div class="card">

                    <div class=" text-center">
                        <h4>Registrasi</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Nama</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                    <button type="button" id="toggle-password" style="background: none; border: none; outline: none;">
                                        <i class="fa fa-eye" id="eye-icon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                                    <button type="button" id="toggle-password-confirmation" style="background: none; border: none; outline: none;">
                                        <i class="fa fa-eye" id="eye-icon-confirmation"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>
                                <div class="col-md-24 captcha input-group">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger h-25 mt-3 ms-3" class="reload" id="reload">
                                    &#x21bb;
                                    </button>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="captcha" class="col-md-4 col-form-label text-md-right">Enter Captcha</label>
                                <div class="col-lg-6 mb-1 input-group">
                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                </div>
                            </div>
                            <div class="form-group ">
                                <button id="register-btn" type="submit" class="btn btn-primary w-100">Daftar</button>

                            </div>
                        </form>
                    </div>
                    <div class="text-center">
                        <p>Sudah punya akun? <a href="{{ route('login') }}">Login sekarang!</a>
                            {{-- <svg class="h-25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,64L20,96C40,128,80,192,120,202.7C160,213,200,171,240,133.3C280,96,320,64,360,53.3C400,43,440,53,480,80C520,107,560,149,600,170.7C640,192,680,192,720,181.3C760,171,800,149,840,165.3C880,181,920,235,960,245.3C1000,256,1040,224,1080,218.7C1120,213,1160,235,1200,234.7C1240,235,1280,213,1320,181.3C1360,149,1400,107,1420,85.3L1440,64L1440,320L1420,320C1400,320,1360,320,1320,320C1280,320,1240,320,1200,320C1160,320,1120,320,1080,320C1040,320,1000,320,960,320C920,320,880,320,840,320C800,320,760,320,720,320C680,320,640,320,600,320C560,320,520,320,480,320C440,320,400,320,360,320C320,320,280,320,240,320C200,320,160,320,120,320C80,320,40,320,20,320L0,320Z"></path></svg> --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
   // BERFUNGSI UNTUK MENAMPILKAN PASSWORD ATAU MENG HIDDEN PASSWORD
   document.getElementById("toggle-password").addEventListener("click", function () {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    });

   // BERFUNGSI UNTUK MENAMPILKAN PASSWORD ATAU MENG HIDDEN PASSWORD
   document.getElementById("toggle-password-confirmation").addEventListener("click", function () {
        const passwordConfirmationField = document.getElementById("password_confirmation");
        const eyeIconConfirmation = document.getElementById("eye-icon-confirmation");

        if (passwordConfirmationField.type === "password") {
            passwordConfirmationField.type = "text";
            eyeIconConfirmation.classList.remove("fa-eye");
            eyeIconConfirmation.classList.add("fa-eye-slash");
        } else {
            passwordConfirmationField.type = "password";
            eyeIconConfirmation.classList.remove("fa-eye-slash");
            eyeIconConfirmation.classList.add("fa-eye");
        }
    });


         // Fungsi untuk mengecek kesamaan password
    function validatePasswordMatch() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("password_confirmation").value;

        if (password !== confirmPassword) {
            swal("Error!", " password tidak cocok!", "error");
            return false;
        }
        return true;
    }

    // Tambahkan event listener pada tombol submit
    document.getElementById("register-btn").addEventListener("click", function(event) {
        if (!validatePasswordMatch()) {
            event.preventDefault(); // Mencegah pengiriman form jika password tidak cocok
        }
    });
    // UNTUK RECAPTCHA
         $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
        // Menangani notifikasi SweetAlert
        @if(session('status'))
            swal("Sukses!", "{{ session('status') }}", "success");
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
            swal("Error!", "{{ $error === 'validation.captcha' ? 'Captcha salah' : $error }}", "error");
            @endforeach
        @endif
    </script>
    

</body>
</html>
