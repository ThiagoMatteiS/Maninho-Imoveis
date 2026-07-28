/**
 * Maninho Imóveis — animações de scroll
 * 1) Revela seções/cards com efeito de "assentar" conforme entram na tela
 * 2) Recolhe o header quando a página é rolada
 * Sem dependências externas. Se o usuário preferir menos movimento,
 * o CSS (prefers-reduced-motion) já neutraliza os efeitos.
 */
(function () {
  'use strict';

  // 1) Reveal ao rolar
  var alvos = document.querySelectorAll('.reveal');

  function animarValor(container) {
    var alvo = container.querySelector('[data-final]');
    if (!alvo || alvo.dataset.animado) return;
    alvo.dataset.animado = '1';

    var span = alvo.querySelector('.valor-num');
    if (!span) return;

    var final = parseInt(alvo.getAttribute('data-final'), 10) || 0;
    var duracao = 1100;
    var inicio = null;

    function passo(agora) {
      if (!inicio) inicio = agora;
      var progresso = Math.min((agora - inicio) / duracao, 1);
      // easeOutCubic: começa rápido, desacelera no final — como um medidor se ajustando
      var suavizado = 1 - Math.pow(1 - progresso, 3);
      var valorAtual = Math.round(final * suavizado);
      span.textContent = valorAtual.toLocaleString('pt-BR');
      if (progresso < 1) {
        window.requestAnimationFrame(passo);
      } else {
        span.textContent = final.toLocaleString('pt-BR');
      }
    }
    window.requestAnimationFrame(passo);
  }

  if ('IntersectionObserver' in window && alvos.length) {
    var observer = new IntersectionObserver(function (entradas) {
      entradas.forEach(function (entrada) {
        if (entrada.isIntersecting) {
          entrada.target.classList.add('is-visible');
          animarValor(entrada.target);
          observer.unobserve(entrada.target);
        }
      });
    }, {
      threshold: 0.15,
      rootMargin: '0px 0px -40px 0px'
    });

    alvos.forEach(function (el) { observer.observe(el); });
  } else {
    // Sem suporte a IntersectionObserver: mostra tudo direto
    alvos.forEach(function (el) {
      el.classList.add('is-visible');
      animarValor(el);
    });
  }

  // 2) Header recolhe ao rolar + leve parallax nas curvas de nível do hero
  //    (throttle simples via requestAnimationFrame)
  var header = document.querySelector('.site-header');
  var contornos = document.querySelector('.hero-contours');
  var reduzMovimento = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var ticando = false;

  function atualizarScroll() {
    var y = window.scrollY;

    if (header) {
      if (y > 40) header.classList.add('is-scrolled');
      else header.classList.remove('is-scrolled');
    }

    if (contornos && !reduzMovimento) {
      var deslocamento = Math.min(y * 0.15, 60);
      contornos.style.transform = 'translateY(' + deslocamento + 'px)';
    }

    ticando = false;
  }

  window.addEventListener('scroll', function () {
    if (!ticando) {
      window.requestAnimationFrame(atualizarScroll);
      ticando = true;
    }
  }, { passive: true });
})();
