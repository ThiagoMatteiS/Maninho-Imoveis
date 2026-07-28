<?php
require_once __DIR__ . '/config.php';

/**
 * Calcula automaticamente a pasta em que o site está rodando,
 * não importa se é localhost/, localhost/www/maninhoimoveis/,
 * um subdomínio ou hospedagem real. Isso evita o clássico problema
 * de "CSS não conecta" quando a URL é acessada sem a barra final.
 */
$pasta_base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/') . '/';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?= $pasta_base ?>">
<title><?= isset($page_title) ? $page_title . ' — ' . SITE_NOME : SITE_NOME ?></title>
<meta name="description" content="Imóveis à venda: loteamentos, apartamentos e casas. Navegue, favorite e agende sua visita presencial com <?= SITE_RESPONSAVEL ?>.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>

<header class="site-header">
  <div class="container">
    <a href="<?= BASE_URL ?>index.php" class="logo">
      <svg class="logo-mark" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path d="M20 2 C11 2 3 9 3 20 C3 31 11 38 20 38" stroke="#B5482D" stroke-width="2" fill="none"/>
        <path d="M8 20 C8 12 13 6 20 6 C27 6 32 12 32 20 C32 28 27 34 20 34" stroke="#F3EEE1" stroke-width="1.4" fill="none" opacity="0.6"/>
        <circle cx="20" cy="20" r="3" fill="#4C6B4F"/>
      </svg>
      <span class="logo-text">Maninho<small>IMÓVEIS · DESDE O TERRENO ATÉ A CHAVE</small></span>
    </a>

    <nav class="main-nav" aria-label="Navegação principal">
      <ul>
        <li><a href="<?= BASE_URL ?>index.php" class="<?= ($active_page ?? '') === 'home' ? 'is-active' : '' ?>">Início</a></li>
        <li><a href="<?= BASE_URL ?>loteamentos.php" class="<?= ($active_page ?? '') === 'loteamentos' ? 'is-active' : '' ?>">Loteamentos</a></li>
        <li><a href="<?= BASE_URL ?>apartamentos.php" class="<?= ($active_page ?? '') === 'apartamentos' ? 'is-active' : '' ?>">Apartamentos</a></li>
        <li><a href="<?= BASE_URL ?>casas.php" class="<?= ($active_page ?? '') === 'casas' ? 'is-active' : '' ?>">Casas</a></li>
        <li><a href="<?= BASE_URL ?>anuncie.php" class="<?= ($active_page ?? '') === 'anuncie' ? 'is-active' : '' ?>">Anuncie Conosco</a></li>
        <li><a href="<?= BASE_URL ?>contato.php" class="<?= ($active_page ?? '') === 'contato' ? 'is-active' : '' ?>">Contato</a></li>
      </ul>
    </nav>

    <div class="nav-actions">
      <a href="<?= BASE_URL ?>favoritos.php" class="icon-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s-7.5-4.7-10-9.3C.4 8.6 2 5 5.5 5c2 0 3.3 1 4.5 2.6C11.2 6 12.5 5 14.5 5 18 5 19.6 8.6 22 11.7 19.5 16.3 12 21 12 21z"/></svg>
        Favoritos
      </a>
      <a href="<?= BASE_URL ?>login.php" class="btn btn-outline">Entrar</a>
      <button class="nav-toggle" aria-label="Abrir menu">
        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
      </button>
    </div>
  </div>
</header>
