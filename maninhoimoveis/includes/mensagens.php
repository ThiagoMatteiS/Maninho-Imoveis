<?php
/**
 * Mensagens recebidas pelos formulários "Contato" e "Anuncie Conosco".
 * Agora vindas do banco de dados (tabela `mensagens`).
 */

require_once __DIR__ . '/db.php';

function carregar_mensagens(): array {
    $stmt = db()->query('SELECT * FROM mensagens ORDER BY id');
    $todas = [];
    foreach ($stmt->fetchAll() as $row) {
        $row['id']   = (int) $row['id'];
        $row['lida'] = (bool) $row['lida'];
        $row['data'] = $row['criado_em'];
        $todas[] = $row;
    }
    return $todas;
}

/** Adiciona uma nova mensagem. $dados deve conter ao menos 'tipo', 'nome', 'email'. */
function registrar_mensagem(array $dados): void {
    $stmt = db()->prepare(
        'INSERT INTO mensagens (tipo, nome, email, telefone, mensagem, tipo_imovel, bairro, valor, descricao)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        $dados['tipo'],
        $dados['nome'],
        $dados['email'],
        $dados['telefone'] ?? null,
        $dados['mensagem'] ?? null,
        $dados['tipo_imovel'] ?? null,
        $dados['bairro'] ?? null,
        $dados['valor'] ?? null,
        $dados['descricao'] ?? null,
    ]);
}

function marcar_mensagem_lida(int $id): void {
    $stmt = db()->prepare('UPDATE mensagens SET lida = 1 WHERE id = ?');
    $stmt->execute([$id]);
}

function excluir_mensagem(int $id): void {
    $stmt = db()->prepare('DELETE FROM mensagens WHERE id = ?');
    $stmt->execute([$id]);
}

function contar_mensagens_nao_lidas(): int {
    $stmt = db()->query('SELECT COUNT(*) FROM mensagens WHERE lida = 0');
    return (int) $stmt->fetchColumn();
}
