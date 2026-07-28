<?php
require_once __DIR__ . '/includes/config.php';
$page_title  = 'Contato';
$active_page = 'contato';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <svg class="hero-contours" viewBox="0 0 1180 260" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-50 200 C 200 160, 350 230, 600 190 S 1000 130, 1250 190" stroke="#F3EEE1" stroke-width="1" fill="none"/>
    <path d="M-50 230 C 220 190, 380 250, 640 220 S 1020 160, 1250 220" stroke="#F3EEE1" stroke-width="1" fill="none"/>
  </svg>
  <div class="container page-hero-inner">
    <span class="breadcrumb"><a href="index.php">Início</a> / <span>Contato</span></span>
    <h1>Fale com a gente</h1>
    <p>Dúvidas sobre um imóvel, uma visita ou qualquer outro assunto — escolha o canal que preferir.</p>
  </div>
</section>

<section>
  <div class="container">

    <?php if (isset($_GET['enviado'])): ?>
      <div class="reveal is-visible" style="background:#fff; border:1px solid var(--moss); padding: var(--space-2) var(--space-3); margin-bottom: var(--space-3); color: var(--moss); font-size:14px;">
        Mensagem enviada com sucesso! Retornaremos em breve.
      </div>
    <?php elseif (isset($_GET['erro'])): ?>
      <div class="reveal is-visible" style="background:#fff; border:1px solid var(--clay); padding: var(--space-2) var(--space-3); margin-bottom: var(--space-3); color: var(--clay); font-size:14px;">
        Não foi possível enviar. Verifique os campos e tente novamente.
      </div>
    <?php endif; ?>

    <div class="form-shell">

      <div class="info-side reveal">
        <span class="eyebrow">Atendimento</span>
        <h2><?= SITE_RESPONSAVEL ?></h2>
        <p>Atendimento direto, sem intermediários. Toda visita e negociação acontece pessoalmente.</p>
        <ul class="info-list">
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M17.5 14.4c-.3-.1-1.7-.8-2-.9-.3-.1-.5-.1-.6.1-.2.3-.7.9-.9 1-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.6-2.1-.2-.3 0-.5.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.3-.4.1-.2 0-.4 0-.5 0-.1-.6-1.5-.8-2-.2-.5-.4-.5-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.3.2-.6.2-1.1.2-1.3-.1-.1-.3-.2-.6-.3z"/><path d="M12 2C6.5 2 2 6.5 2 12c0 1.9.5 3.6 1.4 5.1L2 22l5-1.3c1.5.8 3.2 1.3 5 1.3 5.5 0 10-4.5 10-10S17.5 2 12 2z"/></svg>
            <span>WhatsApp: <a href="<?= whatsapp_link('Olá! Vim pelo site e gostaria de mais informações.') ?>" target="_blank" rel="noopener" style="color:var(--ink); text-decoration:underline;"><?= SITE_TELEFONE_EXIBICAO ?></a></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="5" width="18" height="14" rx="1"/><path d="m3 7 9 6 9-6"/></svg>
            <span>E-mail: <a href="mailto:<?= SITE_EMAIL ?>" style="color:var(--ink); text-decoration:underline;"><?= SITE_EMAIL ?></a></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
            <span>Atendimento de segunda a sábado, das 9h às 18h.</span>
          </li>
        </ul>
      </div>

      <div class="form-card reveal">
        <span class="eyebrow">Mensagem</span>
        <h3 style="font-size:20px; margin:6px 0 0;">Envie sua dúvida</h3>

        <form action="processa-contato.php" method="post">
          <div class="form-grid">
            <div class="form-field">
              <label for="nome">Nome</label>
              <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-field">
              <label for="telefone">Telefone</label>
              <input type="tel" id="telefone" name="telefone" placeholder="(51) 9XXXX-XXXX">
            </div>
            <div class="form-field full">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-field full">
              <label for="mensagem">Mensagem</label>
              <textarea id="mensagem" name="mensagem" placeholder="Como podemos ajudar?" required></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-clay">Enviar mensagem</button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
