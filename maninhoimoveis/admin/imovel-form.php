<?php
require_once __DIR__ . '/includes/admin-auth.php';
exigir_login_admin();
require_once __DIR__ . '/../includes/dados-imoveis.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$imovel = $id ? get_imovel($id) : null;

if ($id && !$imovel) {
    header('Location: imoveis.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';

    $comum = [
        'tipo'      => $tipo,
        'titulo'    => trim($_POST['titulo'] ?? ''),
        'bairro'    => trim($_POST['bairro'] ?? ''),
        'valor'     => (int) preg_replace('/\D/', '', $_POST['valor'] ?? '0'),
        'status'    => $_POST['status'] ?? 'disponivel',
        'descricao' => trim($_POST['descricao'] ?? ''),
    ];

    switch ($tipo) {
        case 'loteamento':
            $dados = $comum + [
                'metragem'      => (int) ($_POST['metragem'] ?? 0),
                'topografia'    => $_POST['topografia'] ?? 'Plano',
                'orientacao'    => trim($_POST['orientacao'] ?? ''),
                'financiamento' => ($_POST['financiamento'] ?? 'nao') === 'sim',
            ];
            break;

        case 'apartamento':
            $dados = $comum + [
                'metragem'       => (int) ($_POST['metragem'] ?? 0),
                'quartos'        => (int) ($_POST['quartos'] ?? 0),
                'banheiros'      => (int) ($_POST['banheiros'] ?? 0),
                'andar'          => (int) ($_POST['andar'] ?? 0),
                'sacada'         => ($_POST['sacada'] ?? 'nao') === 'sim',
                'garagem'        => ($_POST['garagem'] ?? 'nao') === 'sim',
                'infraestrutura' => trim($_POST['infraestrutura'] ?? ''),
            ];
            break;

        case 'casa':
            $dados = $comum + [
                'terreno'    => (int) ($_POST['terreno'] ?? 0),
                'quartos'    => (int) ($_POST['quartos'] ?? 0),
                'banheiros'  => (int) ($_POST['banheiros'] ?? 0),
                'pavimentos' => (int) ($_POST['pavimentos'] ?? 1),
                'garagem'    => (int) ($_POST['garagem'] ?? 0),
                'cerca'      => ($_POST['cerca'] ?? 'nao') === 'sim',
                'piscina'    => ($_POST['piscina'] ?? 'nao') === 'sim',
                'patio'      => ($_POST['patio'] ?? 'nao') === 'sim',
            ];
            break;

        default:
            $dados = null;
    }

    if ($dados && $comum['titulo'] !== '' && $comum['bairro'] !== '') {
        criar_ou_atualizar_imovel($id, $dados);
        header('Location: imoveis.php?sucesso=imovel-salvo');
        exit;
    }

    $erro = 'Preencha ao menos o tipo, título e bairro do imóvel.';
}

$page_title   = $imovel ? 'Editar Imóvel' : 'Novo Imóvel';
$active_admin = 'imoveis';
require_once __DIR__ . '/includes/admin-header.php';

// Valor exibido no campo (sem o imóvel ainda, ou com os dados atuais)
$v = fn($campo, $padrao = '') => htmlspecialchars($imovel[$campo] ?? $padrao);
$tipoAtual = $imovel['tipo'] ?? '';
?>

<div class="container admin-fade-in" style="max-width: 760px;">
    <div class="section-head">
      <h2><?= $imovel ? 'Editar imóvel' : 'Novo imóvel' ?></h2>
    </div>

    <div class="form-card">
      <?php if ($erro): ?>
        <p style="color:var(--clay); font-size:13.5px; margin-bottom: var(--space-2);"><?= htmlspecialchars($erro) ?></p>
      <?php endif; ?>

      <form method="post" action="imovel-form.php<?= $id ? '?id=' . $id : '' ?>" id="form-imovel">

        <div class="form-grid">
          <div class="form-field">
            <label for="tipo">Tipo de imóvel</label>
            <select id="tipo" name="tipo" required <?= $imovel ? 'disabled' : '' ?> onchange="mostrarCamposPorTipo()">
              <option value="">Selecione</option>
              <option value="loteamento" <?= $tipoAtual === 'loteamento' ? 'selected' : '' ?>>Loteamento / Terreno</option>
              <option value="apartamento" <?= $tipoAtual === 'apartamento' ? 'selected' : '' ?>>Apartamento</option>
              <option value="casa" <?= $tipoAtual === 'casa' ? 'selected' : '' ?>>Casa</option>
            </select>
            <?php if ($imovel): ?>
              <input type="hidden" name="tipo" value="<?= htmlspecialchars($tipoAtual) ?>">
            <?php endif; ?>
          </div>

          <div class="form-field">
            <label for="status">Status</label>
            <select id="status" name="status">
              <option value="disponivel" <?= ($imovel['status'] ?? 'disponivel') === 'disponivel' ? 'selected' : '' ?>>Disponível</option>
              <option value="reservado" <?= ($imovel['status'] ?? '') === 'reservado' ? 'selected' : '' ?>>Reservado</option>
              <option value="vendido" <?= ($imovel['status'] ?? '') === 'vendido' ? 'selected' : '' ?>>Vendido</option>
            </select>
          </div>

          <div class="form-field full">
            <label for="titulo">Título do anúncio</label>
            <input type="text" id="titulo" name="titulo" value="<?= $v('titulo') ?>" placeholder="Ex: Terreno Loteamento Vista Verde" required>
          </div>

          <div class="form-field">
            <label for="bairro">Bairro</label>
            <input type="text" id="bairro" name="bairro" value="<?= $v('bairro') ?>" required>
          </div>

          <div class="form-field">
            <label for="valor">Valor (R$)</label>
            <input type="text" id="valor" name="valor" value="<?= $v('valor') ?>" placeholder="Ex: 185000" required>
          </div>

          <!-- ---------------- CAMPOS: LOTEAMENTO ---------------- -->
          <div data-campos="loteamento" class="form-field" style="display:none;">
            <label for="metragem-lote">Metragem (m²)</label>
            <input type="number" id="metragem-lote" name="metragem" value="<?= $v('metragem') ?>">
          </div>
          <div data-campos="loteamento" class="form-field" style="display:none;">
            <label for="topografia">Topografia</label>
            <select id="topografia" name="topografia">
              <option value="Plano" <?= ($imovel['topografia'] ?? '') === 'Plano' ? 'selected' : '' ?>>Plano</option>
              <option value="Aclive" <?= ($imovel['topografia'] ?? '') === 'Aclive' ? 'selected' : '' ?>>Aclive</option>
              <option value="Declive" <?= ($imovel['topografia'] ?? '') === 'Declive' ? 'selected' : '' ?>>Declive</option>
            </select>
          </div>
          <div data-campos="loteamento" class="form-field" style="display:none;">
            <label for="orientacao">Orientação solar (face)</label>
            <input type="text" id="orientacao" name="orientacao" value="<?= $v('orientacao') ?>" placeholder="Ex: Norte">
          </div>
          <div data-campos="loteamento" class="form-field" style="display:none;">
            <label for="financiamento">Financiamento direto</label>
            <select id="financiamento" name="financiamento">
              <option value="nao" <?= empty($imovel['financiamento']) ? 'selected' : '' ?>>Não</option>
              <option value="sim" <?= !empty($imovel['financiamento']) ? 'selected' : '' ?>>Sim</option>
            </select>
          </div>

          <!-- ---------------- CAMPOS: APARTAMENTO ---------------- -->
          <div data-campos="apartamento" class="form-field" style="display:none;">
            <label for="metragem-apto">Tamanho (m²)</label>
            <input type="number" id="metragem-apto" name="metragem" value="<?= $v('metragem') ?>">
          </div>
          <div data-campos="apartamento" class="form-field" style="display:none;">
            <label for="quartos-apto">Quartos</label>
            <input type="number" id="quartos-apto" name="quartos" value="<?= $v('quartos') ?>">
          </div>
          <div data-campos="apartamento" class="form-field" style="display:none;">
            <label for="banheiros-apto">Banheiros</label>
            <input type="number" id="banheiros-apto" name="banheiros" value="<?= $v('banheiros') ?>">
          </div>
          <div data-campos="apartamento" class="form-field" style="display:none;">
            <label for="andar">Andar</label>
            <input type="number" id="andar" name="andar" value="<?= $v('andar') ?>">
          </div>
          <div data-campos="apartamento" class="form-field" style="display:none;">
            <label for="sacada">Sacada</label>
            <select id="sacada" name="sacada">
              <option value="nao" <?= empty($imovel['sacada']) ? 'selected' : '' ?>>Não</option>
              <option value="sim" <?= !empty($imovel['sacada']) ? 'selected' : '' ?>>Sim</option>
            </select>
          </div>
          <div data-campos="apartamento" class="form-field" style="display:none;">
            <label for="garagem-apto">Garagem</label>
            <select id="garagem-apto" name="garagem">
              <option value="nao" <?= empty($imovel['garagem']) ? 'selected' : '' ?>>Não</option>
              <option value="sim" <?= !empty($imovel['garagem']) ? 'selected' : '' ?>>Sim</option>
            </select>
          </div>
          <div data-campos="apartamento" class="form-field full" style="display:none;">
            <label for="infraestrutura">Infraestrutura do prédio</label>
            <input type="text" id="infraestrutura" name="infraestrutura" value="<?= $v('infraestrutura') ?>" placeholder="Ex: Elevador, salão de festas">
          </div>

          <!-- ---------------- CAMPOS: CASA ---------------- -->
          <div data-campos="casa" class="form-field" style="display:none;">
            <label for="terreno">Tamanho do terreno (m²)</label>
            <input type="number" id="terreno" name="terreno" value="<?= $v('terreno') ?>">
          </div>
          <div data-campos="casa" class="form-field" style="display:none;">
            <label for="quartos-casa">Quartos</label>
            <input type="number" id="quartos-casa" name="quartos" value="<?= $v('quartos') ?>">
          </div>
          <div data-campos="casa" class="form-field" style="display:none;">
            <label for="banheiros-casa">Banheiros</label>
            <input type="number" id="banheiros-casa" name="banheiros" value="<?= $v('banheiros') ?>">
          </div>
          <div data-campos="casa" class="form-field" style="display:none;">
            <label for="pavimentos">Pavimentos</label>
            <select id="pavimentos" name="pavimentos">
              <option value="1" <?= (int)($imovel['pavimentos'] ?? 1) === 1 ? 'selected' : '' ?>>Térrea (1)</option>
              <option value="2" <?= (int)($imovel['pavimentos'] ?? 0) === 2 ? 'selected' : '' ?>>2 pavimentos</option>
              <option value="3" <?= (int)($imovel['pavimentos'] ?? 0) === 3 ? 'selected' : '' ?>>3 pavimentos</option>
            </select>
          </div>
          <div data-campos="casa" class="form-field" style="display:none;">
            <label for="garagem-casa">Garagem (carros)</label>
            <select id="garagem-casa" name="garagem">
              <option value="0" <?= (int)($imovel['garagem'] ?? -1) === 0 ? 'selected' : '' ?>>Sem garagem</option>
              <option value="1" <?= (int)($imovel['garagem'] ?? 0) === 1 ? 'selected' : '' ?>>1 carro</option>
              <option value="2" <?= (int)($imovel['garagem'] ?? 0) === 2 ? 'selected' : '' ?>>2 carros</option>
            </select>
          </div>
          <div data-campos="casa" class="form-field" style="display:none;">
            <label for="cerca">Cerca</label>
            <select id="cerca" name="cerca">
              <option value="nao" <?= empty($imovel['cerca']) ? 'selected' : '' ?>>Não</option>
              <option value="sim" <?= !empty($imovel['cerca']) ? 'selected' : '' ?>>Sim</option>
            </select>
          </div>
          <div data-campos="casa" class="form-field" style="display:none;">
            <label for="piscina">Piscina</label>
            <select id="piscina" name="piscina">
              <option value="nao" <?= empty($imovel['piscina']) ? 'selected' : '' ?>>Não</option>
              <option value="sim" <?= !empty($imovel['piscina']) ? 'selected' : '' ?>>Sim</option>
            </select>
          </div>
          <div data-campos="casa" class="form-field" style="display:none;">
            <label for="patio">Pátio</label>
            <select id="patio" name="patio">
              <option value="nao" <?= empty($imovel['patio']) ? 'selected' : '' ?>>Não</option>
              <option value="sim" <?= !empty($imovel['patio']) ? 'selected' : '' ?>>Sim</option>
            </select>
          </div>

          <div class="form-field full">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao"><?= $v('descricao') ?></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-clay"><?= $imovel ? 'Salvar alterações' : 'Cadastrar imóvel' ?></button>
        <a href="imoveis.php" class="btn btn-outline" style="color:var(--ink); border-color:var(--line); margin-top:10px;">Cancelar</a>
      </form>
    </div>
  </div>
</div>

<script>
  function mostrarCamposPorTipo() {
    var select = document.getElementById('tipo');
    var tipo = select ? select.value : '<?= $tipoAtual ?>';
    document.querySelectorAll('[data-campos]').forEach(function (campo) {
      campo.style.display = campo.getAttribute('data-campos') === tipo ? 'block' : 'none';
    });
  }
  // Mostra os campos certos já ao carregar a página (novo cadastro ou edição)
  document.addEventListener('DOMContentLoaded', mostrarCamposPorTipo);
</script>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
