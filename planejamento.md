# Planejamento de Projeto — Site Maninho Imóveis

**Cliente:** Luiz Claudino
**Contato:** maninho@maninhoimoveis.com.br | +51 99989-9580
**Tipo de projeto:** Vitrine digital imobiliária (sem transação online — negociação 100% presencial)

---

## 1. Mapa de Páginas do Site (Sitemap)

### 1.1 Páginas Públicas

| Página | Função Principal |
|---|---|
| **Home** | Apresentação da imobiliária, destaques de imóveis, busca rápida por categoria e chamada para WhatsApp |
| **Loteamentos / Terrenos** | Listagem com filtros específicos da categoria |
| **Apartamentos** | Listagem com filtros específicos da categoria |
| **Casas** | Listagem com filtros específicos da categoria |
| **Detalhe do Imóvel** | Página individual com galeria, ficha técnica e botão de contato |
| **Anuncie Conosco** | Formulário para o proprietário enviar seu imóvel para avaliação |
| **Contato** | Dados de contato, formulário geral e mapa/localização |
| **Login / Cadastro** | Acesso para o visitante criar conta e favoritar imóveis |

### 1.2 Páginas Privadas (Área do Usuário)

| Página | Função Principal |
|---|---|
| **Meus Favoritos** | Lista de imóveis salvos pelo usuário logado |
| **Meus Dados** | Edição de perfil (nome, e-mail, telefone, senha) |

### 1.3 Painel Administrativo (Restrito)

| Página | Função Principal |
|---|---|
| **Dashboard Admin** | Visão geral: nº de imóveis ativos, mensagens novas, imóveis mais visualizados |
| **Gestão de Imóveis** | Cadastrar, editar, remover e alterar status (Disponível / Reservado / Vendido) |
| **Mensagens e Solicitações** | Central de leitura das mensagens de interesse e dos formulários "Anuncie Conosco" |
| **Configurações** | Dados de contato exibidos no site, textos institucionais, etc. |

---

## 2. Fluxo da Jornada do Usuário

```
1. Visitante acessa a Home
        ↓
2. Escolhe uma categoria (Loteamento, Apartamento ou Casa)
   — ou usa a busca rápida da Home
        ↓
3. Aplica filtros específicos da categoria
   (ex.: metragem, quartos, valor, topografia)
        ↓
4. Visualiza a listagem de resultados (cards com foto, valor e resumo)
        ↓
5. Acessa o Detalhe do Imóvel
   (galeria de fotos, ficha técnica completa, mapa/bairro)
        ↓
6. Ação de interesse:
   a) Favoritar (exige login/cadastro)
   b) Clicar em "Falar sobre este imóvel"
        ↓
7. Escolha do canal de contato:
   - Botão WhatsApp (mensagem pré-preenchida com nome do imóvel)
   - Formulário de contato (envia e-mail automático)
        ↓
8. Luiz Claudino recebe a solicitação e agenda visita presencial
        ↓
9. Negociação e fechamento acontecem 100% presencialmente
```

**Ponto-chave de UX:** em nenhum momento o site deve sugerir pagamento, reserva ou negociação online. Todos os CTAs (botões de ação) devem reforçar o convite ao contato humano: *"Fale com um corretor"*, *"Agende sua visita"*, *"Tire suas dúvidas no WhatsApp"*.

---

## 3. Escopo Funcional das Telas

### 3.1 Tela de Listagem por Categoria (Loteamentos / Apartamentos / Casas)

**Funcionalidades:**
- Grade de cards com foto principal, valor, localização (bairro) e 2-3 atributos-chave
- Painel de filtros lateral (ou superior em mobile), específico por categoria:

| Categoria | Filtros disponíveis |
|---|---|
| Loteamentos | Bairro, faixa de m², topografia, orientação solar, faixa de valor, financiamento direto |
| Apartamentos | Faixa de m², nº quartos, banheiros, andar, sacada, garagem, faixa de valor |
| Casas | Bairro, faixa de m² do terreno, quartos, banheiros, pavimentos, garagem, piscina, faixa de valor |

- Ordenação (menor/maior valor, mais recentes)
- Paginação ou scroll infinito
- Indicador visual de status ("Reservado" / "Vendido") quando aplicável

### 3.2 Tela de Detalhe do Imóvel

**Funcionalidades:**
- Galeria de fotos (carrossel, com zoom)
- Ficha técnica completa (todos os campos obrigatórios da categoria correspondente)
- Botão fixo/destacado de **WhatsApp** (mensagem automática: *"Olá, tenho interesse no imóvel [Título/Código], gostaria de agendar uma visita"*)
- Botão/formulário de **e-mail de contato**
- Ícone de **favoritar** (coração)
- Compartilhamento em redes sociais (opcional)
- Mapa aproximado do bairro/região (sem endereço exato, por segurança)

### 3.3 Área do Cliente (Login/Cadastro e Favoritos)

**Funcionalidades:**
- Cadastro simples (nome, e-mail, telefone, senha) ou login via Google/Facebook (opcional, fase 2)
- Tela "Meus Favoritos": grid dos imóveis salvos, com opção de remover
- Notificação simples caso um imóvel favoritado mude de status (fase 2 — opcional)

### 3.4 Formulário "Anuncie Conosco"

**Funcionalidades:**
- Campos: nome, telefone, e-mail, tipo de imóvel, bairro, valor pretendido, descrição livre
- Upload de fotos (opcional na primeira versão)
- Envio direto para o e-mail/painel do administrador, categorizado como "Solicitação de Anúncio"

### 3.5 Painel do Administrador

**Funcionalidades:**
- **Login restrito** (usuário/senha do Luiz Claudino e possíveis corretores)
- **Gestão de Imóveis:**
  - Cadastro por categoria (formulário dinâmico exibindo os campos corretos conforme o tipo escolhido)
  - Upload múltiplo de fotos
  - Edição e exclusão
  - Alteração rápida de status (Disponível / Reservado / Vendido)
- **Central de Mensagens:**
  - Lista de mensagens de interesse em imóveis (com referência ao imóvel)
  - Lista de solicitações do formulário "Anuncie Conosco"
  - Marcação de lida/não lida e arquivamento

---

## 4. Estratégia de Captação e Direcionamento de Contato

Todo ponto de contato do site deve convergir para os canais do Luiz Claudino, com contexto automático para agilizar o atendimento:

| Canal | Quando é usado | Formato da mensagem |
|---|---|---|
| **WhatsApp** (+51 99989-9580) | Botão principal em cada imóvel (ação mais rápida) | Mensagem pré-formatada: nome do imóvel/código + link da página |
| **E-mail** (maninho@maninhoimoveis.com.br) | Formulários de contato geral e "Anuncie Conosco" | E-mail automático com todos os dados preenchidos pelo usuário |
| **Painel Admin** | Registro interno de todas as solicitações | Toda mensagem recebida (WhatsApp não se aplica aqui, mas os formulários sim) é também salva no painel para consulta e histórico |

**Recomendações de UX para captação:**
- Botão de WhatsApp sempre visível (fixo/flutuante) nas páginas de listagem e detalhe
- Reforçar em toda a jornada que "a visita é gratuita e sem compromisso"
- Rodapé e cabeçalho com contato sempre visíveis
- Formulário de contato curto (poucos campos) para reduzir abandono

---

## 5. Fases de Execução Recomendadas

### Fase 1 — Descoberta e Wireframe
- Validação final do escopo funcional (este documento)
- Wireframes de baixa fidelidade das telas principais (Home, Listagem, Detalhe, Admin)
- Definição da árvore de navegação (sitemap validado com o cliente)

### Fase 2 — Layout / Design Visual
- Definição de identidade visual (cores, tipografia, logo se necessário)
- Criação do layout de alta fidelidade (protótipo navegável) para desktop e mobile
- Validação com o cliente e ajustes

### Fase 3 — Desenvolvimento Front-end
- Construção das páginas públicas (Home, Listagens, Detalhe, Anuncie Conosco, Contato)
- Implementação dos filtros por categoria
- Responsividade (mobile-first, já que grande parte do tráfego imobiliário vem de celular)

### Fase 4 — Desenvolvimento Back-end e Painel Admin
- Estrutura de banco de dados (imóveis, categorias, usuários, mensagens)
- Painel administrativo (CRUD de imóveis, gestão de mensagens)
- Sistema de login/cadastro de usuários e favoritos

### Fase 5 — Integrações
- Botão de WhatsApp com mensagem automática
- Envio de e-mails automáticos (formulários)
- Mapa de localização (Google Maps API ou similar)

### Fase 6 — Testes e Homologação
- Teste funcional em diferentes dispositivos e navegadores
- Teste de fluxo completo (busca → detalhe → contato)
- Ajustes finais com base no feedback do Luiz Claudino

### Fase 7 — Lançamento e Treinamento
- Publicação do site em produção
- Treinamento do Luiz Claudino (e equipe, se houver) para uso do painel admin
- Entrega de manual rápido de uso do painel

### Fase 8 — Pós-lançamento (opcional)
- Acompanhamento inicial de métricas (Google Analytics)
- Pequenos ajustes de usabilidade com base no uso real
- Planejamento de melhorias futuras (ex.: login social, notificações de favoritos)

---

## Observações Finais

- O sistema **não deve conter** nenhuma funcionalidade de pagamento, checkout ou reserva online, reforçando a regra de negócio central: toda negociação é presencial.
- Todos os formulários e botões de ação devem ter como objetivo único **gerar contato qualificado** para o Luiz Claudino.
- O cadastro de imóveis no painel deve ser **dinâmico por categoria**, exibindo apenas os campos pertinentes ao tipo selecionado (Loteamento, Apartamento ou Casa), evitando erros de preenchimento.
