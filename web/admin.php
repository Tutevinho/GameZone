<?php
require_once 'config.php';

session_start();

$PASSWORD = 'GameZoneClient2026@';

if (isset($_POST['password'])) {
    if ($_POST['password'] === $PASSWORD) {
        $_SESSION['admin'] = true;
    } else {
        $errorLogin = 'Contrasenya incorrecta.';
    }
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

$autenticat = $_SESSION['admin'] ?? false;

if ($autenticat) {

    if (isset($_GET['confirmar'])) {
        $id = (int)$_GET['confirmar'];
        $conn->query("UPDATE reserves SET estat='confirmada' WHERE id=$id");
        header('Location: admin.php');
        exit;
    }
    if (isset($_GET['cancel'])) {
        $id = (int)$_GET['cancel'];
        $conn->query("UPDATE reserves SET estat='cancel·lada' WHERE id=$id");
        header('Location: admin.php');
        exit;
    }
    if (isset($_GET['delete_reserva'])) {
        $id = (int)$_GET['delete_reserva'];
        $conn->query("DELETE FROM reserves WHERE id=$id");
        header('Location: admin.php');
        exit;
    }

    if (isset($_GET['resoldre'])) {
        $id = (int)$_GET['resoldre'];
        $conn->query("UPDATE incidencies SET estat='resolta' WHERE id=$id");
        header('Location: admin.php#incidencies');
        exit;
    }
    if (isset($_GET['en-curs'])) {
        $id = (int)$_GET['en-curs'];
        $conn->query("UPDATE incidencies SET estat='en curs' WHERE id=$id");
        header('Location: admin.php#incidencies');
        exit;
    }
    if (isset($_GET['delete_incidencia'])) {
        $id = (int)$_GET['delete_incidencia'];
        $conn->query("DELETE FROM incidencies WHERE id=$id");
        header('Location: admin.php#incidencies');
        exit;
    }

    $reserves = $conn->query(
        'SELECT * FROM reserves ORDER BY data_reserva ASC'
    )->fetch_all(MYSQLI_ASSOC);

    $incidencies = $conn->query(
        "SELECT * FROM incidencies ORDER BY FIELD(estat,'en curs','oberta','resolta'), gravetat DESC, created_at DESC"
    )->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
  <title>Admin — GameZone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    body { background: var(--bg); color: var(--text); font-family: var(--sans); }
    .navbar { background: var(--surface); border-bottom: 1px solid var(--border); }
    .card { background: var(--surface); border: 1px solid var(--border); }
    .table { color: var(--text); margin-bottom: 0; background-color: transparent !important; }
    .table thead th { 
      background: #161616 !important; 
      color: var(--muted); 
      font-family: var(--mono);
      font-size: .7rem; 
      text-transform: uppercase; 
      letter-spacing: .1em; 
      border-bottom: 1px solid var(--border) !important;
      padding: 12px;
    }
    .table td { 
      background-color: transparent !important;
      border-bottom: 1px solid var(--border) !important; 
      vertical-align: middle; 
      padding: 12px;
      font-family: var(--mono);
      font-size: .85rem;
    }
    .table tbody tr { background-color: transparent !important; }
    .table tbody tr:hover { background: #141414 !important; }
    .section-title {
      font-family: var(--mono);
      font-size: .7rem; letter-spacing: .15em; text-transform: uppercase;
      color: var(--accent); margin-bottom: 16px; padding-bottom: 12px;
      border-bottom: 1px solid var(--border);
    }
    .badge-pendent, .badge-oberta { background: rgba(255,215,0,0.1); border: 1px solid gold; color: gold; padding: 3px 8px; font-size: .65rem; border-radius: 4px; font-family: var(--mono); }
    .badge-confirmada { background: var(--accent-dim); border: 1px solid var(--accent); color: var(--accent); padding: 3px 8px; font-size: .65rem; border-radius: 4px; font-family: var(--mono); }
    .badge-cancelada, .badge-resolta { background: rgba(102,102,102,0.1); border: 1px solid var(--muted); color: var(--muted); padding: 3px 8px; font-size: .65rem; border-radius: 4px; font-family: var(--mono); }
    .badge-encurs { background: rgba(77,184,255,0.1); border: 1px solid #4db8ff; color: #4db8ff; padding: 3px 8px; font-size: .65rem; border-radius: 4px; font-family: var(--mono); }
    .grav-alta    { color: #ff4444; font-weight: 700; font-family: var(--mono); }
    .grav-mitjana { color: #ffd700; font-family: var(--mono); }
    .grav-baixa   { color: var(--muted); font-family: var(--mono); }
    .login-box { max-width: 340px; margin: 15vh auto; }
    .btn-accent { 
      background: var(--accent); color: #000; border: none; font-weight: 700; 
      font-family: var(--mono); font-size: .75rem; text-transform: uppercase; letter-spacing: .1em;
    }
    .btn-accent:hover { background: #b0d42e; color: #000; }
    .btn-outline-light { 
      color: var(--text) !important; border: 1px solid var(--border) !important; background: transparent !important; 
      font-family: var(--mono); font-size: .75rem; text-transform: uppercase; letter-spacing: .1em;
    }
    .btn-outline-light:hover { background: var(--text) !important; color: #000 !important; }
    .btn-outline-danger { 
      color: #ff4444 !important; border: 1px solid #ff4444 !important; background: transparent !important; 
      font-family: var(--mono); font-size: .75rem; text-transform: uppercase; letter-spacing: .1em;
    }
    .btn-outline-danger:hover { background: #ff4444 !important; color: #fff !important; }
    .btn-outline-info { 
      color: #4db8ff !important; border: 1px solid #4db8ff !important; background: transparent !important; 
      font-family: var(--mono); font-size: .75rem; text-transform: uppercase; letter-spacing: .1em;
    }
    .btn-outline-info:hover { background: #4db8ff !important; color: #fff !important; }
    .btn-outline-warning { 
      color: #ffd700 !important; border: 1px solid #ffd700 !important; background: transparent !important; 
      font-family: var(--mono); font-size: .75rem; text-transform: uppercase; letter-spacing: .1em;
    }
    .btn-outline-warning:hover { background: #ffd700 !important; color: #000 !important; }
    .btn-outline-secondary { 
      color: var(--muted) !important; border: 1px solid var(--border) !important; background: transparent !important; 
      font-family: var(--mono); font-size: .75rem; text-transform: uppercase; letter-spacing: .1em;
    }
    .btn-outline-secondary:hover { background: var(--muted) !important; color: #000 !important; }
  </style>
</head>
<body>

<?php if (!$autenticat): ?>
<div class="login-box card p-5">
  <h5 class="mb-4" style="color:#c8f135">GameZone · Admin</h5>
  <?php if (isset($errorLogin)): ?>
    <div class="text-danger small mb-3"><?= htmlspecialchars($errorLogin) ?></div>
  <?php endif; ?>
  <form method="POST">
    <input type="password" name="password" class="form-control bg-dark text-light border-secondary mb-3"
           placeholder="Contrasenya" autofocus>
    <button class="btn btn-accent w-100">Accedir</button>
  </form>
</div>

<?php else: ?>

<nav class="navbar px-4 py-3 mb-4 d-flex align-items-center gap-3">
  <span style="color:#c8f135; font-weight:700">GameZone · Admin</span>
  <a href="incidencia.php" class="btn btn-sm btn-outline-warning ms-auto">+ Nova incidència</a>
  <a href="index.php" class="btn btn-sm btn-outline-secondary">Web pública</a>
  <a href="admin.php?logout=1" class="btn btn-sm btn-outline-danger">Sortir</a>
</nav>

  <div class="container-fluid px-4">

  <div class="mb-5">
    <div class="section-title">Reserves</div>
    <?php if (empty($reserves)): ?>
      <p style="color:#666">No hi ha reserves.</p>
    <?php else: ?>
    <table class="table table-borderless">
      <thead>
        <tr>
          <th>#</th><th>Nom</th><th>Correu</th><th>Zona</th>
          <th>Data</th><th>Hores</th><th>Estat</th><th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($reserves as $r): ?>
        <tr>
          <td style="color:#666"><?= $r['id'] ?></td>
          <td><?= htmlspecialchars($r['nom']) ?></td>
          <td style="color:#666"><?= htmlspecialchars($r['email']) ?></td>
          <td><?= htmlspecialchars($r['zona']) ?></td>
          <td><?= $r['data_reserva'] ?></td>
          <td><?= $r['hores'] ?>h</td>
          <td>
            <span class="badge-<?= str_replace(['·',' '],'',$r['estat']) ?>">
              <?= $r['estat'] ?>
            </span>
          </td>
           <td>
             <?php if ($r['estat'] === 'pendent'): ?>
                <a href="admin.php?confirmar=<?= $r['id'] ?>" class="btn btn-sm btn-accent me-1">Confirmar</a>
               <a href="admin.php?cancel=<?= $r['id'] ?>" class="btn btn-sm btn-outline-danger me-1">Cancel·lar</a>
             <?php endif; ?>
              <a href="admin.php?delete_reserva=<?= $r['id'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
           </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>

  <div id="incidencies" class="mb-5">
    <div class="section-title d-flex align-items-center justify-content-between">
      <span>Incidències</span>
      <a href="incidencia.php" class="btn btn-sm btn-outline-warning" style="font-size:.7rem;">+ Nova</a>
    </div>
    <?php if (empty($incidencies)): ?>
      <p style="color:#666">No hi ha incidències.</p>
    <?php else: ?>
    <table class="table table-borderless">
      <thead>
        <tr>
          <th>#</th><th>Equip</th><th>Descripció</th>
          <th>Gravetat</th><th>Estat</th><th>Data</th><th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($incidencies as $i): ?>
        <tr>
          <td style="color:#666"><?= $i['id'] ?></td>
          <td><?= htmlspecialchars($i['equip']) ?></td>
          <td style="color:#aaa; max-width:300px;">
            <?php
            $d = $i['descripcio'];
            if (preg_match('/^.{0,60}/us', $d, $m) && $m[0] !== $d) {
                $d = $m[0] . '...';
            }
            echo htmlspecialchars($d);
            ?>
          </td>
          <td>
            <span class="grav-<?= $i['gravetat'] ?>"><?= strtoupper($i['gravetat']) ?></span>
          </td>
          <td>
            <span class="badge-<?= str_replace(' ','',$i['estat']) ?>">
              <?= $i['estat'] ?>
            </span>
          </td>
          <td style="color:#666"><?= date('d/m/Y', strtotime($i['created_at'])) ?></td>
           <td>
             <?php if ($i['estat'] === 'oberta'): ?>
               <a href="admin.php?en-curs=<?= $i['id'] ?>" class="btn btn-sm btn-outline-info me-1">En curs</a>
                <a href="admin.php?resoldre=<?= $i['id'] ?>" class="btn btn-sm btn-accent me-1">Resoldre</a>
             <?php elseif ($i['estat'] === 'en curs'): ?>
                <a href="admin.php?resoldre=<?= $i['id'] ?>" class="btn btn-sm btn-accent me-1">Resoldre</a>
             <?php else: ?>
               <span class="me-2" style="color:#666">—</span>
             <?php endif; ?>
              <a href="admin.php?delete_incidencia=<?= $i['id'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
           </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>

</div>
<?php endif; ?>

</body>
</html>
