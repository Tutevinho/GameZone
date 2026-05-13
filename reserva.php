<?php
require_once 'config.php';

$nom   = trim($_POST['nom']   ?? '');
$email = trim($_POST['email'] ?? '');
$zona  = trim($_POST['zona']  ?? '');
$data  = trim($_POST['data']  ?? '');
$hores = (int)($_POST['hores'] ?? 0);

if (!$nom || !$email || !$zona || !$data || !$hores) {
    header('Location: index.php?error=Omple+tots+els+camps.#reserves');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?error=El+correu+no+és+vàlid.#reserves');
    exit;
}

$stmt = $conn->prepare(
    'INSERT INTO reserves (nom, email, zona, data_reserva, hores) VALUES (?, ?, ?, ?, ?)'
);
$stmt->bind_param('ssssi', $nom, $email, $zona, $data, $hores);
$stmt->execute();
$id = $conn->insert_id;
$stmt->close();

$assumpte = "Reserva #$id confirmada — GameZone";
$cos = "Hola $nom,\n\nLa teva reserva ha estat confirmada.\n\nDetalls:\n- Zona: $zona\n- Data: $data\n- Hores: $hores\n- Codi: #$id\n\nFins aviat!\nGameZone";
mail($email, $assumpte, $cos, 'From: noreply@gamezone.cat');

header('Location: index.php?ok=1#reserves');
exit;
