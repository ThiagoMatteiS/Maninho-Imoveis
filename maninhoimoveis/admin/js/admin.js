/**
 * Maninho Imóveis — painel administrativo
 * 1) Abre/fecha a sidebar no mobile
 * 2) Mostra um toast quando a URL vem com ?sucesso=... (após salvar,
 *    remover, mudar status, etc.) e limpa o parâmetro da URL depois
 */
(function () {
  'use strict';

  // 1) Sidebar mobile
  var sidebar  = document.querySelector('.admin-sidebar');
  var overlay  = document.querySelector('.admin-sidebar-overlay');
  var botaoAbrir = document.querySelector('.admin-menu-toggle');

  function fecharSidebar() {
    if (sidebar) sidebar.classList.remove('is-open');
    if (overlay) overlay.classList.remove('is-open');
  }

  if (botaoAbrir && sidebar && overlay) {
    botaoAbrir.addEventListener('click', function () {
      sidebar.classList.add('is-open');
      overlay.classList.add('is-open');
    });
    overlay.addEventListener('click', fecharSidebar);
  }

  // 2) Toasts de sucesso/erro via parâmetro ?sucesso= na URL
  var MENSAGENS_TOAST = {
    'imovel-salvo':     'Imóvel salvo com sucesso.',
    'imovel-removido':  'Imóvel removido.',
    'status-atualizado':'Status atualizado.',
    'mensagem-lida':    'Mensagem marcada como lida.',
    'mensagem-removida':'Mensagem removida.'
  };

  function mostrarToast(texto, tipo) {
    var wrap = document.querySelector('.admin-toast-wrap');
    if (!wrap) {
      wrap = document.createElement('div');
      wrap.className = 'admin-toast-wrap';
      document.body.appendChild(wrap);
    }

    var toast = document.createElement('div');
    toast.className = 'admin-toast' + (tipo === 'erro' ? ' --erro' : '');
    toast.textContent = texto;
    wrap.appendChild(toast);

    // Força um repaint antes de animar (senão a transição não dispara)
    window.requestAnimationFrame(function () {
      toast.classList.add('is-visible');
    });

    setTimeout(function () {
      toast.classList.remove('is-visible');
      setTimeout(function () { toast.remove(); }, 400);
    }, 3200);
  }

  var params = new URLSearchParams(window.location.search);
  var sucesso = params.get('sucesso');

  if (sucesso && MENSAGENS_TOAST[sucesso]) {
    mostrarToast(MENSAGENS_TOAST[sucesso]);
    // Remove o parâmetro da URL sem recarregar a página,
    // pra não mostrar o toast de novo se a pessoa atualizar (F5)
    params.delete('sucesso');
    var novaUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
    window.history.replaceState({}, '', novaUrl);
  }
})();
