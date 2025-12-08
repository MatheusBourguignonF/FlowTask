<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskMaster - Organizador de Tarefas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #6C63FF, #48C6EF);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        header h1 {
            font-size: 1.8rem;
            color: #fff;
        }

        nav button {
            margin-left: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background-color: #fff;
            color: #6C63FF;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        nav button:hover {
            background-color: #6C63FF;
            color: #fff;
        }

        /* Hero Section */
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
            text-align: center;
            padding: 50px 20px;
        }

        .hero h2 {
            font-size: 2.5rem;
            color: #fff;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            color: #f0f0f0;
            margin-bottom: 30px;
            max-width: 600px;
        }

        .hero button {
            padding: 15px 30px;
            font-size: 1rem;
            border: none;
            border-radius: 30px;
            background-color: #fff;
            color: #6C63FF;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .hero button:hover {
            background-color: #6C63FF;
            color: #fff;
        }

        /* Features Section */
        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 50px 20px;
            background-color: #f5f5f5;
        }

        .feature-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            margin: 20px;
            flex: 1 1 250px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .feature-card h3 {
            margin-bottom: 15px;
            color: #6C63FF;
        }

        .feature-card p {
            color: #555;
        }

        /* Footer */
        footer {
            padding: 20px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* Animações */
        .hero h2, .hero p, .hero button {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards;
        }

        .hero h2 { animation-delay: 0.2s; }
        .hero p { animation-delay: 0.5s; }
        .hero button { animation-delay: 0.8s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>
<body>

<header>
    <h1>TaskMaster</h1>
    <nav>
        <button onclick="window.location.href='login.php'">Login</button>
        <button onclick="window.location.href='register.php'">Registrar</button>
    </nav>
</header>

<section class="hero">
    <h2>Organize suas tarefas de forma simples e eficiente</h2>
    <p>TaskMaster é o seu novo aliado na organização diária. Adicione, remova e acompanhe suas tarefas de maneira intuitiva e divertida.</p>
    <button onclick="window.location.href='register.php'">Começar Agora</button>
</section>

<section class="features">
    <div class="feature-card">
        <h3>Adicionar Tarefas</h3>
        <p>Crie tarefas rapidamente e mantenha seu dia produtivo.</p>
    </div>
    <div class="feature-card">
        <h3>Remover Tarefas</h3>
        <p>Marque tarefas concluídas e mantenha sua lista organizada.</p>
    </div>
    <div class="feature-card">
        <h3>Interatividade</h3>
        <p>Design moderno com animações que tornam o uso agradável.</p>
    </div>
</section>

<footer>
    &copy; 2025 TaskMaster. Todos os direitos reservados.
</footer>

</body>
</html>
