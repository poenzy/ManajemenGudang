<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
            border-radius: 15px 0 0 15px;
        }

        .image-half {
            flex: 1;
            background-image: url('https://images.unsplash.com/photo-1601598838108-5019bf3ea4a6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fHdhcmVob3VzZXxlbnwwfHwwfHx8MA%3D%3D');
            background-size: cover;
            background-position: center;
            border-radius: 0 15px 15px 0;
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
            padding-bottom: 50px;
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

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 15px;
            font-size: 14px;
            outline: none;
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #aaa;
        }

        .password-field {
            position: relative;
        }

        .login-btn {
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

        .login-btn:hover {
            background-color: #5b4bc9;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .register-link a {
            color: #6c5ce7;
            text-decoration: none;
            font-weight: bold;
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

            .form-half {
                border-radius: 15px 15px 0 0;
            }

            .image-half {
                border-radius: 0 0 15px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="split-container">
        <div class="form-half">
            <div class="wrapper">
                <div class="logo">
                    <img src="img/logo.png" alt="logo">
                </div>
                <h1>Login Form</h1>
                <form action="proses_login.php" method="post" id="LoginForm">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email address" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-field">
                            <input type="password" id="password" placeholder="Enter your password" name="password" required>
                        </div>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                    <div class="register-link">
                        Belum mempunyai akun? <a href="regist.php">Daftar</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="image-half"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formHalf = document.querySelector('.form-half');
            
            // Set initial position (off-screen to the right)
            formHalf.style.transform = 'translateX(100%)';
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