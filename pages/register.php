<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["name"];
    $email = $_POST["email"];
    $senha = $_POST["password"];
    $confirm = $_POST["confirmPassword"];

    if ($senha !== $confirm) {
        $erro = "As senhas não coincidem!";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senhaHash);

        if ($stmt->execute()) {
    header("Location: login.php");
    exit();
} else {
    $erro = "Erro ao registrar. Email já cadastrado!";
}
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlowTask - Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #6C63FF, #48C6EF);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 50px 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            color: #fff;
            animation: fadeIn 1s ease forwards;
        }

        .register-container h2 {
            margin-bottom: 30px;
            font-size: 2rem;
            color: #fff;
        }

        .register-container input {
            width: 80%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
        }

        .register-container input:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(255,255,255,0.5);
        }

        .register-container button {
            width: 40%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            background-color: #fff;
            color: #6C63FF;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .register-container button:hover {
            background-color: #6C63FF;
            color: #fff;
        }

        .register-container p {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .register-container p a {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .register-container p a:hover {
            color: #FFD700;
        }

        .mensagem {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .erro {
            color: #FFD700;
        }

        .sucesso {
            color: #00FF88;
        }

        @keyframes fadeIn {
            0% {opacity: 0; transform: translateY(20px);}
            100% {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Crie sua conta</h2>

    <?php
        if (isset($erro)) { echo "<p class='mensagem erro'>$erro</p>"; }
        if (isset($sucesso)) { echo "<p class='mensagem sucesso'>$sucesso</p>"; }
    ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Nome completo" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Senha" required>
        <input type="password" name="confirmPassword" placeholder="Confirme sua senha" required>
        <button onclick="window.location.href='homepage.php'" type="submit">Registrar</button>
    </form>

    <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
</div>

</body>
</html>
