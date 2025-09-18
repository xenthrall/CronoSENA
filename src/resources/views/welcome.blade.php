<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CronoSENA — Presentación</title>
  <style>
    :root{
      --bg1:#0f172a; --bg2:#0b1220; --accent:#7c3aed; --glass: rgba(255,255,255,0.06);
      --card:#0b1226; --muted: #9aa4b2; --glass-2: rgba(255,255,255,0.03);
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;background:linear-gradient(180deg,var(--bg1),var(--bg2));color:#e6eef8}
    .wrap{max-width:960px;margin:48px auto;padding:28px}
    header{display:flex;align-items:center;gap:18px}
    .logo{width:84px;height:84px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--accent),#06b6d4);box-shadow:0 6px 18px rgba(12,18,36,0.6)}
    .logo h1{font-size:22px;margin:0;letter-spacing:-0.6px}
    .title{line-height:1}
    h2{margin:12px 0 6px}
    p.lead{color:var(--muted);margin:8px 0 20px}

    .hero{display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start}
    .card{background:linear-gradient(180deg,var(--card),var(--glass-2));border-radius:12px;padding:18px;box-shadow:0 8px 30px rgba(2,6,23,0.6);border:1px solid rgba(255,255,255,0.03)}

    .features{display:flex;flex-direction:column;gap:12px}
    .feature{display:flex;gap:12px;align-items:flex-start}
    .badge{min-width:44px;height:44px;border-radius:10px;background:var(--glass);display:grid;place-items:center;font-weight:700;color:var(--accent)}

    .stack{display:flex;flex-wrap:wrap;gap:8px;margin-top:10px}
    .tech{padding:8px 12px;border-radius:999px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.02);font-size:13px}

    .actions{display:flex;gap:10px;margin-top:16px}
    a.button{display:inline-block;padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:600}
    .btn-primary{background:linear-gradient(90deg,var(--accent),#06b6d4);color:white}
    .btn-ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--muted)}

    footer{margin-top:22px;color:var(--muted);font-size:13px}

    pre.cmd{background:rgba(0,0,0,0.25);padding:12px;border-radius:8px;overflow:auto;color:#dff3ff}

    @media (max-width:860px){.hero{grid-template-columns:1fr}.wrap{margin:20px}}
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <div class="logo">
        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden>
          <rect x="2" y="2" width="20" height="20" rx="6" fill="white" fill-opacity="0.06"/>
          <path d="M6 16V8h2v6h8v2H6z" fill="white" fill-opacity="0.9"/>
        </svg>
      </div>
      <div class="title">
        <h1 style="margin:0;font-size:20px">CronoSENA</h1>
        <div style="color:var(--muted);font-size:13px">Sistema inteligente de planificación académica — Presentación</div>
      </div>
    </header>

    <section class="hero" style="margin-top:18px">
      <div class="card">
        <h2>Sobre el proyecto</h2>
        <p class="lead">CronoSENA es un proyecto para gestionar y optimizar la planificación académica (programas, competencias, instructores, fichas). Esta página es una presentación temporal para usar en el servidor mientras avanzan las primeras funcionalidades.</p>

        <div class="features">
          <div class="feature">
            <div class="badge">⚙️</div>
            <div>
              <strong>Estado</strong>
              <div style="color:var(--muted);font-size:13px">Código en desarrollo — entorno contenerizado con Docker.</div>
            </div>
          </div>

          <div class="feature">
            <div class="badge">🗂️</div>
            <div>
              <strong>Estructura (resumen)</strong>
              <div style="color:var(--muted);font-size:13px">Carpeta principal <code>src/</code> (aplicación Laravel), archivos de orquestación: <code>docker-compose.yml</code>, <code>Dockerfile</code>.</div>
            </div>
          </div>

          <div class="feature">
            <div class="badge">🚀</div>
            <div>
              <strong>Cómo ver esta página en el servidor</strong>
              <div style="color:var(--muted);font-size:13px">Copia este archivo a <code>src/public/index.html</code> dentro del repositorio (o pégalo en la ruta pública de tu servidor). Muchos servidores servirán <code>index.html</code> antes que <code>index.php</code>; si no, coloca como <code>maintenance.html</code> y configura el servidor temporalmente.</div>
            </div>
          </div>
        </div>

        <div style="margin-top:12px">
          <div class="stack">
            <div class="tech">Laravel</div>
            <div class="tech">PHP 8</div>
            <div class="tech">MySQL</div>
            <div class="tech">Docker</div>
            <div class="tech">Tailwind (assets)</div>
          </div>

          <div class="actions">
            <a class="button btn-primary" href="https://github.com/xenthrall/CronoSENA" target="_blank" rel="noopener">Ver repo en GitHub</a>
            <a class="button btn-ghost" href="#quickstart">Instrucciones</a>
          </div>
        </div>
      </div>

      <aside class="card">
        <h3 style="margin-top:0">Resumen</h3>
        <p style="color:var(--muted);font-size:13px">Página temporal de presentación para que el servidor muestre información amigable mientras se desarrolla la app.</p>

        <h4 style="margin-bottom:6px">Comandos rápidos</h4>
        <pre class="cmd">git clone https://github.com/xenthrall/CronoSENA.git
cd CronoSENA
# Si usas Docker (desde la raíz del repo)
docker compose up -d --build
# entrar al contenedor app y generar la key
# docker compose exec app php artisan key:generate</pre>

        <div style="margin-top:8px;color:var(--muted);font-size:13px">Puerto por defecto usado en README: <strong>http://localhost:8080</strong> (verifica tu docker-compose si usas contenedor).</div>
      </aside>
    </section>

    <section id="quickstart" style="margin-top:20px">
      <div class="card">
        <h2>Instrucciones rápidas</h2>
        <ol style="color:var(--muted);padding-left:18px">
          <li>Coloca este archivo dentro de <code>src/public/</code> como <code>index.html</code> (o como <code>maintenance.html</code> si prefieres no reemplazar la entrada).</li>
          <li>Si usas Docker, reconstruye y levanta los contenedores: <code>docker compose up -d --build</code>.</li>
          <li>Abre <code>http://tu-servidor:8080</code> o la dirección pública configurada en tu VM.</li>
        </ol>

        <p style="color:var(--muted);font-size:13px">Si prefieres, puedo adaptar esta página (colores, logo, textos) para que coincida con la identidad del proyecto o crear una versión en Blade (Laravel) para integrarla con la app.</p>
      </div>
    </section>

    <footer>
      Creado automáticamente como página de presentación — cronosena (repo: xenthrall/CronoSENA)
    </footer>
  </div>
</body>
</html>
