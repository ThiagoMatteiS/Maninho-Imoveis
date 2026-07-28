<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <h5>Maninho Imóveis</h5>
        <p style="max-width:34ch; color:#C9D0D5;">
          Loteamentos, apartamentos e casas. Você navega, favorita e agenda a visita —
          a negociação acontece sempre pessoalmente, com <?= SITE_RESPONSAVEL ?>.
        </p>
      </div>
      <div>
        <h5>Navegação</h5>
        <ul>
          <li><a href="<?= BASE_URL ?>loteamentos.php">Loteamentos</a></li>
          <li><a href="<?= BASE_URL ?>apartamentos.php">Apartamentos</a></li>
          <li><a href="<?= BASE_URL ?>casas.php">Casas</a></li>
          <li><a href="<?= BASE_URL ?>anuncie.php">Anuncie seu imóvel</a></li>
        </ul>
      </div>
      <div>
        <h5>Contato</h5>
        <ul>
          <li><a href="<?= whatsapp_link('Olá! Vim pelo site e gostaria de mais informações.') ?>">WhatsApp: <?= SITE_TELEFONE_EXIBICAO ?></a></li>
          <li><a href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a></li>
          <li>Atendimento: <?= SITE_RESPONSAVEL ?></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; <?= date('Y') ?> <?= SITE_NOME ?>. Todos os direitos reservados.</span>
      <span>Todas as negociações são realizadas presencialmente.</span>
    </div>
  </div>
</footer>

<a href="<?= whatsapp_link('Olá! Vim pelo site da Maninho Imóveis e gostaria de falar com vocês.') ?>"
   class="whatsapp-float" aria-label="Falar no WhatsApp" target="_blank" rel="noopener">
  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.7-.8-2-.9-.3-.1-.5-.1-.6.1-.2.3-.7.9-.9 1-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.6-2.1-.2-.3 0-.5.1-.6.1-.1.3-.3.4-.5.1-.1.2-.3.3-.4.1-.2 0-.4 0-.5 0-.1-.6-1.5-.8-2-.2-.5-.4-.5-.6-.5h-.5c-.2 0-.5.1-.7.3-.3.3-1 1-1 2.4s1 2.8 1.2 3c.1.2 2 3 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.3.2-.6.2-1.1.2-1.3-.1-.1-.3-.2-.6-.3z"/><path d="M12 2C6.5 2 2 6.5 2 12c0 1.9.5 3.6 1.4 5.1L2 22l5-1.3c1.5.8 3.2 1.3 5 1.3 5.5 0 10-4.5 10-10S17.5 2 12 2zm0 18.3c-1.6 0-3.1-.4-4.4-1.2l-.3-.2-3 .8.8-2.9-.2-.3C4.1 15 3.7 13.5 3.7 12c0-4.6 3.7-8.3 8.3-8.3s8.3 3.7 8.3 8.3-3.7 8.3-8.3 8.3z"/></svg>
</a>

<script src="<?= BASE_URL ?>assets/js/animations.js"></script>
</body>
</html>
