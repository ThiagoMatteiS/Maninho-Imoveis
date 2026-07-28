<?php
require_once __DIR__ . '/includes/dados-imoveis.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$imovel = get_imovel($id);

$page_title  = $imovel ? $imovel['titulo'] : 'Imóvel não encontrado';
$active_page = '';

require_once __DIR__ . '/includes/header.php';

if (!$imovel) {
    ?>
    <section>
      <div class="container">
        <div class="empty-state reveal" style="margin: var(--space-5) 0;">
          <h3>Imóvel não encontrado</h3>
          <p>Esse imóvel pode ter sido vendido ou o link está incorreto.</p>
          <p style="margin-top:var(--space-2);"><a href="index.php" class="btn btn-clay" style="display:inline-flex;">Voltar para a Home</a></p>
        </div>
      </div>
    </section>
    <?php
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

[$statusTexto, $statusClasse] = rotulo_status($imovel['status']);
$disponivel = $imovel['status'] === 'disponivel';
$mensagemWhats = 'Olá! Tenho interesse no imóvel "' . $imovel['titulo'] . '" (cód. ' . $imovel['id'] . '). Gostaria de agendar uma visita.';
?>

<section style="padding-top: var(--space-3);">
  <div class="container">
    <span class="breadcrumb" style="color: var(--text-soft);">
      <a href="index.php" style="color:var(--text-soft);">Início</a> /
      <a href="<?= $imovel['tipo'] === 'loteamento' ? 'loteamentos.php' : $imovel['tipo'] . 's.php' ?>" style="color:var(--text-soft);"><?= htmlspecialchars(rotulo_tipo($imovel['tipo'])) ?>s</a> /
      <span style="color:var(--clay);"><?= htmlspecialchars($imovel['titulo']) ?></span>
    </span>
  </div>
</section>

<section style="padding-top: var(--space-2);">
  <div class="container">
    <div class="imovel-detalhe">

      <div class="reveal">
        <div class="gallery-main">
          <svg viewBox="0 0 600 375" preserveAspectRatio="none">
            <rect width="600" height="375" fill="#E9E1CC"/>
            <g transform="scale(2)"><?= thumb_svg_por_tipo($imovel['tipo']) ?></g>
          </svg>
        </div>
        <div class="gallery-thumbs">
          <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="thumb <?= $i === 0 ? 'is-active' : '' ?>">
              <svg viewBox="0 0 300 225" preserveAspectRatio="none">
                <rect width="300" height="225" fill="#E9E1CC"/>
                <?= thumb_svg_por_tipo($imovel['tipo']) ?>
              </svg>
            </div>
          <?php endfor; ?>
        </div>

        <div class="descricao-imovel">
          <h2 style="font-size:22px;">Sobre este imóvel</h2>
          <p><?= htmlspecialchars($imovel['descricao']) ?></p>
        </div>
      </div>

      <div class="reveal">
        <div class="specs-card">
          <h1 style="font-size:24px; margin-bottom:4px;"><?= htmlspecialchars($imovel['titulo']) ?></h1>
          <p class="local" style="color:var(--text-soft); margin-bottom:var(--space-2);">
            Bairro <?= htmlspecialchars($imovel['bairro']) ?>
            <?php if (!$disponivel): ?> · <strong style="color:var(--clay);"><?= htmlspecialchars($statusTexto) ?></strong><?php endif; ?>
          </p>

          <?php if ($imovel['tipo'] === 'loteamento' && $imovel['financiamento']): ?>
            <span class="financiamento-tag">Financiamento direto disponível</span>
          <?php endif; ?>

          <div class="valor-grande">R$ <?= formatar_valor($imovel['valor']) ?></div>

          <dl class="specs-grid">
            <?php if ($imovel['tipo'] === 'loteamento'): ?>
              <dt>Metragem</dt><dd><?= $imovel['metragem'] ?> m²</dd>
              <dt>Topografia</dt><dd><?= htmlspecialchars($imovel['topografia']) ?></dd>
              <dt>Orientação solar</dt><dd>Face <?= htmlspecialchars($imovel['orientacao']) ?></dd>
              <dt>Financiamento direto</dt><dd><?= $imovel['financiamento'] ? 'Sim' : 'Não' ?></dd>

            <?php elseif ($imovel['tipo'] === 'apartamento'): ?>
              <dt>Tamanho</dt><dd><?= $imovel['metragem'] ?> m²</dd>
              <dt>Quartos</dt><dd><?= $imovel['quartos'] ?></dd>
              <dt>Banheiros</dt><dd><?= $imovel['banheiros'] ?></dd>
              <dt>Andar</dt><dd><?= $imovel['andar'] ?>º</dd>
              <dt>Sacada</dt><dd><?= $imovel['sacada'] ? 'Sim' : 'Não' ?></dd>
              <dt>Garagem</dt><dd><?= $imovel['garagem'] ? 'Sim' : 'Não' ?></dd>
              <dt style="grid-column:1/-1;">Infraestrutura do prédio</dt>
              <dd style="grid-column:1/-1;"><?= htmlspecialchars($imovel['infraestrutura']) ?></dd>

            <?php else: // casa ?>
              <dt>Terreno</dt><dd><?= $imovel['terreno'] ?> m²</dd>
              <dt>Quartos</dt><dd><?= $imovel['quartos'] ?></dd>
              <dt>Banheiros</dt><dd><?= $imovel['banheiros'] ?></dd>
              <dt>Pavimentos</dt><dd><?= $imovel['pavimentos'] ?></dd>
              <dt>Garagem</dt><dd><?= $imovel['garagem'] ?> carro<?= $imovel['garagem'] > 1 ? 's' : '' ?></dd>
              <dt>Cerca</dt><dd><?= $imovel['cerca'] ? 'Sim' : 'Não' ?></dd>
              <dt>Piscina</dt><dd><?= $imovel['piscina'] ? 'Sim' : 'Não' ?></dd>
              <dt>Pátio</dt><dd><?= $imovel['patio'] ? 'Sim' : 'Não' ?></dd>
            <?php endif; ?>
          </dl>

          <?php if ($disponivel): ?>
            <div class="contact-actions">
              <a href="<?= whatsapp_link($mensagemWhats) ?>" class="btn btn-clay" target="_blank" rel="noopener">Falar no WhatsApp</a>
              <a href="mailto:<?= SITE_EMAIL ?>?subject=<?= rawurlencode('Interesse no imóvel: ' . $imovel['titulo']) ?>" class="btn btn-outline" style="color:var(--ink); border-color:var(--line);">Enviar e-mail</a>
              <button class="btn btn-outline" style="color:var(--ink); border-color:var(--line);" type="button">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s-7.5-4.7-10-9.3C.4 8.6 2 5 5.5 5c2 0 3.3 1 4.5 2.6C11.2 6 12.5 5 14.5 5 18 5 19.6 8.6 22 11.7 19.5 16.3 12 21 12 21z"/></svg>
                Favoritar
              </button>
            </div>
          <?php else: ?>
            <p style="color:var(--text-soft); font-size:14px; margin-top:var(--space-2);">
              Este imóvel está <?= strtolower($statusTexto) ?> no momento.
              <a href="<?= $imovel['tipo'] === 'loteamento' ? 'loteamentos.php' : $imovel['tipo'] . 's.php' ?>" style="color:var(--clay);">Ver outras opções</a>.
            </p>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<script>
  // Troca a imagem principal da galeria ao clicar numa miniatura
  document.querySelectorAll('.gallery-thumbs .thumb').forEach(function (thumb, indice) {
    thumb.addEventListener('click', function () {
      document.querySelectorAll('.gallery-thumbs .thumb').forEach(function (t) { t.classList.remove('is-active'); });
      thumb.classList.add('is-active');
      var principal = document.querySelector('.gallery-main');
      if (principal) {
        principal.style.opacity = '0';
        setTimeout(function () { principal.style.opacity = '1'; }, 150);
      }
    });
  });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
