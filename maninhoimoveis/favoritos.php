<?php
require_once __DIR__ . '/includes/config.php';
$page_title  = 'Meus Favoritos';
$active_page = '';

// Quando o login existir de verdade, isto vira uma checagem de sessão:
// $logado = isset($_SESSION['usuario_id']);
$logado = false;

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="padding-bottom: var(--space-3);">
  <svg class="hero-contours" viewBox="0 0 1180 200" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-50 150 C 200 110, 350 180, 600 140 S 1000 80, 1250 140" stroke="#F3EEE1" stroke-width="1" fill="none"/>
  </svg>
  <div class="container page-hero-inner">
    <span class="breadcrumb"><a href="index.php">Início</a> / <span>Favoritos</span></span>
    <h1>Meus favoritos</h1>
    <p>Os imóveis que você salvar aparecem aqui, para você acompanhar com calma.</p>
  </div>
</section>

<section>
  <div class="container">
    <?php if (!$logado): ?>
      <div class="empty-state reveal">
        <h3>Você ainda não entrou na sua conta</h3>
        <p>Faça login para ver e salvar seus imóveis favoritos.</p>
        <p style="margin-top: var(--space-2);">
          <a href="login.php" class="btn btn-clay" style="display:inline-flex;">Entrar ou criar conta</a>
        </p>
      </div>
    <?php else: ?>
      <!-- Quando logado, listar aqui os imóveis favoritados do usuário -->
      <div class="empty-state reveal">
        <h3>Nenhum favorito ainda</h3>
        <p>Navegue pelos <a href="loteamentos.php" style="color:var(--clay);">imóveis</a> e clique no coração para salvar aqui.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
