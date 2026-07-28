<?php
$page_title  = 'Início';
$active_page = 'home';
require_once __DIR__ . '/includes/header.php';
?>

<section class="hero">
  <!-- Curvas de nível decorativas (motivo topográfico) -->
  <svg class="hero-contours" viewBox="0 0 1180 460" preserveAspectRatio="none" aria-hidden="true">
    <path d="M-50 380 C 200 320, 350 420, 600 350 S 1000 260, 1250 340" stroke="#F3EEE1" stroke-width="1" fill="none"/>
    <path d="M-50 410 C 220 350, 380 450, 640 390 S 1020 300, 1250 380" stroke="#F3EEE1" stroke-width="1" fill="none"/>
    <path d="M-50 440 C 240 390, 400 470, 660 420 S 1040 340, 1250 410" stroke="#F3EEE1" stroke-width="1" fill="none"/>
    <path d="M-50 60 C 200 20, 340 100, 580 50 S 980 -10, 1250 60" stroke="#F3EEE1" stroke-width="1" fill="none"/>
    <path d="M-50 30 C 210 -10, 360 60, 600 15 S 1000 -40, 1250 25" stroke="#F3EEE1" stroke-width="1" fill="none"/>
  </svg>

  <div class="container hero-inner">
    <div>
      <span class="coord-tag">CARLOS BARBOSA · RS</span>
      <h1>Cada terreno tem uma história antes da planta.</h1>
      <p class="lead">
        Loteamentos, apartamentos e casas para você conhecer com calma, favoritar os
        que fizerem sentido e agendar uma visita presencial com <?= SITE_RESPONSAVEL ?>.
        Sem burocracia on-line: a conversa de verdade acontece no imóvel.
      </p>
      <a href="<?= whatsapp_link('Olá! Gostaria de falar sobre um imóvel do site.') ?>" class="btn btn-clay" target="_blank" rel="noopener">
        Falar no WhatsApp
      </a>
    </div>

    <div class="search-card reveal" role="search">
      <div class="search-tabs">
        <button type="button" class="is-active" data-tab="loteamentos">Loteamentos</button>
        <button type="button" data-tab="apartamentos">Apartamentos</button>
        <button type="button" data-tab="casas">Casas</button>
      </div>

      <form action="loteamentos.php" method="get">
        <div class="search-fields">
          <div class="field">
            <label for="bairro">Bairro</label>
            <input type="text" id="bairro" name="bairro" placeholder="Ex: Centro">
          </div>
          <div class="field">
            <label for="metragem">Metragem (m²)</label>
            <select id="metragem" name="metragem">
              <option value="">Qualquer</option>
              <option value="0-200">Até 200 m²</option>
              <option value="200-400">200 a 400 m²</option>
              <option value="400+">Acima de 400 m²</option>
            </select>
          </div>
          <div class="field">
            <label for="topografia">Topografia</label>
            <select id="topografia" name="topografia">
              <option value="">Qualquer</option>
              <option value="plano">Plano</option>
              <option value="aclive">Aclive</option>
              <option value="declive">Declive</option>
            </select>
          </div>
          <div class="field">
            <label for="valor">Valor máximo</label>
            <input type="text" id="valor" name="valor" placeholder="R$">
          </div>
        </div>
        <button type="submit" class="btn btn-clay">Buscar imóveis</button>
      </form>
    </div>
  </div>
</section>

<section class="categorias">
  <div class="container">
    <div class="section-head reveal">
      <h2>Escolha por onde começar</h2>
    </div>

    <div class="categorias-grid stagger">

      <a href="loteamentos.php" class="categoria-card reveal">
        <svg class="plot-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.6">
          <path d="M6 40 L6 14 L24 6 L42 14 L42 40 Z" stroke-dasharray="4 3"/>
          <path d="M6 40 L24 32 L42 40" />
          <path d="M24 32 L24 6" stroke-dasharray="2 2"/>
        </svg>
        <h3>Loteamentos &amp; Terrenos</h3>
        <p>Filtre por bairro, metragem, topografia e orientação solar. Ideal para quem vai construir do zero.</p>
        <span class="ir">Ver terrenos →</span>
      </a>

      <a href="apartamentos.php" class="categoria-card reveal">
        <svg class="plot-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.6">
          <rect x="12" y="6" width="24" height="36"/>
          <path d="M12 14h24M12 22h24M12 30h24"/>
          <path d="M18 42v-6h4v6M26 42v-6h4v6"/>
        </svg>
        <h3>Apartamentos</h3>
        <p>Quartos, banheiros, andar, sacada e garagem — compare a infraestrutura do prédio antes de visitar.</p>
        <span class="ir">Ver apartamentos →</span>
      </a>

      <a href="casas.php" class="categoria-card reveal">
        <svg class="plot-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.6">
          <path d="M6 22 L24 8 L42 22"/>
          <path d="M10 20v20h28V20"/>
          <path d="M20 40v-10h8v10"/>
        </svg>
        <h3>Casas</h3>
        <p>Terreno, pavimentos, garagem, piscina, pátio e mais. Veja o que cada casa oferece em detalhe.</p>
        <span class="ir">Ver casas →</span>
      </a>

    </div>
  </div>
</section>

<section class="destaques">
  <div class="container">
    <div class="section-head reveal">
      <h2>Imóveis em destaque</h2>
      <a href="loteamentos.php" class="ver-todos">Ver todos →</a>
    </div>

    <div class="imoveis-grid stagger">

      <article class="imovel-card reveal">
        <div class="imovel-thumb">
          <span class="imovel-tag">Terreno</span>
          <button class="fav-btn" aria-label="Favoritar imóvel">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s-7.5-4.7-10-9.3C.4 8.6 2 5 5.5 5c2 0 3.3 1 4.5 2.6C11.2 6 12.5 5 14.5 5 18 5 19.6 8.6 22 11.7 19.5 16.3 12 21 12 21z"/></svg>
          </button>
          <svg viewBox="0 0 300 225" preserveAspectRatio="none">
            <rect width="300" height="225" fill="#E9E1CC"/>
            <path d="M20 190 L150 90 L280 190 Z" fill="none" stroke="#B5482D" stroke-width="1.4" stroke-dasharray="5 4"/>
            <line x1="150" y1="90" x2="150" y2="190" stroke="#4C6B4F" stroke-width="1.4" stroke-dasharray="3 3"/>
          </svg>
        </div>
        <div class="imovel-body">
          <h4>Terreno Loteamento Vista Verde</h4>
          <p class="local">Bairro Cinquentenário</p>
          <div class="imovel-attrs">
            <span>360 m²</span><span>·</span><span>Plano</span><span>·</span><span>Face Norte</span>
          </div>
          <div class="imovel-footer">
            <div class="imovel-valor" data-final="185000"><small>À VISTA OU FINANCIADO</small>R$ <span class="valor-num">0</span></div>
            <a href="imovel.php?id=1" class="btn btn-outline" style="color:var(--ink); border-color:var(--line);">Ver detalhes</a>
          </div>
        </div>
      </article>

      <article class="imovel-card reveal">
        <div class="imovel-thumb">
          <span class="imovel-tag">Apartamento</span>
          <button class="fav-btn" aria-label="Favoritar imóvel">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s-7.5-4.7-10-9.3C.4 8.6 2 5 5.5 5c2 0 3.3 1 4.5 2.6C11.2 6 12.5 5 14.5 5 18 5 19.6 8.6 22 11.7 19.5 16.3 12 21 12 21z"/></svg>
          </button>
          <svg viewBox="0 0 300 225" preserveAspectRatio="none">
            <rect width="300" height="225" fill="#E9E1CC"/>
            <rect x="90" y="30" width="120" height="165" fill="none" stroke="#1B2A3B" stroke-width="1.4"/>
            <path d="M90 65h120M90 100h120M90 135h120M90 170h120" stroke="#1B2A3B" stroke-width="1"/>
          </svg>
        </div>
        <div class="imovel-body">
          <h4>Edifício Bella Vista</h4>
          <p class="local">Bairro Centro · 6º andar</p>
          <div class="imovel-attrs">
            <span>72 m²</span><span>·</span><span>2 quartos</span><span>·</span><span>Sacada</span><span>·</span><span>1 vaga</span>
          </div>
          <div class="imovel-footer">
            <div class="imovel-valor" data-final="340000"><small>VALOR</small>R$ <span class="valor-num">0</span></div>
            <a href="imovel.php?id=2" class="btn btn-outline" style="color:var(--ink); border-color:var(--line);">Ver detalhes</a>
          </div>
        </div>
      </article>

      <article class="imovel-card reveal">
        <div class="imovel-thumb">
          <span class="imovel-tag">Casa</span>
          <button class="fav-btn" aria-label="Favoritar imóvel">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s-7.5-4.7-10-9.3C.4 8.6 2 5 5.5 5c2 0 3.3 1 4.5 2.6C11.2 6 12.5 5 14.5 5 18 5 19.6 8.6 22 11.7 19.5 16.3 12 21 12 21z"/></svg>
          </button>
          <svg viewBox="0 0 300 225" preserveAspectRatio="none">
            <rect width="300" height="225" fill="#E9E1CC"/>
            <path d="M60 120 L150 60 L240 120" fill="none" stroke="#4C6B4F" stroke-width="1.4"/>
            <rect x="75" y="120" width="150" height="80" fill="none" stroke="#1B2A3B" stroke-width="1.4"/>
            <circle cx="205" cy="175" r="14" fill="none" stroke="#B5482D" stroke-width="1.2"/>
          </svg>
        </div>
        <div class="imovel-body">
          <h4>Casa Bairro São José</h4>
          <p class="local">Bairro São José</p>
          <div class="imovel-attrs">
            <span>3 quartos</span><span>·</span><span>2 pavim.</span><span>·</span><span>Piscina</span><span>·</span><span>2 vagas</span>
          </div>
          <div class="imovel-footer">
            <div class="imovel-valor" data-final="520000"><small>VALOR</small>R$ <span class="valor-num">0</span></div>
            <a href="imovel.php?id=3" class="btn btn-outline" style="color:var(--ink); border-color:var(--line);">Ver detalhes</a>
          </div>
        </div>
      </article>

    </div>
  </div>
</section>

<section class="como-funciona">
  <div class="container">
    <div class="section-head reveal">
      <h2>Como funciona</h2>
    </div>
    <div class="passos stagger">
      <div class="passo reveal">
        <span class="n">01</span>
        <h4>Navegue e filtre</h4>
        <p>Explore terrenos, apartamentos e casas com filtros específicos para cada tipo de imóvel.</p>
      </div>
      <div class="passo reveal">
        <span class="n">02</span>
        <h4>Favorite o que interessar</h4>
        <p>Crie uma conta gratuita e monte sua lista de imóveis favoritos para acompanhar depois.</p>
      </div>
      <div class="passo reveal">
        <span class="n">03</span>
        <h4>Fale com a gente</h4>
        <p>Envie uma mensagem pelo WhatsApp ou e-mail direto na página do imóvel de interesse.</p>
      </div>
      <div class="passo reveal">
        <span class="n">04</span>
        <h4>Visite pessoalmente</h4>
        <p><?= SITE_RESPONSAVEL ?> agenda a visita e conduz toda a negociação presencialmente.</p>
      </div>
    </div>
  </div>
</section>

<section class="cta-anuncie">
  <div class="container reveal">
    <div>
      <h2>Quer vender seu imóvel?</h2>
      <p>Conte pra gente os detalhes do seu terreno, apartamento ou casa e receba uma avaliação.</p>
    </div>
    <a href="anuncie.php" class="btn btn-clay">Anuncie conosco</a>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
