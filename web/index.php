<!DOCTYPE html>
<html lang="ca">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameZone — Gaming Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0a0a0a;
      --surface: #111111;
      --border: #1e1e1e;
      --accent: #c8f135;
      --accent-dim: rgba(200, 241, 53, 0.08);
      --text: #f0f0f0;
      --muted: #666;
      --mono: 'Space Mono', monospace;
      --sans: 'Syne', sans-serif;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    html { scroll-behavior: smooth; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: var(--sans);
      font-size: 16px;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      padding: 20px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid transparent;
      transition: border-color .3s, background .3s;
    }
    nav.scrolled {
      background: rgba(10,10,10,.92);
      backdrop-filter: blur(12px);
      border-color: var(--border);
    }
    .nav-logo {
      font-family: var(--mono);
      font-size: 1.1rem;
      font-weight: 700;
      letter-spacing: -.02em;
      color: var(--text);
      text-decoration: none;
    }
    .nav-logo span { color: var(--accent); }
    .nav-links { display: flex; gap: 32px; list-style: none; }
    .nav-links a {
      font-family: var(--mono);
      font-size: .75rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--muted);
      text-decoration: none;
      transition: color .2s;
    }
    .nav-links a:hover { color: var(--text); }
    .nav-cta {
      font-family: var(--mono);
      font-size: .75rem;
      letter-spacing: .1em;
      text-transform: uppercase;
      background: var(--accent);
      color: #000;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      transition: opacity .2s;
      text-decoration: none;
    }
    .nav-cta:hover { opacity: .85; color: #000; }

    #hero {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 0 40px 80px;
      position: relative;
      overflow: hidden;
    }
    .hero-bg {
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 60% 50% at 70% 40%, rgba(200,241,53,.07) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 20% 70%, rgba(200,241,53,.04) 0%, transparent 60%);
    }
    .hero-grid {
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(var(--border) 1px, transparent 1px),
        linear-gradient(90deg, var(--border) 1px, transparent 1px);
      background-size: 60px 60px;
      mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 20%, transparent 100%);
      opacity: .4;
    }
    .hero-label {
      font-family: var(--mono);
      font-size: .7rem;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 24px;
    }
    .hero-title {
      font-size: clamp(3rem, 8vw, 7rem);
      font-weight: 800;
      line-height: .95;
      letter-spacing: -.03em;
      margin-bottom: 32px;
    }
    .hero-title em {
      font-style: normal;
      color: var(--accent);
    }
    .hero-sub {
      font-family: var(--mono);
      font-size: .9rem;
      color: var(--muted);
      max-width: 460px;
      margin-bottom: 48px;
      line-height: 1.8;
    }
    .hero-actions { display: flex; gap: 16px; align-items: center; }
    .btn-primary-gz {
      background: var(--accent);
      color: #000;
      font-family: var(--mono);
      font-size: .8rem;
      letter-spacing: .1em;
      text-transform: uppercase;
      padding: 14px 28px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: opacity .2s;
      display: inline-block;
    }
    .btn-primary-gz:hover { opacity: .85; color: #000; }
    .btn-ghost-gz {
      background: transparent;
      color: var(--muted);
      font-family: var(--mono);
      font-size: .8rem;
      letter-spacing: .1em;
      text-transform: uppercase;
      padding: 14px 28px;
      border: 1px solid var(--border);
      cursor: pointer;
      text-decoration: none;
      transition: border-color .2s, color .2s;
      display: inline-block;
    }
    .btn-ghost-gz:hover { border-color: var(--muted); color: var(--text); }
    .hero-scroll {
      position: absolute;
      bottom: 40px; right: 40px;
      font-family: var(--mono);
      font-size: .65rem;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: var(--muted);
      writing-mode: vertical-rl;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .hero-scroll::before {
      content: '';
      width: 1px;
      height: 40px;
      background: var(--muted);
    }

    section { padding: 100px 40px; }
    .section-label {
      font-family: var(--mono);
      font-size: .7rem;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 16px;
    }
    .section-title {
      font-size: clamp(2rem, 4vw, 3.5rem);
      font-weight: 800;
      letter-spacing: -.02em;
      line-height: 1.05;
      margin-bottom: 48px;
    }
    .divider {
      border: none;
      border-top: 1px solid var(--border);
      margin: 0;
    }

    #stats {
      padding: 40px;
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
    }
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 0;
    }
    .stat-item {
      padding: 32px 40px;
      border-right: 1px solid var(--border);
    }
    .stat-item:last-child { border-right: none; }
    .stat-num {
      font-size: 2.8rem;
      font-weight: 800;
      letter-spacing: -.04em;
      color: var(--accent);
      line-height: 1;
      margin-bottom: 8px;
    }
    .stat-label {
      font-family: var(--mono);
      font-size: .7rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--muted);
    }

    #zones { background: var(--bg); }
    .zones-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1px;
      background: var(--border);
    }
    .zone-card {
      background: var(--surface);
      padding: 48px 40px;
      position: relative;
      overflow: hidden;
      transition: background .2s;
    }
    .zone-card:hover { background: #161616; }
    .zone-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 2px;
      background: var(--accent);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform .3s;
    }
    .zone-card:hover::before { transform: scaleX(1); }
    .zone-num {
      font-family: var(--mono);
      font-size: .7rem;
      letter-spacing: .15em;
      color: var(--accent);
      margin-bottom: 24px;
    }
    .zone-title {
      font-size: 1.4rem;
      font-weight: 800;
      letter-spacing: -.02em;
      margin-bottom: 16px;
    }
    .zone-desc {
      font-family: var(--mono);
      font-size: .8rem;
      color: var(--muted);
      line-height: 1.8;
      margin-bottom: 32px;
    }
    .zone-spec {
      font-family: var(--mono);
      font-size: .7rem;
      letter-spacing: .08em;
      color: var(--text);
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }
    .zone-tag {
      border: 1px solid var(--border);
      padding: 4px 10px;
    }

    #reserves {
      background: var(--surface);
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
    }
    .reserves-inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: start;
    }
    .reserves-info p {
      font-family: var(--mono);
      font-size: .85rem;
      color: var(--muted);
      line-height: 1.9;
      margin-bottom: 32px;
    }
    .form-gz label {
      display: block;
      font-family: var(--mono);
      font-size: .7rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 8px;
    }
    .form-gz input,
    .form-gz select {
      width: 100%;
      background: var(--bg);
      border: 1px solid var(--border);
      color: var(--text);
      font-family: var(--mono);
      font-size: .85rem;
      padding: 12px 16px;
      margin-bottom: 24px;
      outline: none;
      transition: border-color .2s;
      -webkit-appearance: none;
      appearance: none;
    }
    .form-gz input:focus,
    .form-gz select:focus { border-color: var(--accent); }
    .form-gz select option { background: var(--bg); }
    .form-gz .btn-primary-gz { width: 100%; text-align: center;     }

    #com-funciona { background: var(--bg); }
    .steps { display: flex; flex-direction: column; gap: 0; max-width: 700px; }
    .step {
      display: grid;
      grid-template-columns: 64px 1fr;
      gap: 32px;
      padding: 40px 0;
      border-bottom: 1px solid var(--border);
      align-items: start;
    }
    .step:first-child { border-top: 1px solid var(--border); }
    .step-num {
      font-family: var(--mono);
      font-size: 2rem;
      font-weight: 700;
      color: var(--accent);
      line-height: 1;
    }
    .step-title {
      font-size: 1.1rem;
      font-weight: 600;
      letter-spacing: -.01em;
      margin-bottom: 8px;
    }
    .step-desc {
      font-family: var(--mono);
      font-size: .8rem;
      color: var(--muted);
      line-height: 1.8;
    }

    #preus { background: var(--surface); border-top: 1px solid var(--border); }
    .preus-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1px;
      background: var(--border);
    }
    .preu-card {
      background: var(--surface);
      padding: 48px 40px;
    }
    .preu-card.featured { background: var(--accent-dim); }
    .preu-badge {
      font-family: var(--mono);
      font-size: .65rem;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: var(--accent);
      margin-bottom: 32px;
      display: block;
    }
    .preu-title {
      font-size: 1.2rem;
      font-weight: 800;
      letter-spacing: -.02em;
      margin-bottom: 8px;
    }
    .preu-amount {
      font-family: var(--mono);
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--text);
      line-height: 1;
      margin: 24px 0 4px;
    }
    .preu-period {
      font-family: var(--mono);
      font-size: .75rem;
      color: var(--muted);
      margin-bottom: 32px;
    }
    .preu-list {
      list-style: none;
      margin-bottom: 40px;
    }
    .preu-list li {
      font-family: var(--mono);
      font-size: .8rem;
      color: var(--muted);
      padding: 10px 0;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .preu-list li::before {
      content: '→';
      color: var(--accent);
      font-size: .7rem;
    }

    #faq { background: var(--bg); }
    .faq-list { max-width: 700px; }
    .faq-item {
      border-bottom: 1px solid var(--border);
    }
    .faq-q {
      width: 100%;
      background: none;
      border: none;
      color: var(--text);
      font-family: var(--sans);
      font-size: 1rem;
      font-weight: 600;
      text-align: left;
      padding: 28px 0;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
    }
    .faq-q:focus { outline: none; }
    .faq-icon {
      color: var(--accent);
      font-family: var(--mono);
      font-size: 1.2rem;
      flex-shrink: 0;
      transition: transform .2s;
    }
    .faq-item.open .faq-icon { transform: rotate(45deg); }
    .faq-a {
      display: none;
      font-family: var(--mono);
      font-size: .82rem;
      color: var(--muted);
      line-height: 1.9;
      padding-bottom: 28px;
    }
    .faq-item.open .faq-a { display: block;     }

    footer {
      padding: 60px 40px;
      border-top: 1px solid var(--border);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .footer-logo {
      font-family: var(--mono);
      font-size: 1rem;
      font-weight: 700;
      color: var(--text);
      text-decoration: none;
    }
    .footer-logo span { color: var(--accent); }
    .footer-copy {
      font-family: var(--mono);
      font-size: .7rem;
      color: var(--muted);
      letter-spacing: .08em;
    }
    .footer-links { display: flex; gap: 24px; }
    .footer-links a {
      font-family: var(--mono);
      font-size: .7rem;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--muted);
      text-decoration: none;
      transition: color .2s;
    }
    .footer-links a:hover { color: var(--text);     }

    .fade-in {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity .6s ease, transform .6s ease;
    }
    .fade-in.visible {
      opacity: 1;
      transform: none;
    }

    @media (max-width: 768px) {
      nav { padding: 16px 20px; }
      .nav-links { display: none; }
      section { padding: 60px 20px; }
      #hero { padding: 0 20px 60px; }
      .stats-grid { grid-template-columns: 1fr 1fr; }
      .stat-item { border-right: none; border-bottom: 1px solid var(--border); }
      .zones-grid { grid-template-columns: 1fr; }
      .reserves-inner { grid-template-columns: 1fr; gap: 40px; }
      .preus-grid { grid-template-columns: 1fr; }
      footer { flex-direction: column; gap: 24px; text-align: center; }
      .footer-links { flex-wrap: wrap; justify-content: center; }
    }
  </style>
</head>
<body>

<nav id="navbar">
  <a href="#" class="nav-logo">Game<span>Zone</span></a>
  <ul class="nav-links">
    <li><a href="#zones">Zones</a></li>
    <li><a href="#reserves">Reserves</a></li>
    <li><a href="#preus">Preus</a></li>
    <li><a href="#faq">FAQ</a></li>
  </ul>
  <a href="#reserves" class="nav-cta">Reserva ara</a>
</nav>

<section id="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div style="position:relative; z-index:1;">
    <p class="hero-label">Gaming Center — Girona</p>
    <h1 class="hero-title">Juga.<br>Connecta.<br><em>Domina.</em></h1>
    <p class="hero-sub">Un espai equipat per a jugadors que no fan concessions. Equips d'alt rendiment, consoles de nova generació i realitat virtual.</p>
    <div class="hero-actions">
      <a href="#reserves" class="btn-primary-gz">Fes una reserva</a>
      <a href="#zones" class="btn-ghost-gz">Veure zones</a>
    </div>
  </div>
  <div class="hero-scroll">Scroll</div>
</section>

<div id="stats">
  <div class="stats-grid">
    <div class="stat-item fade-in">
      <div class="stat-num">6</div>
      <div class="stat-label">PCs gaming</div>
    </div>
    <div class="stat-item fade-in">
      <div class="stat-num">6</div>
      <div class="stat-label">Consoles next-gen</div>
    </div>
    <div class="stat-item fade-in">
      <div class="stat-num">2</div>
      <div class="stat-label">Ulleres VR</div>
    </div>
    <div class="stat-item fade-in">
      <div class="stat-num">∞</div>
      <div class="stat-label">Hores de joc</div>
    </div>
  </div>
</div>

<section id="zones">
  <p class="section-label fade-in">El local</p>
  <h2 class="section-title fade-in">Les nostres zones</h2>
  <div class="zones-grid">
    <div class="zone-card fade-in">
      <div class="zone-num">01</div>
      <h3 class="zone-title">Sala Gaming PC</h3>
      <p class="zone-desc">Sis equips d'alt rendiment amb monitors gaming de 165Hz i perifèrics professionals. Per als que juguen en serio.</p>
      <div class="zone-spec">
        <span class="zone-tag">RTX 4070</span>
        <span class="zone-tag">165Hz</span>
        <span class="zone-tag">Mecànic</span>
        <span class="zone-tag">6 places</span>
      </div>
    </div>
    <div class="zone-card fade-in">
      <div class="zone-num">02</div>
      <h3 class="zone-title">Sala Consoles</h3>
      <p class="zone-desc">Tres PS5 i tres Xbox Series X amb sofàs còmodes i pantalles 4K. L'experiència de sala d'estar però a nivell pro.</p>
      <div class="zone-spec">
        <span class="zone-tag">PS5</span>
        <span class="zone-tag">Xbox Series X</span>
        <span class="zone-tag">4K</span>
        <span class="zone-tag">6 places</span>
      </div>
    </div>
    <div class="zone-card fade-in">
      <div class="zone-num">03</div>
      <h3 class="zone-title">Sala VR</h3>
      <p class="zone-desc">Submergeix-te en mons virtuals amb les ulleres de realitat virtual més avançades del mercat. Espai adaptat per moure't lliurement.</p>
      <div class="zone-spec">
        <span class="zone-tag">VR</span>
        <span class="zone-tag">Espai lliure</span>
        <span class="zone-tag">2 places</span>
      </div>
    </div>
    <div class="zone-card fade-in">
      <div class="zone-num">04</div>
      <h3 class="zone-title">Alta Càrrega</h3>
      <p class="zone-desc">Dos equips de màxima potència per a streaming, renderitzat i tornejos professionals. Per als creadors i competidors.</p>
      <div class="zone-spec">
        <span class="zone-tag">RTX 4090</span>
        <span class="zone-tag">Streaming</span>
        <span class="zone-tag">2 places</span>
      </div>
    </div>
    <div class="zone-card fade-in">
      <div class="zone-num">05</div>
      <h3 class="zone-title">Màquines Retro</h3>
      <p class="zone-desc">Arcades clàssiques per als nostàlgics. Juga als clàssics de sempre en màquines originals restaurades.</p>
      <div class="zone-spec">
        <span class="zone-tag">Arcade</span>
        <span class="zone-tag">Retro</span>
        <span class="zone-tag">Gratuït</span>
      </div>
    </div>
    <div class="zone-card fade-in">
      <div class="zone-num">06</div>
      <h3 class="zone-title">Zona Descans</h3>
      <p class="zone-desc">Màquines expenedores, zona de sofàs i espai per socialitzar entre partides. Perquè el gaming també és comunitat.</p>
      <div class="zone-spec">
        <span class="zone-tag">Begudes</span>
        <span class="zone-tag">Snacks</span>
        <span class="zone-tag">Sofàs</span>
      </div>
    </div>
  </div>
</section>

<section id="reserves">
  <div class="reserves-inner">
    <div class="reserves-info fade-in">
      <p class="section-label">Reserva</p>
      <h2 class="section-title">Assegura't<br>el teu lloc</h2>
      <p>Reserva en línia i arriba directament al teu equip. Sense cues, sense esperes. El teu temps de joc comença quan tu vols.</p>
      <p>Les reserves es confirmen per correu electrònic. Pots cancel·lar fins a 2 hores abans sense cost.</p>
    </div>
    <div class="fade-in">
      <form class="form-gz" method="POST" action="reserva.php">
        <label for="nom">Nom complet</label>
        <input type="text" id="nom" name="nom" placeholder="El teu nom" required>

        <label for="email">Correu electrònic</label>
        <input type="email" id="email" name="email" placeholder="correu@exemple.com" required>

        <label for="zona">Zona</label>
        <select id="zona" name="zona" required>
          <option value="">Selecciona una zona</option>
          <option value="pc">Sala Gaming PC</option>
          <option value="consoles">Sala Consoles</option>
          <option value="vr">Sala VR</option>
          <option value="alta">Alta Càrrega</option>
        </select>

        <label for="data">Data</label>
        <input type="date" id="data" name="data" required>

        <label for="hores">Durada</label>
        <select id="hores" name="hores" required>
          <option value="">Selecciona la durada</option>
          <option value="1">1 hora</option>
          <option value="2">2 hores</option>
          <option value="3">3 hores</option>
          <option value="4">4 hores</option>
        </select>

        <button type="submit" class="btn-primary-gz">Confirmar reserva</button>
        <?php if (isset($_GET['ok'])): ?>
        <div style="margin-top:16px; font-family:var(--mono); font-size:.8rem; color:var(--accent);">
          ✓ Reserva confirmada! Rebràs un correu de confirmació.
        </div>
        <?php elseif (isset($_GET['error'])): ?>
        <div style="margin-top:16px; font-family:var(--mono); font-size:.8rem; color:#ff4444;">
          ✗ <?= htmlspecialchars($_GET['error']) ?>
        </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</section>

<section id="com-funciona">
  <p class="section-label fade-in">Procés</p>
  <h2 class="section-title fade-in">Com funciona</h2>
  <div class="steps">
    <div class="step fade-in">
      <div class="step-num">01</div>
      <div>
        <h3 class="step-title">Reserva en línia</h3>
        <p class="step-desc">Tria la zona, la data i la durada. Omplis el formulari i confirmes. Rebràs un correu de confirmació al moment.</p>
      </div>
    </div>
    <div class="step fade-in">
      <div class="step-num">02</div>
      <div>
        <h3 class="step-title">Arriba al local</h3>
        <p class="step-desc">Presenta el teu correu de confirmació a recepció. El teu equip ja estarà preparat i esperant.</p>
      </div>
    </div>
    <div class="step fade-in">
      <div class="step-num">03</div>
      <div>
        <h3 class="step-title">Juga</h3>
        <p class="step-desc">La pantalla del teu equip mostra el temps restant en tot moment. Quan s'acabi el temps, la sessió finalitza automàticament.</p>
      </div>
    </div>
    <div class="step fade-in">
      <div class="step-num">04</div>
      <div>
        <h3 class="step-title">Amplia si vols</h3>
        <p class="step-desc">Si l'equip està disponible, el recepcionista pot ampliar la teva sessió en qualsevol moment.</p>
      </div>
    </div>
  </div>
</section>

<section id="preus">
  <p class="section-label fade-in">Tarifes</p>
  <h2 class="section-title fade-in">Preus clars,<br>sense sorpreses</h2>
  <div class="preus-grid">
    <div class="preu-card fade-in">
      <span class="preu-badge">Estàndard</span>
      <h3 class="preu-title">PC Gaming</h3>
      <div class="preu-amount">3€</div>
      <div class="preu-period">per hora</div>
      <ul class="preu-list">
        <li>PC d'alt rendiment</li>
        <li>Monitor 165Hz</li>
        <li>Teclat mecànic + ratolí</li>
        <li>Auriculars gaming</li>
      </ul>
      <a href="#reserves" class="btn-ghost-gz" style="width:100%; text-align:center; display:block;">Reservar</a>
    </div>
    <div class="preu-card featured fade-in">
      <span class="preu-badge">Més popular</span>
      <h3 class="preu-title">Consoles</h3>
      <div class="preu-amount">4€</div>
      <div class="preu-period">per hora</div>
      <ul class="preu-list">
        <li>PS5 o Xbox Series X</li>
        <li>Pantalla 4K</li>
        <li>2 comandaments inclosos</li>
        <li>Sofà còmode</li>
      </ul>
      <a href="#reserves" class="btn-primary-gz" style="width:100%; text-align:center; display:block;">Reservar</a>
    </div>
    <div class="preu-card fade-in">
      <span class="preu-badge">Experiència</span>
      <h3 class="preu-title">Realitat Virtual</h3>
      <div class="preu-amount">6€</div>
      <div class="preu-period">per hora</div>
      <ul class="preu-list">
        <li>Ulleres VR d'última generació</li>
        <li>Espai de moviment lliure</li>
        <li>Jocs inclosos</li>
        <li>Assistència tècnica</li>
      </ul>
      <a href="#reserves" class="btn-ghost-gz" style="width:100%; text-align:center; display:block;">Reservar</a>
    </div>
  </div>
</section>

<section id="faq">
  <p class="section-label fade-in">Preguntes</p>
  <h2 class="section-title fade-in">FAQ</h2>
  <div class="faq-list fade-in">
    <div class="faq-item">
      <button class="faq-q" onclick="toggleFaq(this)">
        Cal registrar-se per fer una reserva?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-a">No cal cap compte. Només cal omplir el formulari de reserva amb el teu nom i correu. Rebràs la confirmació directament per email.</div>
    </div>
    <div class="faq-item">
      <button class="faq-q" onclick="toggleFaq(this)">
        Puc cancel·lar una reserva?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-a">Sí. Pots cancel·lar fins a 2 hores abans de la teva sessió sense cap cost. Passades les 2 hores, es cobra el 50% de la sessió reservada.</div>
    </div>
    <div class="faq-item">
      <button class="faq-q" onclick="toggleFaq(this)">
        Quin és l'horari del local?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-a">Obrim de dilluns a dijous de 15h a 23h, divendres de 15h a 01h, dissabtes de 10h a 01h i diumenges de 10h a 23h.</div>
    </div>
    <div class="faq-item">
      <button class="faq-q" onclick="toggleFaq(this)">
        Puc venir sense reserva prèvia?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-a">Sí, si hi ha disponibilitat. Et recomanem reservar per garantir el teu equip, especialment els caps de setmana i festius.</div>
    </div>
    <div class="faq-item">
      <button class="faq-q" onclick="toggleFaq(this)">
        Les màquines retro tenen cost addicional?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-a">No. Les màquines recreatives retro són d'accés lliure per a tots els clients del local durant la seva sessió.</div>
    </div>
    <div class="faq-item">
      <button class="faq-q" onclick="toggleFaq(this)">
        Hi ha aparcament a prop?
        <span class="faq-icon">+</span>
      </button>
      <div class="faq-a">Sí. Hi ha aparcament públic a menys de 5 minuts a peu. El local també és accessible en transport públic.</div>
    </div>
  </div>
</section>

<footer>
  <a href="#" class="footer-logo">Game<span>Zone</span></a>
  <div class="footer-links">
    <a href="#zones">Zones</a>
    <a href="#reserves">Reserves</a>
    <a href="#preus">Preus</a>
    <a href="#faq">FAQ</a>
  </div>
  <p class="footer-copy">© 2026 GameZone · gamezone.cat</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 40);
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
      if (e.isIntersecting) {
        setTimeout(() => e.target.classList.add('visible'), i * 80);
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });
  document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

  function toggleFaq(btn) {
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
    if (!isOpen) item.classList.add('open');
  }

  function handleReserva(e) {
    e.preventDefault();
    const msg = document.getElementById('form-msg');
    msg.style.display = 'block';
    e.target.reset();
    setTimeout(() => msg.style.display = 'none', 5000);
  }

  document.getElementById('data').min = new Date().toISOString().split('T')[0];
</script>

</body>
</html>
