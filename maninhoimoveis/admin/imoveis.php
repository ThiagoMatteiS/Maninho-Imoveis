<?php
require_once __DIR__ . '/includes/admin-auth.php';
exigir_login_admin();
require_once __DIR__ . '/../includes/dados-imoveis.php';

$page_title   = 'Gestão de Imóveis';
$active_admin = 'imoveis';

$f_tipo   = $_GET['tipo'] ?? '';
$f_status = $_GET['status'] ?? '';

$todos = get_imoveis();
$lista = [];
foreach ($todos as $id => $im) {
    $im['id'] = $id;
    if ($f_tipo !== '' && $im['tipo'] !== $f_tipo) continue;
    if ($f_status !== '' && $im['status'] !== $f_status) continue;
    $lista[] = $im;
}
// Mais recentes (maior id) primeiro
usort($lista, fn($a, $b) => $b['id'] <=> $a['id']);

require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="container">
    <div class="listing-layout">

      <aside class="filter-panel admin-fade-in">
        <h3>Filtrar imóveis</h3>
        <form method="get" action="imoveis.php">
          <div class="filter-group">
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo">
              <option value="" <?= $f_tipo === '' ? 'selected' : '' ?>>Todos</option>
              <option value="loteamento" <?= $f_tipo === 'loteamento' ? 'selected' : '' ?>>Loteamentos</option>
              <option value="apartamento" <?= $f_tipo === 'apartamento' ? 'selected' : '' ?>>Apartamentos</option>
              <option value="casa" <?= $f_tipo === 'casa' ? 'selected' : '' ?>>Casas</option>
            </select>
          </div>
          <div class="filter-group">
            <label for="status">Status</label>
            <select id="status" name="status">
              <option value="" <?= $f_status === '' ? 'selected' : '' ?>>Todos</option>
              <option value="disponivel" <?= $f_status === 'disponivel' ? 'selected' : '' ?>>Disponível</option>
              <option value="reservado" <?= $f_status === 'reservado' ? 'selected' : '' ?>>Reservado</option>
              <option value="vendido" <?= $f_status === 'vendido' ? 'selected' : '' ?>>Vendido</option>
            </select>
          </div>
          <button type="submit" class="btn btn-clay" style="width:100%; justify-content:center;">Filtrar</button>
        </form>

        <a href="imovel-form.php" class="btn btn-outline" style="width:100%; justify-content:center; color:var(--ink); border-color:var(--line); margin-top: var(--space-2);">+ Novo imóvel</a>
      </aside>

      <div class="admin-fade-in --d1">
        <div class="results-toolbar">
          <span><?= count($lista) ?> imóve<?= count($lista) === 1 ? 'l' : 'is' ?> encontrado<?= count($lista) === 1 ? '' : 's' ?></span>
        </div>

        <?php if (empty($lista)): ?>
          <div class="empty-state">
            <h3>Nenhum imóvel encontrado</h3>
            <p>Ajuste os filtros ou <a href="imovel-form.php" style="color:var(--clay);">cadastre um novo imóvel</a>.</p>
          </div>
        <?php else: ?>
          <div class="imoveis-grid">
            <?php foreach ($lista as $imovel): render_card_imovel_admin($imovel); endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
