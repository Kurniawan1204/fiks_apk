<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftung</title>
    <link rel="apple-touch-icon" href="{{ asset('style/images/1.1.png') }}">
    <link rel="shortcut icon" href="{{ asset('style/images/1.1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
      body {
            align-items: center;
            justify-content: center;
            /* min-height: 100vh; */
      }
        .login-container {
            margin-top: 20px;
        }
        .nav-logo {
            width: 100px;
        }
        .logo_login {
            width: 100%;
            max-width: 800px;
            height: 560px;
            display: block;
            margin: 0 auto;
            animation: slideUp 0.8s ease-in-out;

        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.8s ease-in-out;

        }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .input-group-text {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="mt-2 text-center">
        <a href="{{ route('login') }}">
            <img class="nav-logo" src="{{ asset('style/images/1.3.png') }}">                     
        </a>
    </div>

    <div class="container login-container">  
        <div class="row justify-content-center align-items-center">
            <!-- Image Section -->
            <div class="col-md-6 text-center">
                <img class="logo_login" src="{{ asset('style/images/2.1.jpg') }}" alt="Login Illustration">
            </div>
            
            <!-- Form Section -->
            <div class="col-md-4">
                <div class="card">                 
                        <h4 class=" mt-2 text-center">Login</h4>
                        <p class="text-center">Selamat datang di halaman login</p>
                        <div class="card-body">
                        <form id="loginForm" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                    <button type="button" id="toggle-password" style="background: none; border: none; outline: none;">
                                        <i class="fa fa-eye" id="eye-icon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" required>
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100" id="login-btn">
                                <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                Login
                            </button>
                        </form>
                    </div>
                    <div class="text-center">
                        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang!</a></p>
                    </div>
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,64L20,96C40,128,80,192,120,202.7C160,213,200,171,240,133.3C280,96,320,64,360,53.3C400,43,440,53,480,80C520,107,560,149,600,170.7C640,192,680,192,720,181.3C760,171,800,149,840,165.3C880,181,920,235,960,245.3C1000,256,1040,224,1080,218.7C1120,213,1160,235,1200,234.7C1240,235,1280,213,1320,181.3C1360,149,1400,107,1420,85.3L1440,64L1440,320L1420,320C1400,320,1360,320,1320,320C1280,320,1240,320,1200,320C1160,320,1120,320,1080,320C1040,320,1000,320,960,320C920,320,880,320,840,320C800,320,760,320,720,320C680,320,640,320,600,320C560,320,520,320,480,320C440,320,400,320,360,320C320,320,280,320,240,320C200,320,160,320,120,320C80,320,40,320,20,320L0,320Z"></path></svg> --}}

                </div>
            </div>
        </div>
    </div>

    <script>
        // BERFUNGSI SEBAGAI PERINGATAN ATAU ALERT JIKA ADA YANG BELUM DI ISI PASSWORD ATAU USERNAME NYA
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            if (username === '') {
                event.preventDefault(); // Mencegah form dikirim
                swal("peringatan!", "Username belum terisi.", "warning");
                return; // Hentikan eksekusi selanjutnya
            }

            if (password === '') {
                event.preventDefault(); // Mencegah form dikirim
                swal("Peringatan!", "Password belum terisi.", "warning");
                return; // Hentikan eksekusi selanjutnya
            }

            // Jika semua input terisi, tampilkan spinner
            document.getElementById('spinner').classList.remove('d-none');
            document.getElementById('login-btn').setAttribute('disabled', true); // Nonaktifkan tombol
        });

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
        // Menangani notifikasi SweetAlert dari backend (jika ada kesalahan login)
        @if(session('status'))
            swal("Sukses!", "{{ session('status') }}", "success");
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                swal("Error!", "{{ $error }}", "error");
            @endforeach
        @endif
    </script>
</body>
</html>
