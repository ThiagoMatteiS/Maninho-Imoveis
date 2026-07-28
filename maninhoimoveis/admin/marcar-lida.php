<?php
require_once __DIR__ . '/includes/admin-auth.php';
exigir_login_admin();
require_once __DIR__ . '/../includes/mensagens.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    marcar_mensagem_lida((int) $_POST['id']);
}

$tipo = $_POST['tipo'] ?? '';
$query = ($tipo !== '' ? 'tipo=' . urlencode($tipo) . '&' : '') . 'sucesso=mensagem-lida';
header('Location: mensagens.php?' . $query);
exit;
