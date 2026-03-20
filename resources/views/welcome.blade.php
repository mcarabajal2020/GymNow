<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gym SaaS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        
        body {
        margin: 0;
        font-family: Arial, sans-serif;
        color: white;

        background: url('/images/fondo.jpeg') no-repeat center center fixed;
        background-size: cover;
        }
        /* Overlay oscuro */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            background: rgba(15, 23, 42, 0.85); /* oscuro semi-transparente */
            z-index: -1;
        }

       .container {
            max-width: 1100px;
            margin: auto;
            padding: 40px 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .btn {
            padding: 12px 25px;
            background: #22c55e;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn:hover {
            background: #16a34a;
        }

        .hero {
            text-align: center;
            margin-top: 80px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            color: #cbd5f5;
            margin-bottom: 40px;
        }

        .features {
            margin-top: 100px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .card {
            background: #1e293b;
            padding: 25px;
            border-radius: 12px;
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .section-title {
            text-align: center;
            margin-top: 100px;
            font-size: 32px;
        }

        .cta {
            text-align: center;
            margin-top: 100px;
        }

        footer {
            text-align: center;
            margin-top: 80px;
            color: #94a3b8;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <header>
        <div class="logo">🏋️ Gym Manager</div>
        <a href="/admin" class="btn">Ingresar</a>
    </header>

    <!-- Hero -->
    <section class="hero">
        <h1>Gestioná tu gimnasio sin complicaciones</h1>
        <p>
            Controlá socios, cobros, deudas y estadísticas en un solo sistema.
        </p>

        <a href="/admin" class="btn">
            Empezar ahora
        </a>
    </section>

    <!-- Funcionalidades -->
    <h2 class="section-title">Todo lo que necesitás</h2>

    <section class="features">

        <div class="card">
            <h3>👥 Gestión de socios</h3>
            <p>Alta, baja y control completo de miembros del gimnasio.</p>
        </div>

        <div class="card">
            <h3>💳 Pagos automatizados</h3>
            <p>Generación mensual de cuotas y control de pagos.</p>
        </div>

        <div class="card">
            <h3>📊 Dashboard financiero</h3>
            <p>Ingresos, deudas y estadísticas en tiempo real.</p>
        </div>

        <div class="card">
            <h3>📅 Rutinas personalizadas</h3>
            <p>Asigná entrenamientos con ejercicios y videos.</p>
        </div>

        <div class="card">
            <h3>⚠️ Control de deudas</h3>
            <p>Detectá rápidamente quién debe y cuánto.</p>
        </div>

        <div class="card">
            <h3>📈 Crecimiento del negocio</h3>
            <p>Tomá decisiones basadas en datos reales.</p>
        </div>

    </section>

    <!-- CTA -->
    <section class="cta">
        <h2>Listo para digitalizar tu gimnasio?</h2>
        <p>Empezá hoy mismo y llevá el control total de tu negocio.</p>

        <a href="/admin" class="btn">
            Acceder al sistema
        </a>
    </section>

    <!-- Footer -->
    <footer>
        © {{ date('Y') }} Gym Manager - Sistema SaaS para gimnasios
    </footer>

</div>

</body>
</html>