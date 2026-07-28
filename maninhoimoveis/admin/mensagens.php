<?php
require_once __DIR__ . '/includes/admin-auth.php';
exigir_login_admin();
require_once __DIR__ . '/../includes/mensagens.php';

$page_title   = 'Mensagens';
$active_admin = 'mensagens';

$f_tipo = $_GET['tipo'] ?? ''; // '', 'contato', 'anuncio'

$todas = array_reverse(carregar_mensagens()); // mais recentes primeiro
if ($f_tipo !== '') {
    $todas = array_filter($todas, fn($m) => $m['tipo'] === $f_tipo);
}

require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="container">
  <div class="listing-layout">

    <aside class="filter-panel admin-fade-in">
      <h3>Filtrar mensagens</h3>
      <form method="get" action="mensagens.php">
        <div class="filter-group">
          <label for="tipo">Tipo</label>
          <select id="tipo" name="tipo" onchange="this.form.submit()">
            <option value="" <?= $f_tipo === '' ? 'selected' : '' ?>>Todas</option>
            <option value="contato" <?= $f_tipo === 'contato' ? 'selected' : '' ?>>Contato</option>
            <option value="anuncio" <?= $f_tipo === 'anuncio' ? 'selected' : '' ?>>Anuncie Conosco</option>
          </select>
        </div>
      </form>
    </aside>

    <div class="admin-fade-in --d1">
      <div class="results-toolbar">
        <span><?= count($todas) ?> mensage<?= count($todas) === 1 ? 'm' : 'ns' ?></span>
      </div>

      <?php if (empty($todas)): ?>
        <div class="empty-state">
          <h3>Nenhuma mensagem por aqui</h3>
          <p>As mensagens enviadas pelo site (Contato e Anuncie Conosco) aparecem nesta lista.</p>
        </div>
      <?php else: ?>

        <div style="display:grid; gap: var(--space-2);">
          <?php foreach ($todas as $m):
            $classeTipo = $m['tipo'] === 'anuncio' ? '--anuncio' : '--contato';
            $classeLida = empty($m['lida']) ? '' : '--lida';
          ?>
            <div class="admin-message-card <?= $classeTipo ?> <?= $classeLida ?>">

              <div class="admin-message-head">
                <div>
                  <span class="admin-message-tipo">
                    <?php if (empty($m['lida'])): ?><span class="ponto-nao-lida"></span><?php endif; ?>
                    <?= $m['tipo'] === 'anuncio' ? 'Anuncie Conosco' : 'Contato' ?>
                  </span>
                  <h4 class="admin-message-nome"><?= htmlspecialchars($m['nome']) ?></h4>
                  <p class="admin-message-contatos">
                    <?= htmlspecialchars($m['email']) ?><?= !empty($m['telefone']) ? ' · ' . htmlspecialchars($m['telefone']) : '' ?>
                  </p>
                </div>
                <span class="admin-message-data"><?= htmlspecialchars($m['data']) ?></span>
              </div>

              <div class="admin-message-body">
                <?php if ($m['tipo'] === 'anuncio'): ?>
                  <p style="margin:0 0 6px;"><strong>Tipo de imóvel:</strong> <?= htmlspecialchars($m['tipo_imovel'] ?? '') ?> · <strong>Bairro:</strong> <?= htmlspecialchars($m['bairro'] ?? '') ?><?= !empty($m['valor']) ? ' · <strong>Valor pretendido:</strong> R$ ' . htmlspecialchars($m['valor']) : '' ?></p>
                  <p style="margin:0; color:var(--text-soft);"><?= nl2br(htmlspecialchars($m['descricao'] ?? '')) ?></p>
                <?php else: ?>
                  <p style="margin:0; color:var(--text-soft);"><?= nl2br(htmlspecialchars($m['mensagem'] ?? '')) ?></p>
                <?php endif; ?>
              </div>

              <div class="admin-message-actions">
                <a href="<?= whatsapp_link_wa($m['telefone'] ?? '') ?>" class="btn btn-outline admin-btn-sm" style="color:var(--ink); border-color:var(--line);" target="_blank" rel="noopener">Responder no WhatsApp</a>
                <a href="mailto:<?= htmlspecialchars($m['email']) ?>" class="btn btn-outline admin-btn-sm" style="color:var(--ink); border-color:var(--line);">Responder por e-mail</a>

                <?php if (empty($m['lida'])): ?>
                  <form method="post" action="marcar-lida.php" style="margin-left:auto;">
                    <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                    <input type="hidden" name="tipo" value="<?= htmlspecialchars($f_tipo) ?>">
                    <button type="submit" class="btn btn-outline admin-btn-sm" style="color:var(--moss); border-color:var(--moss);">Marcar como lida</button>
                  </form>
                <?php endif; ?>

                <form method="post" action="excluir-mensagem.php" onsubmit="return confirm('Remover esta mensagem?');" <?= empty($m['lida']) ? '' : 'style="margin-left:auto;"' ?>>
                  <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                  <input type="hidden" name="tipo" value="<?= htmlspecialchars($f_tipo) ?>">
                  <button type="submit" class="btn btn-outline admin-btn-sm" style="color:var(--clay); border-color:var(--clay);">Excluir</button>
                </form>
              </div>

            </div>
          <?php endforeach; ?>
        </div>

      <?php endif; ?>
    </div>

  </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
