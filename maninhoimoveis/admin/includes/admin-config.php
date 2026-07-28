<?php
/**
 * Credenciais do painel administrativo.
 *
 * IMPORTANTE: troque a senha assim que possível.
 * Usuário padrão: maninho
 * Senha padrão:   trocaressasenha123
 *
 * Para trocar a senha, gere um novo hash rodando no terminal:
 *   php -r "echo password_hash('SUA_NOVA_SENHA', PASSWORD_DEFAULT);"
 * e cole o resultado em ADMIN_SENHA_HASH abaixo.
 */

define('ADMIN_USUARIO', 'maninho');
define('ADMIN_SENHA_HASH', '$2y$10$D7zZGiRlbp1dJjQQ.YhhlecGrmH6ywotZsv03jkyAPMP6WZSX4fQa');
