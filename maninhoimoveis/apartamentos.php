<?php
require_once __DIR__ . '/includes/dados-imoveis.php';

$page_title  = 'Apartamentos';
$active_page = 'apartamentos';

$f_quartos  = $_GET['quartos'] ?? '';
$f_sacada   = $_GET['sacada'] ?? '';
$f_garagem  = $_GET['garagem'] ?? '';
$f_valor    = trim($_GET['valor'] ?? '');

$imoveis = get_imoveis_por_tipo('apartamento');

$imoveis = array_filter($imoveis, function ($im) use ($f_quartos, $f_sacada, $f_garagem, $f_valor) {
    if ($f_quartos !== '' && (int)$f_quartos !== (int)$im['quartos']) return false;
    if ($f_sacada === 'sim' && !$im['sacada']) return false;
    if ($f_garagem === 'sim' && !$im['garagem']) return false;
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
    <span class="breadcrumb"><a href="index.php">Início</a> / <span>Apartamentos</span></span>
    <h1>Apartamentos</h1>
    <p>Compare quartos, andar, sacada e a infraestrutura do prédio antes de agendar sua visita.</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="listing-layout">

      <aside class="filter-panel">
        <h3>Filtrar apartamentos</h3>
        <form method="get" action="apartamentos.php">
          <div class="filter-group">
            <label for="quartos">Quartos</label>
            <select id="quartos" name="quartos">
              <option value="" <?= $f_quartos === '' ? 'selected' : '' ?>>Qualquer</option>
              <option value="1" <?= $f_quartos === '1' ? 'selected' : '' ?>>1 quarto</option>
              <option value="2" <?= $f_quartos === '2' ? 'selected' : '' ?>>2 quartos</option>
              <option value="3" <?= $f_quartos === '3' ? 'selected' : '' ?>>3 quartos</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="sacada">Sacada</label>
            <select id="sacada" name="sacada">
              <option value="" <?= $f_sacada === '' ? 'selected' : '' ?>>Qualquer</option>
              <option value="sim" <?= $f_sacada === 'sim' ? 'selected' : '' ?>>Com sacada</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="garagem">Garagem</label>
            <select id="garagem" name="garagem">
              <option value="" <?= $f_garagem === '' ? 'selected' : '' ?>>Qualquer</option>
              <option value="sim" <?= $f_garagem === 'sim' ? 'selected' : '' ?>>Com garagem</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="valor">Valor máximo</label>
            <input type="text" id="valor" name="valor" placeholder="R$" value="<?= htmlspecialchars($f_valor) ?>">
          </div>
          <button type="submit" class="btn btn-clay" style="width:100%; justify-content:center;">Aplicar filtros</button>
          <?php if ($f_quartos || $f_sacada || $f_garagem || $f_valor): ?>
            <a href="apartamentos.php" style="display:block; text-align:center; margin-top:10px; font-family:var(--font-mono); font-size:12px; color:var(--text-soft);">Limpar filtros</a>
          <?php endif; ?>
        </form>
      </aside>

      <div>
        <div class="results-toolbar reveal">
          <span><?= count($imoveis) ?> apartamento<?= count($imoveis) === 1 ? '' : 's' ?> encontrado<?= count($imoveis) === 1 ? '' : 's' ?></span>
        </div>

        <?php if (empty($imoveis)): ?>
          <div class="empty-state reveal">
            <h3>Nenhum apartamento encontrado</h3>
            <p>Tente ajustar os filtros ou <a href="apartamentos.php" style="color:var(--clay);">limpar a busca</a>.</p>
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
