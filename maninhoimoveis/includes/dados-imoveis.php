<?php
/**
 * Dados dos imóveis — agora vindos do banco de dados MySQL/MariaDB.
 * As funções públicas (get_imoveis, get_imovel, etc.) continuam com a
 * mesma assinatura de antes, então nenhuma outra página do site precisou mudar.
 */

require_once __DIR__ . '/db.php';

/** Converte uma linha da tabela `imoveis` no formato de array que o site usa. */
function linha_para_imovel(array $row): array {
    $imovel = [
        'tipo'      => $row['tipo'],
        'titulo'    => $row['titulo'],
        'bairro'    => $row['bairro'],
        'valor'     => (int) $row['valor'],
        'status'    => $row['status'],
        'descricao' => $row['descricao'] ?? '',
    ];

    switch ($row['tipo']) {
        case 'loteamento':
            $imovel += [
                'metragem'      => (int) $row['metragem'],
                'topografia'    => $row['topografia'],
                'orientacao'    => $row['orientacao'],
                'financiamento' => (bool) $row['financiamento'],
            ];
            break;

        case 'apartamento':
            $imovel += [
                'metragem'       => (int) $row['metragem'],
                'quartos'        => (int) $row['quartos'],
                'banheiros'      => (int) $row['banheiros'],
                'andar'          => (int) $row['andar'],
                'sacada'         => (bool) $row['sacada'],
                'garagem'        => (bool) $row['garagem'],
                'infraestrutura' => $row['infraestrutura'] ?? '',
            ];
            break;

        case 'casa':
            $imovel += [
                'terreno'    => (int) $row['terreno'],
                'quartos'    => (int) $row['quartos'],
                'banheiros'  => (int) $row['banheiros'],
                'pavimentos' => (int) $row['pavimentos'],
                'garagem'    => (int) $row['garagem'],
                'cerca'      => (bool) $row['cerca'],
                'piscina'    => (bool) $row['piscina'],
                'patio'      => (bool) $row['patio'],
            ];
            break;
    }

    return $imovel;
}

function get_imoveis(): array {
    $stmt = db()->query('SELECT * FROM imoveis ORDER BY id');
    $resultado = [];
    foreach ($stmt->fetchAll() as $row) {
        $resultado[(int) $row['id']] = linha_para_imovel($row);
    }
    return $resultado;
}

function get_imovel(int $id): ?array {
    $stmt = db()->prepare('SELECT * FROM imoveis WHERE id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if (!$row) return null;

    $imovel = linha_para_imovel($row);
    $imovel['id'] = (int) $row['id'];
    return $imovel;
}

function get_imoveis_por_tipo(string $tipo): array {
    $stmt = db()->prepare('SELECT * FROM imoveis WHERE tipo = ? ORDER BY id DESC');
    $stmt->execute([$tipo]);

    $lista = [];
    foreach ($stmt->fetchAll() as $row) {
        $imovel = linha_para_imovel($row);
        $imovel['id'] = (int) $row['id'];
        $lista[] = $imovel;
    }
    return $lista;
}

/** Cria (se $id for null) ou atualiza um imóvel. Retorna o id salvo. */
function criar_ou_atualizar_imovel(?int $id, array $dados): int {
    $pdo = db();

    // Normaliza todos os campos possíveis: os que não se aplicam ao tipo ficam NULL.
    $campos = [
        'tipo'           => $dados['tipo'],
        'titulo'         => $dados['titulo'],
        'bairro'         => $dados['bairro'],
        'valor'          => (int) $dados['valor'],
        'status'         => $dados['status'],
        'descricao'      => $dados['descricao'] ?? '',
        'metragem'       => $dados['metragem'] ?? null,
        'topografia'     => $dados['topografia'] ?? null,
        'orientacao'     => $dados['orientacao'] ?? null,
        'financiamento'  => array_key_exists('financiamento', $dados) ? (int) $dados['financiamento'] : null,
        'quartos'        => $dados['quartos'] ?? null,
        'banheiros'      => $dados['banheiros'] ?? null,
        'andar'          => $dados['andar'] ?? null,
        'sacada'         => array_key_exists('sacada', $dados) ? (int) $dados['sacada'] : null,
        'garagem'        => array_key_exists('garagem', $dados) ? (int) $dados['garagem'] : null,
        'infraestrutura' => $dados['infraestrutura'] ?? null,
        'terreno'        => $dados['terreno'] ?? null,
        'pavimentos'     => $dados['pavimentos'] ?? null,
        'cerca'          => array_key_exists('cerca', $dados) ? (int) $dados['cerca'] : null,
        'piscina'        => array_key_exists('piscina', $dados) ? (int) $dados['piscina'] : null,
        'patio'          => array_key_exists('patio', $dados) ? (int) $dados['patio'] : null,
    ];

    if ($id === null) {
        $colunas     = implode(', ', array_keys($campos));
        $marcadores  = implode(', ', array_fill(0, count($campos), '?'));
        $stmt = $pdo->prepare("INSERT INTO imoveis ($colunas) VALUES ($marcadores)");
        $stmt->execute(array_values($campos));
        return (int) $pdo->lastInsertId();
    }

    $sets = implode(', ', array_map(fn($coluna) => "$coluna = ?", array_keys($campos)));
    $stmt = $pdo->prepare("UPDATE imoveis SET $sets WHERE id = ?");
    $stmt->execute([...array_values($campos), $id]);
    return $id;
}

function excluir_imovel(int $id): void {
    $stmt = db()->prepare('DELETE FROM imoveis WHERE id = ?');
    $stmt->execute([$id]);
}

function atualizar_status_imovel(int $id, string $status): void {
    $stmt = db()->prepare('UPDATE imoveis SET status = ? WHERE id = ?');
    $stmt->execute([$status, $id]);
}

function formatar_valor(int $valor): string {
    return number_format($valor, 0, ',', '.');
}

function rotulo_status(string $status): array {
    // retorna [texto, classe-css]
    switch ($status) {
        case 'reservado': return ['Reservado', 'status-reservado'];
        case 'vendido':   return ['Vendido', 'status-vendido'];
        default:          return ['Disponível', 'status-disponivel'];
    }
}

function rotulo_tipo(string $tipo): string {
    switch ($tipo) {
        case 'loteamento':  return 'Terreno';
        case 'apartamento': return 'Apartamento';
        case 'casa':        return 'Casa';
        default:            return ucfirst($tipo);
    }
}

/** Ilustração de miniatura em traço, no mesmo estilo dos cards da Home */
function thumb_svg_por_tipo(string $tipo): string {
    switch ($tipo) {
        case 'apartamento':
            return '<rect x="90" y="30" width="120" height="165" fill="none" stroke="#1B2A3B" stroke-width="1.4"/>
                    <path d="M90 65h120M90 100h120M90 135h120M90 170h120" stroke="#1B2A3B" stroke-width="1"/>';
        case 'casa':
            return '<path d="M60 120 L150 60 L240 120" fill="none" stroke="#4C6B4F" stroke-width="1.4"/>
                    <rect x="75" y="120" width="150" height="80" fill="none" stroke="#1B2A3B" stroke-width="1.4"/>
                    <circle cx="205" cy="175" r="14" fill="none" stroke="#B5482D" stroke-width="1.2"/>';
        default: // loteamento
            return '<path d="M20 190 L150 90 L280 190 Z" fill="none" stroke="#B5482D" stroke-width="1.4" stroke-dasharray="5 4"/>
                    <line x1="150" y1="90" x2="150" y2="190" stroke="#4C6B4F" stroke-width="1.4" stroke-dasharray="3 3"/>';
    }
}

/** Monta os atributos curtos exibidos no card (m², quartos, etc.) conforme o tipo */
function atributos_curtos(array $imovel): array {
    switch ($imovel['tipo']) {
        case 'apartamento':
            return [
                $imovel['metragem'] . ' m²',
                $imovel['quartos'] . ($imovel['quartos'] > 1 ? ' quartos' : ' quarto'),
                $imovel['sacada'] ? 'Sacada' : 'Sem sacada',
                $imovel['garagem'] ? '1 vaga' : 'Sem garagem',
            ];
        case 'casa':
            return [
                $imovel['quartos'] . ($imovel['quartos'] > 1 ? ' quartos' : ' quarto'),
                $imovel['pavimentos'] . ($imovel['pavimentos'] > 1 ? ' pavim.' : ' pavim.'),
                $imovel['piscina'] ? 'Piscina' : 'Sem piscina',
                $imovel['garagem'] . ' vaga' . ($imovel['garagem'] > 1 ? 's' : ''),
            ];
        default: // loteamento
            return [
                $imovel['metragem'] . ' m²',
                $imovel['topografia'],
                'Face ' . $imovel['orientacao'],
            ];
    }
}

/** Card de imóvel para o painel administrativo (editar / remover / status) — mesmas classes do site público */
function render_card_imovel_admin(array $imovel): void {
    [$statusTexto, ] = rotulo_status($imovel['status']);
    ?>
    <article class="imovel-card">
      <div class="imovel-thumb">
        <span class="imovel-tag"><?= htmlspecialchars(rotulo_tipo($imovel['tipo'])) ?></span>
        <svg viewBox="0 0 300 225" preserveAspectRatio="none">
          <rect width="300" height="225" fill="#E9E1CC"/>
          <?= thumb_svg_por_tipo($imovel['tipo']) ?>
        </svg>
      </div>
      <div class="imovel-body">
        <h4><?= htmlspecialchars($imovel['titulo']) ?></h4>
        <p class="local">Bairro <?= htmlspecialchars($imovel['bairro']) ?> · Cód. <?= (int)$imovel['id'] ?></p>

        <div class="imovel-attrs">
          <?php $attrs = atributos_curtos($imovel); foreach ($attrs as $i => $a): ?>
            <span><?= htmlspecialchars($a) ?></span><?php if ($i < count($attrs) - 1): ?><span>·</span><?php endif; ?>
          <?php endforeach; ?>
        </div>

        <div class="filter-group">
          <label for="status-<?= (int)$imovel['id'] ?>">Status</label>
          <form method="post" action="atualizar-status.php">
            <input type="hidden" name="id" value="<?= (int)$imovel['id'] ?>">
            <input type="hidden" name="voltar" value="imoveis.php">
            <select id="status-<?= (int)$imovel['id'] ?>" name="status" onchange="this.form.submit()">
              <option value="disponivel" <?= $imovel['status'] === 'disponivel' ? 'selected' : '' ?>>Disponível</option>
              <option value="reservado" <?= $imovel['status'] === 'reservado' ? 'selected' : '' ?>>Reservado</option>
              <option value="vendido" <?= $imovel['status'] === 'vendido' ? 'selected' : '' ?>>Vendido</option>
            </select>
          </form>
        </div>

        <div class="imovel-footer">
          <div class="imovel-valor"><small>VALOR</small>R$ <?= formatar_valor((int)$imovel['valor']) ?></div>
          <a href="imovel-form.php?id=<?= (int)$imovel['id'] ?>" class="btn btn-outline" style="color:var(--ink); border-color:var(--line);">Editar</a>
        </div>

        <form method="post" action="excluir-imovel.php" style="margin-top:10px;" onsubmit="return confirm('Remover este imóvel permanentemente?');">
          <input type="hidden" name="id" value="<?= (int)$imovel['id'] ?>">
          <button type="submit" class="btn btn-outline" style="width:100%; justify-content:center; color:var(--clay); border-color:var(--clay);">Remover</button>
        </form>
      </div>
    </article>
    <?php
}
function render_card_imovel(array $imovel): void {
    [$statusTexto, $statusClasse] = rotulo_status($imovel['status']);
    $bloqueado = $imovel['status'] !== 'disponivel';
    ?>
    <article class="imovel-card reveal">
      <div class="imovel-thumb">
        <span class="imovel-tag <?= $imovel['status'] !== 'disponivel' ? $statusClasse : '' ?>">
          <?= $imovel['status'] !== 'disponivel' ? htmlspecialchars($statusTexto) : htmlspecialchars(rotulo_tipo($imovel['tipo'])) ?>
        </span>
        <button class="fav-btn" aria-label="Favoritar imóvel" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s-7.5-4.7-10-9.3C.4 8.6 2 5 5.5 5c2 0 3.3 1 4.5 2.6C11.2 6 12.5 5 14.5 5 18 5 19.6 8.6 22 11.7 19.5 16.3 12 21 12 21z"/></svg>
        </button>
        <svg viewBox="0 0 300 225" preserveAspectRatio="none">
          <rect width="300" height="225" fill="#E9E1CC"/>
          <?= thumb_svg_por_tipo($imovel['tipo']) ?>
        </svg>
      </div>
      <div class="imovel-body">
        <h4><?= htmlspecialchars($imovel['titulo']) ?></h4>
        <p class="local">Bairro <?= htmlspecialchars($imovel['bairro']) ?></p>
        <div class="imovel-attrs">
          <?php $attrs = atributos_curtos($imovel); foreach ($attrs as $i => $a): ?>
            <span><?= htmlspecialchars($a) ?></span><?php if ($i < count($attrs) - 1): ?><span>·</span><?php endif; ?>
          <?php endforeach; ?>
        </div>
        <div class="imovel-footer">
          <div class="imovel-valor" data-final="<?= (int)$imovel['valor'] ?>">
            <small><?= $imovel['tipo'] === 'loteamento' && $imovel['financiamento'] ? 'À VISTA OU FINANCIADO' : 'VALOR' ?></small>
            R$ <span class="valor-num">0</span>
          </div>
          <a href="imovel.php?id=<?= (int)$imovel['id'] ?>" class="btn btn-outline" style="color:var(--ink); border-color:var(--line);">Ver detalhes</a>
        </div>
      </div>
    </article>
    <?php
}
