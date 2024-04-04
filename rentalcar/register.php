<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="register.css">
    <title>Registre-se</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2>Registre-se</h2>
            <div class="content">
                <div class="input-box">
                    <label for="name">Nome Completo</label>
                    <input type="text" placeholder="Enter full name" name="name" required>
                </div>
                <div class="input-box">
                    <label for="username">Nome de Usuário</label>
                    <input type="text" placeholder="Enter username" name="uname" required>
                </div>
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter your valid email" name="email" required>
                </div>
                <div class="input-box">
                    <label for="phonenumber">Número de Telefone</label>
                    <input type="tel" placeholder="Enter phone number" name="phoneNumber" required>
                </div>
                <div class="input-box">
                    <label for="password">Senha</label>
                    <input type="password" placeholder="Enter new password" name="password" required>
                </div>
                <div class="input-box">
                    <label for="Cpassword">Confirmar Senha</label>
                    <input type="password" placeholder="Confirm password" name="confirmPassword" required>
                </div>
                <span class="gender-title">Genero</span>
                <div class="gender-category">
                    <input type="radio" name="gender" id="male">
                    <label for="gender">Masculino</label>
                    <input type="radio" name="gender" id="female">
                    <label for="gender">Feminino</label>
                    <input type="radio" name="gender" id="other">
                    <label for="gender">Outro</label>
                </div>
            </div>
            <div class="alert">
                <p>By clicking Sing Up, you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a> and <a href="#">Cookies Policy</a>, You may receive SMS notifications from us and can opt out at any time.</p>
            </div>
            <div class="button-container">
                <button type="submit">Registre-se</button>
            </div>
        </form>
    </div>
</body>
</html>