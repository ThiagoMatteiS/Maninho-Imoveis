<?php
require_once __DIR__ . '/includes/dados-imoveis.php';

$page_title  = 'Casas';
$active_page = 'casas';

$f_quartos   = $_GET['quartos'] ?? '';
$f_piscina   = $_GET['piscina'] ?? '';
$f_pavimentos = $_GET['pavimentos'] ?? '';
$f_valor     = trim($_GET['valor'] ?? '');

$imoveis = get_imoveis_por_tipo('casa');

$imoveis = array_filter($imoveis, function ($im) use ($f_quartos, $f_piscina, $f_pavimentos, $f_valor) {
    if ($f_quartos !== '' && (int)$f_quartos !== (int)$im['quartos']) return false;
    if ($f_piscina === 'sim' && !$im['piscina']) return false;
    if ($f_pavimentos !== '' && (int)$f_pavimentos !== (int)$im['pavimentos']) return false;
    if ($f_valor !== '') {
        $valorMax = (int) preg_replace('/\D/', '', $f_valor);
        if ($valorMax > 0 && $im['valor'] > $valorMax) return false;
    }
    return true;
});

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <svg class="hero-contours" viewBox="0 0 1180 260" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-50 200 C 200 160, 350 230, 600 190 S 1000 130, 1250 190" stroke="#F3EEE1" stroke-width="1" fill="none"/>
    <path d="M-50 230 C 220 190, 380 250, 640 220 S 1020 160, 1250 220" stroke="#F3EEE1" stroke-width="1" fill="none"/>
  </svg>
  <div class="container page-hero-inner">
    <span class="breadcrumb"><a href="index.php">Início</a> / <span>Casas</span></span>
    <h1>Casas</h1>
    <p>Veja terreno, pavimentos, garagem, piscina e pátio de cada casa antes de agendar a visita.</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="listing-layout">

      <aside class="filter-panel">
        <h3>Filtrar casas</h3>
        <form method="get" action="casas.php">
          <div class="filter-group">
            <label for="quartos">Quartos</label>
            <select id="quartos" name="quartos">
              <option value="" <?= $f_quartos === '' ? 'selected' : '' ?>>Qualquer</option>
              <option value="2" <?= $f_quartos === '2' ? 'selected' : '' ?>>2 quartos</option>
              <option value="3" <?= $f_quartos === '3' ? 'selected' : '' ?>>3 quartos</option>
              <option value="4" <?= $f_quartos === '4' ? 'selected' : '' ?>>4 quartos</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="pavimentos">Pavimentos</label>
            <select id="pavimentos" name="pavimentos">
              <option value="" <?= $f_pavimentos === '' ? 'selected' : '' ?>>Qualquer</option>
              <option value="1" <?= $f_pavimentos === '1' ? 'selected' : '' ?>>Térrea</option>
              <option value="2" <?= $f_pavimentos === '2' ? 'selected' : '' ?>>2 pavimentos</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="piscina">Piscina</label>
            <select id="piscina" name="piscina">
              <option value="" <?= $f_piscina === '' ? 'selected' : '' ?>>Qualquer</option>
              <option value="sim" <?= $f_piscina === 'sim' ? 'selected' : '' ?>>Com piscina</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="valor">Valor máximo</label>
            <input type="text" id="valor" name="valor" placeholder="R$" value="<?= htmlspecialchars($f_valor) ?>">
          </div>
          <button type="submit" class="btn btn-clay" style="width:100%; justify-content:center;">Aplicar filtros</button>
          <?php if ($f_quartos || $f_piscina || $f_pavimentos || $f_valor): ?>
            <a href="casas.php" style="display:block; text-align:center; margin-top:10px; font-family:var(--font-mono); font-size:12px; color:var(--text-soft);">Limpar filtros</a>
          <?php endif; ?>
        </form>
      </aside>

      <div>
        <div class="results-toolbar reveal">
          <span><?= count($imoveis) ?> casa<?= count($imoveis) === 1 ? '' : 's' ?> encontrada<?= count($imoveis) === 1 ? '' : 's' ?></span>
        </div>

        <?php if (empty($imoveis)): ?>
          <div class="empty-state reveal">
            <h3>Nenhuma casa encontrada</h3>
            <p>Tente ajustar os filtros ou <a href="casas.php" style="color:var(--clay);">limpar a busca</a>.</p>
          </div>
        <?php else: ?>
          <div class="imoveis-grid stagger">
            <?php foreach ($imoveis as $imovel): render_card_imovel($imovel); endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
