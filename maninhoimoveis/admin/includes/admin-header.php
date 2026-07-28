<?php
require_once __DIR__ . '/admin-auth.php';
exigir_login_admin();
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/mensagens.php';

$naoLidas = contar_mensagens_nao_lidas();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($page_title) ? $page_title . ' — Painel · ' . SITE_NOME : 'Painel · ' . SITE_NOME ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="css/admin.css">
</head>
<body class="admin-body">

<div class="admin-shell">

  <div class="admin-sidebar-overlay"></div>

  <aside class="admin-sidebar" id="admin-sidebar">
    <div class="admin-sidebar-brand">
      <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M20 2 C11 2 3 9 3 20 C3 31 11 38 20 38" stroke="#B5482D" stroke-width="2" fill="none"/>
        <path d="M8 20 C8 12 13 6 20 6 C27 6 32 12 32 20 C32 28 27 34 20 34" stroke="#F3EEE1" stroke-width="1.4" fill="none" opacity="0.6"/>
        <circle cx="20" cy="20" r="3" fill="#4C6B4F"/>
      </svg>
      <span>
        <span class="nome">Maninho</span>
        <small class="selo">PAINEL ADMINISTRATIVO</small>
      </span>
    </div>

    <nav class="admin-nav" aria-label="Navegação do painel">
      <a href="index.php" class="admin-nav-link <?= ($active_admin ?? '') === 'dashboard' ? 'is-active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="3" width="8" height="8" rx="1"/><rect x="13" y="3" width="8" height="5" rx="1"/><rect x="13" y="11" width="8" height="10" rx="1"/><rect x="3" y="14" width="8" height="7" rx="1"/></svg>
        Dashboard
      </a>
      <a href="imoveis.php" class="admin-nav-link <?= ($active_admin ?? '') === 'imoveis' ? 'is-active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M3 11 12 3l9 8"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/></svg>
        Imóveis
      </a>
      <a href="mensagens.php" class="admin-nav-link <?= ($active_admin ?? '') === 'mensagens' ? 'is-active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
        Mensagens
        <?php if ($naoLidas > 0): ?><span class="admin-nav-badge"><?= $naoLidas ?></span><?php endif; ?>
      </a>
    </nav>

    <div class="admin-sidebar-footer">
      <span class="usuario-logado">Logado como <?= htmlspecialchars($_SESSION['admin_usuario'] ?? '') ?></span>
      <a href="../index.php" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M14 3h7v7"/><path d="M10 14 21 3"/><path d="M21 14v7H3V3h7"/></svg>
        Ver site
      </a>
      <a href="logout.php">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
        Sair
      </a>
    </div>
  </aside>

  <div class="admin-main">
    <header class="admin-topbar">
      <button class="admin-menu-toggle" aria-label="Abrir menu" type="button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
      </button>
      <h1 class="admin-page-title"><?= htmlspecialchars($page_title ?? 'Painel') ?></h1>
      <div class="admin-topbar-spacer"></div>
      <a href="mensagens.php" class="admin-topbar-bell" aria-label="Mensagens">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.7 21a2 2 0 0 1-3.4 0"/></svg>
        <?php if ($naoLidas > 0): ?><span class="ponto"></span><?php endif; ?>
      </a>
    </header>

    <main class="admin-content">
