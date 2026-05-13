<?php
require_once 'config.php';
session_start();

$PASSWORD = 'GameZoneClient2026@';

if (isset($_POST['login_password'])) {
    if ($_POST['login_password'] === $PASSWORD) {
        $_SESSION['admin'] = true;
    } else {
        $errorLogin = 'Contrasenya incorrecta.';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: incidencia.php');
    exit;
}

$autenticat = $_SESSION['admin'] ?? false;

if ($autenticat):
    $missatge = '';
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['login_password'])) {
        $equip     = trim($_POST['equip']     ?? '');
        $descripcio = trim($_POST['descripcio'] ?? '');
        $gravetat  = trim($_POST['gravetat']  ?? '');

        $gravitats = ['baixa', 'mitjana', 'alta'];

        if (!$equip || !$descripcio || !in_array($gravetat, $gravitats)) {
            $error = 'Omple tots els camps correctament.';
        } else {
            $stmt = $conn->prepare(
                'INSERT INTO incidencies (equip, descripcio, gravetat) VALUES (?, ?, ?)'
            );
            $stmt->bind_param('sss', $equip, $descripcio, $gravetat);
            $stmt->execute();
            $id = $conn->insert_id;
            $stmt->close();

            if ($gravetat === 'alta') {
                $assumpte = "⚠ Incidència ALTA #$id — GameZone";
                $cos = "Nova incidència de gravetat ALTA.\n\nEquip: $equip\nDescripció: $descripcio\nCodi: #$id\n\nAccedeix al panel per gestionar-la.";
                mail('tecnic@gamezone.cat', $assumpte, $cos, 'From: noreply@gamezone.cat');
            }

            $missatge = "Incidència #$id creada correctament.";
        }
    }

    $equips = [
        'PCGaming1', 'PCGaming2', 'PCGaming3', 'PCGaming4', 'PCGaming5', 'PCGaming6',
        'Consola1 (PS5)', 'Consola2 (PS5)', 'Consola3 (PS5)',
        'Consola4 (Xbox)', 'Consola5 (Xbox)', 'Consola6 (Xbox)',
        'AltRendiment1', 'AltRendiment2',
        'VR 0', 'VR 1',
        'Recepcio1', 'WindowsServer', 'Xarxa/Router'
    ];
endif;
?>
<!DOCTYPE html>
<html lang="ca">
<head>
  <title>Nova Incidència — GameZone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#0a0a0a; color:#f0f0f0; font-family: monospace; }
    .card { background:#111; border:1px solid #1e1e1e; }
    .navbar { background:#111; border-bottom:1px solid #1e1e1e; }
    .form-control, .form-select {
      background:#0a0a0a; border:1px solid #1e1e1e; color:#f0f0f0;
    }
    .form-control:focus, .form-select:focus {
      background:#0a0a0a; border-color:#c8f135; color:#f0f0f0; box-shadow:none;
    }
    .form-select option { background:#111; }
    label { color:#666; font-size:.75rem; letter-spacing:.1em; text-transform:uppercase; }
    .btn-accent { background:#c8f135; color:#000; border:none; font-weight:700; }
    .btn-accent:hover { background:#b0d42e; color:#000; }
    .badge-alta    { background:transparent; border:1px solid #ff4444; color:#ff4444; }
    .badge-mitjana { background:transparent; border:1px solid #ffd700; color:#ffd700; }
    .badge-baixa   { background:transparent; border:1px solid #666; color:#666; }
    .login-box { max-width:340px; margin:15vh auto; }
  </style>
</head>
<body>

<?php if (!$autenticat): ?>
<div class="login-box card p-5">
  <h5 class="mb-4" style="color:#c8f135">GameZone · Login Incidències</h5>
  <?php if (isset($errorLogin)): ?>
    <div class="text-danger small mb-3"><?= htmlspecialchars($errorLogin) ?></div>
  <?php endif; ?>
  <form method="POST">
    <input type="password" name="login_password" class="form-control bg-dark text-light border-secondary mb-3"
           placeholder="Contrasenya" autofocus>
    <button class="btn btn-accent w-100">Accedir</button>
  </form>
</div>
<?php else: ?>
<nav class="navbar px-4 py-3 mb-4 d-flex justify-content-between">
  <span style="color:#c8f135; font-weight:700">GameZone · Nova Incidència</span>
  <div class="d-flex gap-2">
    <a href="admin.php" class="btn btn-sm btn-outline-secondary">← Panel admin</a>
    <a href="incidencia.php?logout=1" class="btn btn-sm btn-outline-danger">Sortir</a>
  </div>
</nav>

<div class="container" style="max-width:560px;">
  <div class="card p-4">

    <?php if ($missatge): ?>
      <div class="mb-4" style="color:#c8f135; font-size:.85rem;">✓ <?= htmlspecialchars($missatge) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="mb-4" style="color:#ff4444; font-size:.85rem;">✗ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">

      <div class="mb-3">
        <label class="form-label">Equip afectat</label>
        <select name="equip" class="form-select" required>
          <option value="">Selecciona l'equip</option>
          <?php foreach ($equips as $e): ?>
            <option value="<?= $e ?>" <?= ($_POST['equip'] ?? '') === $e ? 'selected' : '' ?>>
              <?= $e ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Descripció del problema</label>
        <textarea name="descripcio" class="form-control" rows="4" required
          placeholder="Descriu el problema..."><?= htmlspecialchars($_POST['descripcio'] ?? '') ?></textarea>
      </div>

      <div class="mb-4">
        <label class="form-label">Gravetat</label>
        <select name="gravetat" class="form-select" required>
          <option value="">Selecciona la gravetat</option>
          <option value="baixa"   <?= ($_POST['gravetat'] ?? '') === 'baixa'   ? 'selected' : '' ?>>Baixa — el client pot continuar</option>
          <option value="mitjana" <?= ($_POST['gravetat'] ?? '') === 'mitjana' ? 'selected' : '' ?>>Mitjana — cal revisar aviat</option>
          <option value="alta"    <?= ($_POST['gravetat'] ?? '') === 'alta'    ? 'selected' : '' ?>>Alta — equip fora de servei</option>
        </select>
      </div>

      <button type="submit" class="btn btn-accent w-100">Crear incidència</button>
    </form>
  </div>
</div>
<?php endif; ?>

</body>
</html>
