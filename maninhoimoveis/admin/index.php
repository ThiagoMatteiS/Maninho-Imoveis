<?php
require_once __DIR__ . '/includes/admin-auth.php';
exigir_login_admin();
require_once __DIR__ . '/../includes/dados-imoveis.php';
require_once __DIR__ . '/../includes/mensagens.php';

$page_title   = 'Dashboard';
$active_admin = 'dashboard';

$todos = get_imoveis();
$totais = ['disponivel' => 0, 'reservado' => 0, 'vendido' => 0];
foreach ($todos as $im) {
    $totais[$im['status']] = ($totais[$im['status']] ?? 0) + 1;
}
$mensagens = carregar_mensagens();
$naoLidasAnuncio = count(array_filter($mensagens, fn($m) => $m['tipo'] === 'anuncio' && empty($m['lida'])));
$naoLidasContato = count(array_filter($mensagens, fn($m) => $m['tipo'] === 'contato' && empty($m['lida'])));

require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="container">
  <div class="section-head admin-fade-in">
    <h2>Visão geral</h2>
  </div>

  <div class="admin-stats-grid">
    <div class="admin-stat-card --total admin-fade-in --d1">
      <div class="rotulo">Total de imóveis</div>
      <div class="numero"><?= count($todos) ?></div>
    </div>
    <div class="admin-stat-card --disponivel admin-fade-in --d2">
      <div class="rotulo">Disponíveis</div>
      <div class="numero"><?= $totais['disponivel'] ?></div>
    </div>
    <div class="admin-stat-card --reservado admin-fade-in --d3">
      <div class="rotulo">Reservados</div>
      <div class="numero"><?= $totais['reservado'] ?></div>
    </div>
    <div class="admin-stat-card --vendido admin-fade-in --d4">
      <div class="rotulo">Vendidos</div>
      <div class="numero"><?= $totais['vendido'] ?></div>
    </div>
    <div class="admin-stat-card --mensagens admin-fade-in --d3">
      <div class="rotulo">Anúncios não lidos</div>
      <div class="numero"><?= $naoLidasAnuncio ?></div>
    </div>
    <div class="admin-stat-card --mensagens admin-fade-in --d4">
      <div class="rotulo">Contatos não lidos</div>
      <div class="numero"><?= $naoLidasContato ?></div>
    </div>
  </div>

  <div class="admin-actions-row admin-fade-in --d4">
    <a href="imovel-form.php" class="btn btn-clay">+ Novo imóvel</a>
    <a href="imoveis.php" class="btn btn-outline" style="color:var(--ink); border-color:var(--line);">Gerenciar imóveis</a>
    <a href="mensagens.php" class="btn btn-outline" style="color:var(--ink); border-color:var(--line);">Ver mensagens</a>
  </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
