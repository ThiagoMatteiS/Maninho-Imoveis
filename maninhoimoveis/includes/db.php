<?php
/**
 * Conexão com o banco de dados.
 * Ajuste esses 4 valores conforme o seu servidor:
 *  - No XAMPP/WAMP local, normalmente é: host=localhost, usuário=root, senha="" (vazia)
 *  - Numa hospedagem real, esses dados ficam no painel (cPanel > MySQL Databases)
 */

define('DB_HOST', 'localhost');
define('DB_NOME', 'maninho_imoveis');
define('DB_USUARIO', 'root');
define('DB_SENHA', '');

/** Retorna a conexão PDO (cria uma vez só e reaproveita). */
function db(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NOME . ';charset=utf8mb4';
        try {
            $pdo = new PDO($dsn, DB_USUARIO, DB_SENHA, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            // Erro de conexão custa caro em produção mostrar detalhes ao público;
            // aqui deixamos visível para facilitar o ajuste durante a instalação.
            die(
                'Não foi possível conectar ao banco de dados. ' .
                'Confira DB_HOST, DB_NOME, DB_USUARIO e DB_SENHA em includes/db.php. ' .
                'Detalhe técnico: ' . htmlspecialchars($e->getMessage())
            );
        }
    }

    return $pdo;
}
