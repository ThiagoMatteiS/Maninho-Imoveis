<?php
require_once __DIR__ . '/includes/admin-auth.php';
require_once __DIR__ . '/../includes/config.php';

if (admin_logado()) {
    header('Location: index.php');
    exit;
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha   = $_POST['senha'] ?? '';

    if (verificar_credenciais_admin($usuario, $senha)) {
        $_SESSION['admin_usuario'] = $usuario;
        header('Location: index.php');
        exit;
    }
    $erro = 'Usuário ou senha incorretos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entrar — Painel · <?= SITE_NOME ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="css/admin.css">
</head>
<body class="admin-login-shell">

  <div class="admin-login-card form-card">
    <div class="admin-login-mark">
      <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M20 2 C11 2 3 9 3 20 C3 31 11 38 20 38" stroke="#B5482D" stroke-width="2" fill="none"/>
        <path d="M8 20 C8 12 13 6 20 6 C27 6 32 12 32 20 C32 28 27 34 20 34" stroke="#1B2A3B" stroke-width="1.4" fill="none" opacity="0.35"/>
        <circle cx="20" cy="20" r="3" fill="#4C6B4F"/>
      </svg>
    </div>

    <span class="eyebrow" style="display:block; text-align:center;">Área restrita</span>
    <h3 style="font-size:20px; margin:6px 0 0; font-family: var(--font-display); color: var(--ink); text-align:center;">Painel Administrativo</h3>

    <?php if ($erro): ?>
      <p class="admin-login-erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="post" action="login.php">
      <div class="form-grid">
        <div class="form-field full">
          <label for="usuario">Usuário</label>
          <input type="text" id="usuario" name="usuario" required autofocus>
        </div>
        <div class="form-field full">
          <label for="senha">Senha</label>
          <input type="password" id="senha" name="senha" required>
        </div>
      </div>
      <button type="submit" class="btn btn-clay">Entrar</button>
    </form>

    <p style="margin-top: var(--space-2); text-align:center;">
      <a href="../index.php" style="font-family: var(--font-mono); font-size:12px; color:var(--text-soft);">← Voltar para o site</a>
    </p>
  </div>

</body>
</html>
