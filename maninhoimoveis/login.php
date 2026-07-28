<?php
require_once __DIR__ . '/includes/config.php';
$page_title  = 'Entrar';
$active_page = '';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="padding-bottom: var(--space-3);">
  <svg class="hero-contours" viewBox="0 0 1180 200" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-50 150 C 200 110, 350 180, 600 140 S 1000 80, 1250 140" stroke="#F3EEE1" stroke-width="1" fill="none"/>
  </svg>
  <div class="container page-hero-inner">
    <span class="breadcrumb"><a href="index.php">Início</a> / <span>Entrar</span></span>
    <h1>Acesse sua conta</h1>
    <p>Entre para favoritar imóveis e acompanhar suas visitas agendadas.</p>
  </div>
</section>

<section>
  <div class="container" style="max-width: 480px;">

    <div class="search-tabs reveal" style="margin-bottom: var(--space-3);">
      <button type="button" class="is-active" data-form-tab="login">Entrar</button>
      <button type="button" data-form-tab="cadastro">Criar conta</button>
    </div>

    <div class="form-card reveal" id="form-login">
      <span class="eyebrow">Já tenho conta</span>
      <h3 style="font-size:20px; margin:6px 0 0;">Entrar</h3>
      <form action="processa-login.php" method="post">
        <div class="form-grid">
          <div class="form-field full">
            <label for="email-login">E-mail</label>
            <input type="email" id="email-login" name="email" required>
          </div>
          <div class="form-field full">
            <label for="senha-login">Senha</label>
            <input type="password" id="senha-login" name="senha" required>
          </div>
        </div>
        <button type="submit" class="btn btn-clay">Entrar</button>
      </form>
    </div>

    <div class="form-card reveal" id="form-cadastro" style="display:none;">
      <span class="eyebrow">Novo por aqui</span>
      <h3 style="font-size:20px; margin:6px 0 0;">Criar conta gratuita</h3>
      <form action="processa-cadastro.php" method="post">
        <div class="form-grid">
          <div class="form-field full">
            <label for="nome-cad">Nome</label>
            <input type="text" id="nome-cad" name="nome" required>
          </div>
          <div class="form-field full">
            <label for="email-cad">E-mail</label>
            <input type="email" id="email-cad" name="email" required>
          </div>
          <div class="form-field full">
            <label for="telefone-cad">Telefone</label>
            <input type="tel" id="telefone-cad" name="telefone" placeholder="(51) 9XXXX-XXXX">
          </div>
          <div class="form-field full">
            <label for="senha-cad">Senha</label>
            <input type="password" id="senha-cad" name="senha" required>
          </div>
        </div>
        <button type="submit" class="btn btn-clay">Criar conta</button>
      </form>
    </div>

  </div>
</section>

<script>
  // Alterna entre os formulários de Entrar e Criar conta
  document.querySelectorAll('[data-form-tab]').forEach(function (botao) {
    botao.addEventListener('click', function () {
      document.querySelectorAll('[data-form-tab]').forEach(function (b) { b.classList.remove('is-active'); });
      botao.classList.add('is-active');

      var alvo = botao.getAttribute('data-form-tab');
      document.getElementById('form-login').style.display = alvo === 'login' ? 'block' : 'none';
      document.getElementById('form-cadastro').style.display = alvo === 'cadastro' ? 'block' : 'none';
    });
  });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
