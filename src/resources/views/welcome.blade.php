<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CronoSENA — Bienvenido</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <style>
        :root {
            --text-dark: #111827;
            --text-light: #fff;
            --gradient: linear-gradient(83.21deg, #3245ff 0%, #bc52ee 100%);
            --font: Inter, Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            height: 100vh;
            font-family: var(--font);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: var(--text-dark);
            position: relative;
        }

        #background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            filter: blur(40px) saturate(120%);
            object-fit: cover;
            opacity: 1;
            animation: gradientMove 15s ease infinite;


        }

        main {
            text-align: center;
            backdrop-filter: blur(20px);
            padding: 2rem 3rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.55);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease both;
            border: 1px solid rgba(255, 255, 255, 0.4);

        }

        h1 {
            font-size: 2rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.25em;
        }

        p {
            color: #4b5563;
            opacity: 0.6;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .header-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 16px;
            position: relative;
        }

        /* Logo */
        .header-logo {
            height: 80px;
            width: auto;
            object-fit: contain;
            filter: var(--logo-filter);
            transition: filter 0.3s ease;
            z-index: 1;
        }

        .header-container {
            position: relative;
            display: inline-block;
        }

        .header-crono {
            height: 80px;
            width: auto;
            object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.25));
            transition: filter 0.3s ease;
            cursor: pointer;
        }

        .header-crono:hover {
            filter:
                drop-shadow(0 0 6px rgba(188, 82, 238, 0.6)) drop-shadow(0 0 12px rgba(50, 69, 255, 0.4));
        }

        /* Mensaje de saludo */
        .crono-message {
            position: absolute;
            bottom: 110%;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            white-space: nowrap;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        /* Estado visible */
        .crono-message.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }


        #back-button {
            position: absolute;
            left: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.2rem 0.2rem;
            border-radius: 50%;
            text-decoration: none;
            font-weight: 100;
            opacity: 0.5;
            color: var(--text-light);
            background: var(--gradient);
            transition: all 0.25s ease;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.12),
                inset 0 -2px 0 rgba(0, 0, 0, 0.24);
            z-index: 2;

        }

        #back-button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .button-admin {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            color: var(--text-light);
            background: var(--gradient);
            transition: all 0.25s ease;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.12),
                inset 0 -2px 0 rgba(0, 0, 0, 0.24);
            opacity: 0.8;
        }

        .button-admin:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        a.button {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            color: var(--text-light);
            background: var(--gradient);
            transition: all 0.25s ease;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.12),
                inset 0 -2px 0 rgba(0, 0, 0, 0.24);
        }

        a.button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        footer {
            position: absolute;
            bottom: 1rem;
            font-size: 0.85rem;
            color: rgba(0, 0, 0, 0.5);
        }

        @keyframes gradientMove {
            0% {
                transform: scale(1) translate(0, 0);
            }

            50% {
                transform: scale(1.1) translate(-10px, -10px);
            }

            100% {
                transform: scale(1) translate(0, 0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            main {
                padding: 1.5rem;
                width: 90%;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Fondo SVG igual que en la landing -->
    <img id="background" src="/images/background.svg" alt="Fondo CronoSENA" />

    <a class="button-admin" href="{{ url('/admin') }}">Administración General</a>
    <main>
        <a href="https://cronosena.site" id="back-button" title="Volver a CronoSENA">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>
        <div class="header-bar">


            <img src="/images/logo-cata-removebg.png" alt="CronoSENA Logo" class="header-logo">
        </div>

        <!--<h1>CATA</h1> -->
        <div class="header-container">
            <img src="/images/crono.svg" alt="crono Mascota" class="header-crono" id="crono-logo">
            <div id="crono-message" class="crono-message">👋 ¡Hola! Soy Crono 🦉</div>
        </div>

        <p>CronoSENA v{{ config('app.version', '1.0.0') }}</p>

        <div class="buttons">

            <a class="button" href="">Planificación Académica</a>
            <a class="button" href="{{ url('/instructor') }}">Espacio del Instructor</a>
        </div>
    </main>

    <footer>© {{ date('Y') }} CronoSENA — xenthrall</footer>

    <script>
        const cronoLogo = document.getElementById('crono-logo');
        const cronoMessage = document.getElementById('crono-message');
        let timeoutId;

        cronoLogo.addEventListener('click', () => {
            // Si ya está visible, reinicia el temporizador
            clearTimeout(timeoutId);
            cronoMessage.classList.add('show');

            timeoutId = setTimeout(() => {
                cronoMessage.classList.remove('show');
            }, 2000);
        });
    </script>

</body>

</html>
