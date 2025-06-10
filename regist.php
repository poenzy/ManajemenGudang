<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .split-container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        .form-half {
            flex: 1;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .image-half {
            flex: 1;
            background-image: url('https://images.unsplash.com/photo-1601598838108-5019bf3ea4a6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fHdhcmVob3VzZXxlbnwwfHwwfHx8MA%3D%3D');
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            width: 380px;
            max-width: 100%;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            margin: auto;
            padding: 40px;
        }

        .logo img {
            width: 100px;
            height: 80px;
            text-align: center;
            border-radius: 25px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 15px;
            font-size: 14px;
            outline: none;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #aaa;
        }

        .password-field {
            position: relative;
        }

        .register-btn {
            width: 100%;
            padding: 12px;
            background-color: #6c5ce7;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .register-btn:hover {
            background-color: #5b4bc9;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #6c5ce7;
            text-decoration: none;
            font-weight: bold;
        }

        .checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .checkbox input {
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .split-container {
                flex-direction: column;
            }

            .form-half, .image-half {
                flex: none;
                width: 100%;
                height: 50vh;
            }

            .image-half {
                border-radius: 15px 15px 0 0;
            }

            .form-half {
                border-radius: 0 0 15px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="split-container">
        <div class="image-half"></div>
        <div class="form-half">
            <div class="wrapper">
                <div class="logo">
                    <img src="img/logo.png" alt="logo">
                </div>
                <h1>Register an account</h1>
                <form action="proses_regist.php" method="post" id="registerForm" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" placeholder="Enter your full name" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" placeholder="Enter your username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email address" name="email" required>
                    </div>
                    <div class="form-group" style="display: flex; gap: 10px;">
                        <div style="flex: 1;">
                            <label for="password">Password</label>
                            <input type="password" id="password" placeholder="Enter your password" name="password" required style="width: 100%;">
                        </div>
                        <div style="flex: 1;">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" id="confirmPassword" placeholder="Confirm your password" name="RegisterForm" required style="width: 100%;">
                        </div>
                    </div>
                    <!-- CAPTCHA Section -->
                    <div class="form-group">
                        <label for="captchaInput">CAPTCHA</label>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div id="captcha" style="font-weight: bold; font-size: 18px; letter-spacing: 4px; padding: 8px 12px; background: #f0f0f0; border-radius: 8px;"></div>
                            <button type="button" onclick="generateCaptcha()" style="padding: 6px 10px;">⟳</button>
                        </div>
                        <input type="text" id="captchaInput" placeholder="Enter CAPTCHA here" required style="margin-top: 10px; width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc;" >
                    </div>
                    <button type="submit" class="register-btn" name="input">Register</button>
                    <div class="login-link">
                        Sudah mempunyai akun? <a href="login.php">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const captchaInput = document.getElementById("captchaInput").value;
            // Validasi nama
            if (!name) {
                alert('Silakan masukkan nama lengkap Anda');
                return false;
            }
            
            // Validasi email
            if (!email || !email.includes('@')) {
                alert('Silakan masukkan alamat email yang valid');
                return false;
            }
            
            // Validasi password (minimal 6 karakter)
            if (!password || password.length < 6) {
                alert('Password harus minimal 6 karakter');
                return false;
            }
            
            // Validasi konfirmasi password
            if (password !== confirmPassword) {
                alert('Password dan konfirmasi password tidak cocok');
                return false;
            }

             // Validasi CAPTCHA
            if (captchaInput !== generatedCaptcha) {
                alert("CAPTCHA tidak cocok. Silakan coba lagi.");
                generateCaptcha(); // Refresh CAPTCHA jika salah
                return false;
            }

            // Jika semua validasi berhasil, form akan dikirim ke login.html
            return true;
        }
        let generatedCaptcha = "";
        function generateCaptcha() {
            const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            let captcha = "";
            for (let i = 0; i < 6; i++) {
                captcha += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            generatedCaptcha = captcha;
            document.getElementById("captcha").textContent = captcha;
        }

        // Panggil CAPTCHA saat halaman selesai dimuat
        document.addEventListener("DOMContentLoaded", function () {
            generateCaptcha();

            const formHalf = document.querySelector('.form-half');
            formHalf.style.transform = 'translateX(-100%)';
            formHalf.style.opacity = '0';
            formHalf.style.transition = 'transform 0.5s ease-out, opacity 0.5s ease-out';
            setTimeout(() => {
                formHalf.style.transform = 'translateX(0)';
                formHalf.style.opacity = '1';
            }, 100);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const formHalf = document.querySelector('.form-half');
            
            // Set initial position (off-screen to the left)
            formHalf.style.transform = 'translateX(-100%)';
            formHalf.style.opacity = '0';
            formHalf.style.transition = 'transform 0.5s ease-out, opacity 0.5s ease-out';
            
            // Trigger animation after a small delay
            setTimeout(() => {
                formHalf.style.transform = 'translateX(0)';
                formHalf.style.opacity = '1';
            }, 100);
        });
    </script>
</body>
</html>
