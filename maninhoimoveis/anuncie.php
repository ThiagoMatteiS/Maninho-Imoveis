<?php
require_once __DIR__ . '/includes/config.php';
$page_title  = 'Anuncie Conosco';
$active_page = 'anuncie';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <svg class="hero-contours" viewBox="0 0 1180 260" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-50 200 C 200 160, 350 230, 600 190 S 1000 130, 1250 190" stroke="#F3EEE1" stroke-width="1" fill="none"/>
    <path d="M-50 230 C 220 190, 380 250, 640 220 S 1020 160, 1250 220" stroke="#F3EEE1" stroke-width="1" fill="none"/>
  </svg>
  <div class="container page-hero-inner">
    <span class="breadcrumb"><a href="index.php">Início</a> / <span>Anuncie Conosco</span></span>
    <h1>Quer vender seu imóvel?</h1>
    <p>Conte os detalhes do seu terreno, apartamento ou casa. <?= SITE_RESPONSAVEL ?> entra em contato para uma avaliação.</p>
  </div>
</section>

<section>
  <div class="container">

    <?php if (isset($_GET['enviado'])): ?>
      <div class="reveal is-visible" style="background:#fff; border:1px solid var(--moss); padding: var(--space-2) var(--space-3); margin-bottom: var(--space-3); color: var(--moss); font-size:14px;">
        Recebemos as informações do seu imóvel! Entraremos em contato em breve.
      </div>
    <?php elseif (isset($_GET['erro'])): ?>
      <div class="reveal is-visible" style="background:#fff; border:1px solid var(--clay); padding: var(--space-2) var(--space-3); margin-bottom: var(--space-3); color: var(--clay); font-size:14px;">
        Não foi possível enviar. Verifique os campos obrigatórios e tente novamente.
      </div>
    <?php endif; ?>

    <div class="form-shell">

      <div class="info-side reveal">
        <span class="eyebrow">Como funciona</span>
        <h2>É simples e direto</h2>
        <p>Preencha o formulário com as informações do seu imóvel. Nossa equipe analisa e retorna o contato para combinar uma visita e conversar sobre valores.</p>
        <ul class="info-list">
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 2 2 8l10 6 10-6-10-6z"/><path d="M2 8v8l10 6 10-6V8"/></svg>
            <span>Aceitamos terrenos, apartamentos e casas em qualquer estado de conservação.</span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
            <span>Retorno em até 2 dias úteis pelo telefone ou e-mail informado.</span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 21v-7a8 8 0 0 1 16 0v7"/><path d="M4 14h16"/></svg>
            <span>Toda avaliação e negociação acontece presencialmente, sem burocracia on-line.</span>
          </li>
        </ul>
      </div>

      <div class="form-card reveal">
        <span class="eyebrow">Formulário</span>
        <h3 style="font-size:20px; margin:6px 0 0;">Dados do seu imóvel</h3>

        <form action="processa-anuncio.php" method="post">
          <div class="form-grid">
            <div class="form-field">
              <label for="nome">Nome completo</label>
              <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-field">
              <label for="telefone">Telefone / WhatsApp</label>
              <input type="tel" id="telefone" name="telefone" placeholder="(51) 9XXXX-XXXX" required>
            </div>
            <div class="form-field full">
              <label for="email">E-mail</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-field">
              <label for="tipo">Tipo de imóvel</label>
              <select id="tipo" name="tipo" required>
                <option value="">Selecione</option>
                <option value="terreno">Terreno / Loteamento</option>
                <option value="apartamento">Apartamento</option>
                <option value="casa">Casa</option>
              </select>
            </div>
            <div class="form-field">
              <label for="bairro">Bairro</label>
              <input type="text" id="bairro" name="bairro" required>
            </div>
            <div class="form-field full">
              <label for="valor">Valor pretendido</label>
              <input type="text" id="valor" name="valor" placeholder="R$">
            </div>
            <div class="form-field full">
              <label for="descricao">Descreva o imóvel</label>
              <textarea id="descricao" name="descricao" placeholder="Metragem, quartos, diferenciais, estado de conservação..."></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-clay">Enviar para avaliação</button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
