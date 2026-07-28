-- ============================================================
-- Maninho Imóveis — Schema do banco de dados
-- Rode este arquivo uma única vez (via phpMyAdmin > Importar,
-- ou pelo terminal: mysql -u root -p < schema.sql)
-- ============================================================

CREATE DATABASE IF NOT EXISTS maninho_imoveis
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE maninho_imoveis;

-- ------------------------------------------------------------
-- Tabela de imóveis
-- Guarda os 3 tipos (loteamento, apartamento, casa) na mesma
-- tabela; as colunas que não se aplicam a um tipo ficam NULL.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS imoveis (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    tipo           ENUM('loteamento','apartamento','casa') NOT NULL,
    titulo         VARCHAR(255) NOT NULL,
    bairro         VARCHAR(150) NOT NULL,
    valor          INT NOT NULL,
    status         ENUM('disponivel','reservado','vendido') NOT NULL DEFAULT 'disponivel',
    descricao      TEXT NULL,

    -- Loteamento
    metragem       INT NULL,
    topografia     VARCHAR(20) NULL,
    orientacao     VARCHAR(20) NULL,
    financiamento  TINYINT(1) NULL,

    -- Apartamento (reaproveita metragem acima) e Casa
    quartos        INT NULL,
    banheiros      INT NULL,
    andar          INT NULL,
    sacada         TINYINT(1) NULL,
    garagem        INT NULL, -- apartamento: 0/1 (tem ou não) · casa: 0, 1 ou 2 carros
    infraestrutura VARCHAR(255) NULL,

    -- Casa
    terreno        INT NULL,
    pavimentos     INT NULL,
    cerca          TINYINT(1) NULL,
    piscina        TINYINT(1) NULL,
    patio          TINYINT(1) NULL,

    criado_em      DATETIME DEFAULT CURRENT_TIMESTAMP,
    atualizado_em  DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabela de mensagens (Contato e Anuncie Conosco)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS mensagens (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    tipo        ENUM('contato','anuncio') NOT NULL,
    nome        VARCHAR(150) NOT NULL,
    email       VARCHAR(150) NOT NULL,
    telefone    VARCHAR(30) NULL,

    -- Contato
    mensagem    TEXT NULL,

    -- Anuncie Conosco
    tipo_imovel VARCHAR(30) NULL,
    bairro      VARCHAR(150) NULL,
    valor       VARCHAR(30) NULL,
    descricao   TEXT NULL,

    lida        TINYINT(1) NOT NULL DEFAULT 0,
    criado_em   DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabela de usuários do painel administrativo
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS admin_usuarios (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    usuario    VARCHAR(60) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    criado_em  DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Usuário padrão: maninho / trocaressasenha123
-- IMPORTANTE: troque a senha depois de importar (veja instruções no rodapé).
INSERT INTO admin_usuarios (usuario, senha_hash) VALUES
('maninho', '$2y$10$D7zZGiRlbp1dJjQQ.YhhlecGrmH6ywotZsv03jkyAPMP6WZSX4fQa');

-- ------------------------------------------------------------
-- Dados iniciais dos imóveis (os mesmos que já estavam no site)
-- ------------------------------------------------------------
INSERT INTO imoveis
    (id, tipo, titulo, bairro, valor, status, descricao, metragem, topografia, orientacao, financiamento)
VALUES
    (1, 'loteamento', 'Terreno Loteamento Vista Verde', 'Cinquentenário', 185000, 'disponivel',
     'Terreno plano, pronto para construir, em loteamento fechado com infraestrutura completa (água, luz, esgoto). Face norte, boa incidência de sol o dia todo.',
     360, 'Plano', 'Norte', 1),
    (4, 'loteamento', 'Terreno Loteamento Bela Vista', 'Bela Vista', 210000, 'disponivel',
     'Terreno em aclive suave, com vista privilegiada da região. Ótimo para projetos com subsolo ou garagem embaixo.',
     420, 'Aclive', 'Leste', 1),
    (5, 'loteamento', 'Terreno Recanto das Árvores', 'Recanto das Árvores', 155000, 'reservado',
     'Terreno em declive suave, rodeado de área verde, em rua tranquila e arborizada.',
     300, 'Declive', 'Norte', 0);

INSERT INTO imoveis
    (id, tipo, titulo, bairro, valor, status, descricao, metragem, quartos, banheiros, andar, sacada, garagem, infraestrutura)
VALUES
    (2, 'apartamento', 'Edifício Bella Vista', 'Centro', 340000, 'disponivel',
     'Apartamento amplo no 6º andar, com sacada e vista aberta para o centro da cidade. Prédio com elevador e salão de festas.',
     72, 2, 1, 6, 1, 1, 'Elevador, salão de festas, área de convivência'),
    (6, 'apartamento', 'Residencial Jardim das Palmeiras', 'Jardim das Palmeiras', 245000, 'disponivel',
     'Apartamento compacto e funcional, ideal para casal ou pessoa solteira. Prédio com portaria e área de lazer.',
     58, 1, 1, 2, 0, 1, 'Portaria, área de lazer com churrasqueira'),
    (7, 'apartamento', 'Edifício Monte Alto', 'Monte Alto', 465000, 'disponivel',
     'Apartamento amplo de 3 quartos no 9º andar, com vista panorâmica. Condomínio com academia e playground.',
     95, 3, 2, 9, 1, 1, 'Elevador, academia, salão de festas, playground');

INSERT INTO imoveis
    (id, tipo, titulo, bairro, valor, status, descricao, terreno, quartos, banheiros, pavimentos, garagem, cerca, piscina, patio)
VALUES
    (3, 'casa', 'Casa Bairro São José', 'São José', 520000, 'disponivel',
     'Casa de dois pavimentos com piscina, pátio amplo e garagem para 2 carros. Bairro tranquilo e residencial.',
     280, 3, 2, 2, 2, 1, 1, 1),
    (8, 'casa', 'Casa Bairro Cinquentenário', 'Cinquentenário', 310000, 'disponivel',
     'Casa térrea, simples e bem conservada, com pátio nos fundos e cerca em todo o terreno.',
     200, 2, 1, 1, 1, 1, 0, 1),
    (9, 'casa', 'Casa Bairro Centro', 'Centro', 680000, 'vendido',
     'Casa ampla de 4 quartos, dois pavimentos, piscina e pátio grande. Próxima ao centro da cidade.',
     350, 4, 3, 2, 2, 1, 1, 1);

-- Garante que o próximo imóvel cadastrado pelo painel comece do id 10
ALTER TABLE imoveis AUTO_INCREMENT = 10;
