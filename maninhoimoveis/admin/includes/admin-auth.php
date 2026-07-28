<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../includes/db.php';

function admin_logado(): bool {
    return isset($_SESSION['admin_usuario']);
}

/** Chame no topo de qualquer página do painel que exija login. */
function exigir_login_admin(): void {
    if (!admin_logado()) {
        header('Location: login.php');
        exit;
    }
}

/** Confere usuário/senha contra a tabela admin_usuarios. */
function verificar_credenciais_admin(string $usuario, string $senha): bool {
    $stmt = db()->prepare('SELECT senha_hash FROM admin_usuarios WHERE usuario = ?');
    $stmt->execute([$usuario]);
    $row = $stmt->fetch();
    return $row && password_verify($senha, $row['senha_hash']);
}
