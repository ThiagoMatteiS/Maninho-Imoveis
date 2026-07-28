<?php
require_once __DIR__ . '/includes/dados-imoveis.php';

$page_title  = 'Loteamentos e Terrenos';
$active_page = 'loteamentos';

// --- Filtros (via GET) ---
$f_bairro      = trim($_GET['bairro'] ?? '');
$f_metragem    = $_GET['metragem'] ?? '';
$f_topografia  = $_GET['topografia'] ?? '';
$f_valor       = trim($_GET['valor'] ?? '');

$imoveis = get_imoveis_por_tipo('loteamento');

$imoveis = array_filter($imoveis, function ($im) use ($f_bairro, $f_metragem, $f_topografia, $f_valor) {
    if ($f_bairro !== '' && stripos($im['bairro'], $f_bairro) === false) return false;

    if ($f_metragem !== '') {
        if ($f_metragem === '0-200' && !($im['metragem'] <= 200)) return false;
        if ($f_metragem === '200-400' && !($im['metragem'] > 200 && $im['metragem'] <= 400)) return false;
        if ($f_metragem === '400+' && !($im['metragem'] > 400)) return false;
    }

    if ($f_topografia !== '' && strtolower($im['topografia']) !== strtolower($f_topografia)) return false;

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
    <span class="breadcrumb"><a href="index.php">Início</a> / <span>Loteamentos</span></span>
    <h1>Loteamentos e Terrenos</h1>
    <p>Filtre por bairro, metragem e topografia para encontrar o terreno certo para o seu projeto.</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="listing-layout">

      <aside class="filter-panel">
        <h3>Filtrar terrenos</h3>
        <form method="get" action="loteamentos.php">
          <div class="filter-group">
            <label for="bairro">Bairro</label>
            <input type="text" id="bairro" name="bairro" placeholder="Ex: Centro" value="<?= htmlspecialchars($f_bairro) ?>">
          </div>
          <div class="filter-group">
            <label for="metragem">Metragem (m²)</label>
            <select id="metragem" name="metragem">
              <option value="" <?= $f_metragem === '' ? 'selected' : '' ?>>Qualquer</option>
              <option value="0-200" <?= $f_metragem === '0-200' ? 'selected' : '' ?>>Até 200 m²</option>
              <option value="200-400" <?= $f_metragem === '200-400' ? 'selected' : '' ?>>200 a 400 m²</option>
              <option value="400+" <?= $f_metragem === '400+' ? 'selected' : '' ?>>Acima de 400 m²</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="topografia">Topografia</label>
            <select id="topografia" name="topografia">
              <option value="" <?= $f_topografia === '' ? 'selected' : '' ?>>Qualquer</option>
              <option value="Plano" <?= $f_topografia === 'Plano' ? 'selected' : '' ?>>Plano</option>
              <option value="Aclive" <?= $f_topografia === 'Aclive' ? 'selected' : '' ?>>Aclive</option>
              <option value="Declive" <?= $f_topografia === 'Declive' ? 'selected' : '' ?>>Declive</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="valor">Valor máximo</label>
            <input type="text" id="valor" name="valor" placeholder="R$" value="<?= htmlspecialchars($f_valor) ?>">
          </div>
          <button type="submit" class="btn btn-clay" style="width:100%; justify-content:center;">Aplicar filtros</button>
          <?php if ($f_bairro || $f_metragem || $f_topografia || $f_valor): ?>
            <a href="loteamentos.php" style="display:block; text-align:center; margin-top:10px; font-family:var(--font-mono); font-size:12px; color:var(--text-soft);">Limpar filtros</a>
          <?php endif; ?>
        </form>
      </aside>

      <div>
        <div class="results-toolbar reveal">
          <span><?= count($imoveis) ?> terreno<?= count($imoveis) === 1 ? '' : 's' ?> encontrado<?= count($imoveis) === 1 ? '' : 's' ?></span>
        </div>

        <?php if (empty($imoveis)): ?>
          <div class="empty-state reveal">
            <h3>Nenhum terreno encontrado</h3>
            <p>Tente ajustar os filtros ou <a href="loteamentos.php" style="color:var(--clay);">limpar a busca</a>.</p>
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
