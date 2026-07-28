<?php
require_once __DIR__ . '/includes/mensagens.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome !== '' && $email !== '' && $mensagem !== '') {
        registrar_mensagem([
            'tipo'     => 'contato',
            'nome'     => $nome,
            'telefone' => $telefone,
            'email'    => $email,
            'mensagem' => $mensagem,
        ]);
        header('Location: contato.php?enviado=1');
        exit;
    }
}

header('Location: contato.php?erro=1');
exit;
