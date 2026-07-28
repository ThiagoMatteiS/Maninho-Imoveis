<?php
require_once __DIR__ . '/includes/admin-auth.php';
exigir_login_admin();
require_once __DIR__ . '/../includes/dados-imoveis.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    excluir_imovel((int) $_POST['id']);
}

header('Location: imoveis.php?sucesso=imovel-removido');
exit;
