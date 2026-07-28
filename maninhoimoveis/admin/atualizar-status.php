<?php
require_once __DIR__ . '/includes/admin-auth.php';
exigir_login_admin();
require_once __DIR__ . '/../includes/dados-imoveis.php';

$statusValidos = ['disponivel', 'reservado', 'vendido'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['status'])) {
    if (in_array($_POST['status'], $statusValidos, true)) {
        atualizar_status_imovel((int) $_POST['id'], $_POST['status']);
    }
}

$voltar = $_POST['voltar'] ?? 'imoveis.php';
$separador = strpos($voltar, '?') !== false ? '&' : '?';
header('Location: ' . $voltar . $separador . 'sucesso=status-atualizado');
exit;
