<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />

  <title>CronoSENA — Sistema de Gestión y Planificación Académica</title>
  <meta name="description" content="CronoSENA es un sistema inteligente para la gestión y planificación académica. Desarrollado por Xenthrall para optimizar la asignación de programas, competencias, instructores y fichas." />
  <meta name="robots" content="index,follow" />
  <link rel="canonical" href="https://cronosena.site/" />
  
  <meta property="og:locale" content="es_ES" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="CronoSENA — Sistema de Gestión y Planificación Académica" />
  <meta property="og:description" content="Sistema inteligente para la gestión de programas, competencias e instructores. Un proyecto de Xenthrall (disponible en GitHub)." />
  <meta property="og:url" content="https://cronosena.site/" />
  <meta property="og:site_name" content="CronoSENA" />
  <meta property="og:image" content="{{ asset('og-cronosena.png') }}" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="CronoSENA — Sistema de Gestión y Planificación Académica" />
  <meta name="twitter:description" content="Sistema inteligente para la gestión de programas, competencias e instructores. Un proyecto de Xenthrall (disponible en GitHub)." />
  <meta name="twitter:image" content="{{ asset('og-cronosena.png') }}" />

@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "name": "Xenthrall",
      "url": "https://github.com/xenthrall",
      "sameAs": ["https://github.com/xenthrall"],
      "logo": "https://cronosena.site/logo-192.png",
      "image": "https://cronosena.site/og-cronosena.png"

    },
    {
      "@type": "SoftwareApplication",
      "name": "CronoSENA",
      "url": "https://cronosena.site/",
      "description": "Sistema inteligente de planificación y gestión académica para programas, competencias, instructores y fichas.",
      "applicationCategory": "Education",
      "operatingSystem": "Web",
      "author": {
        "@type": "Organization",
        "name": "Xenthrall",
        "url": "https://github.com/xenthrall"
      }
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "¿Qué es CronoSENA?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CronoSENA es un sistema de gestión y planificación académica desarrollado por un usuario de github Xenthrall para optimizar la programación de programas, competencias e instructores."
          }
        },
        {
          "@type": "Question",
          "name": "¿Puedo instalar CronoSENA con Docker?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Sí. El proyecto está pensado para ejecutarse en contenedores (Docker), con un docker-compose.yml en la raíz del repositorio."
          }
        }
      ]
    }
  ]
}
</script>
@endverbatim


  <style>
    :root{--bg1:#0f172a;--bg2:#0b1220;--accent:#7c3aed;--glass:rgba(255,255,255,0.06);--card:#0b1226;--muted:#9aa4b2;}
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;background:linear-gradient(180deg,var(--bg1),var(--bg2));color:#e6eef8;font-family:Inter,ui-sans-serif,system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif}
    .wrap{max-width:980px;margin:36px auto;padding:24px}
    header{display:flex;align-items:center;gap:16px}
    .logo{width:72px;height:72px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--accent),#06b6d4);box-shadow:0 6px 18px rgba(12,18,36,0.6)}
    h1{margin:0;font-size:22px}
    h2,h3{margin-top:0}
    .muted{color:var(--muted);font-size:14px}
    .hero{display:grid;grid-template-columns:1fr 320px;gap:20px;margin-top:24px}
    .card{background:linear-gradient(180deg,var(--card),rgba(255,255,255,0.03));border-radius:12px;padding:24px;box-shadow:0 8px 30px rgba(2,6,23,0.6);border:1px solid rgba(255,255,255,0.03)}
    .features{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-top:24px;}
    .feature-item{display:flex;align-items:flex-start;gap:12px}
    .badge{flex-shrink:0;width:44px;height:44px;border-radius:10px;background:rgba(255,255,255,0.04);display:grid;place-items:center;font-weight:700;color:var(--accent)}
    .stack{display:flex;flex-wrap:wrap;gap:8px;margin-top:20px}
    .tech{padding:8px 12px;border-radius:999px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.02);font-size:13px}
    .actions{display:flex;gap:10px;margin-top:24px}
    a.button{display:inline-block;padding:10px 14px;border-radius:10px;text-decoration:none;font-weight:600;transition:transform .2s}
    a.button:hover{transform:scale(1.05)}
    .btn-primary{background:linear-gradient(90deg,var(--accent),#06b6d4);color:white}
    .btn-ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--muted)}
    footer{margin-top:22px;text-align:center;color:var(--muted);font-size:13px}
    pre.cmd{background:rgba(0,0,0,0.25);padding:12px;border-radius:8px;overflow:auto;color:#dff3ff;font-size:13px;white-space:pre-wrap}
    @media (max-width:860px){.hero{grid-template-columns:1fr}.wrap{margin:18px}}
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <div class="logo" aria-label="Logo de CronoSENA">
        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <rect x="2" y="2" width="20" height="20" rx="6" fill="white" fill-opacity="0.06"/>
          <path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM12 4C16.4183 4 20 7.58172 20 12C20 16.4183 16.4183 20 12 20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4ZM11 6V13.5C11 13.7761 11.2239 14 11.5 14H17C17.2761 14 17.5 13.7761 17.5 13.5C17.5 13.2239 17.2761 13 17 13H12V6.5C12 6.22386 11.7761 6 11.5 6C11.2239 6 11 6.22386 11 6Z" fill="white" fill-opacity="0.9"/>
        </svg>
      </div>
      <div>
        <h1>CronoSENA — Sistema de Planificación Académica</h1>
        <div class="muted">Un proyecto del equipo Xenthrall para la gestión de programas, competencias e instructores.</div>
      </div>
    </header>

    <main>
      <section class="hero" aria-labelledby="sobre-el-proyecto">
        <article class="card">
          <h2 id="sobre-el-proyecto">Sobre el Proyecto</h2>
          <p class="muted" style="line-height:1.6;"><strong>CronoSENA</strong> es un sistema de gestión académica diseñado para simplificar la planificación inteligente de instructores. Permite administrar de forma centralizada los <strong>programas de formación</strong>, las <strong>competencias</strong> asociadas, los perfiles de los <strong>instructores</strong> y la asignación de <strong>fichas</strong>.</p>

          <div class="features">
            <div class="feature-item">
              <div class="badge">⚙️</div>
              <div>
                <strong>Estado Actual</strong>
                <div class="muted" style="font-size:13px">En desarrollo activo. Puedes seguir el progreso en el repositorio público de GitHub.</div>
              </div>
            </div>
            <div class="feature-item">
              <div class="badge">🚀</div>
              <div>
                <strong>Tecnología</strong>
                <div class="muted" style="font-size:13px">Construido con Laravel y PHP, y contenerizado con Docker para un despliegue sencillo.</div>
              </div>
            </div>
          </div>

          <div class="stack">
            <span class="tech">Laravel</span>
            <span class="tech">PHP 8+</span>
            <span class="tech">MySQL</span>
            <span class="tech">Docker</span>
            <span class="tech">TailwindCSS</span>
          </div>

          <div class="actions">
            <a class="button btn-primary" href="https://github.com/xenthrall/CronoSENA" target="_blank" rel="noopener noreferrer">Ver en GitHub</a>
            <a class="button btn-primary" href="https://cronosena.site/admin" target="" rel="noopener noreferrer">Try Demo</a>
          </div>
        </article>

        <aside class="card" aria-labelledby="resumen-rapido">
          <h3 id="resumen-rapido">Instalación Rápida</h3>
          <p class="muted">Para ejecutar el proyecto localmente, clona el repositorio y utiliza Docker Compose.</p>
          <pre class="cmd">git clone https://github.com/xenthrall/CronoSENA.git
            cd CronoSENA
            docker compose up -d --build
          </pre>
          <div class="muted" style="font-size:13px;margin-top:12px">Consulta el archivo <code>README.md</code> para ver instrucciones detalladas y configuración de variables de entorno.</div>
        </aside>
      </section>
    </main>

    <footer>
      <p>Página de presentación para <strong>CronoSENA</strong> | Proyecto de formación <a href="https://github.com/xenthrall" target="_blank" rel="noopener noreferrer" style="color: var(--muted);">Xenthrall</a></p>
    </footer>
  </div>
</body>
</html>