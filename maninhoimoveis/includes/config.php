<?php
/**
 * Configurações gerais do site - Maninho Imóveis
 * Altere aqui os dados de contato: eles são usados em todo o site
 * (header, footer, botões de WhatsApp e formulários).
 */

define('SITE_NOME', 'Maninho Imóveis');
define('SITE_RESPONSAVEL', 'Luiz Claudino');
define('SITE_EMAIL', 'maninho@maninhoimoveis.com.br');
define('SITE_TELEFONE_EXIBICAO', '(51) 99989-9580');
define('SITE_WHATSAPP_NUMERO', '5551999899580'); // formato internacional, só números

/**
 * Monta um link de WhatsApp já com mensagem preenchida.
 * Uso: whatsapp_link("Olá, tenho interesse no imóvel Terreno Bairro X")
 */
function whatsapp_link(string $mensagem = ''): string {
    $base = 'https://wa.me/' . SITE_WHATSAPP_NUMERO;
    if ($mensagem !== '') {
        $base .= '?text=' . rawurlencode($mensagem);
    }
    return $base;
}

/**
 * Monta um link de WhatsApp a partir de QUALQUER telefone informado
 * (ex: o telefone que a pessoa digitou num formulário de contato).
 * Usado no painel para responder direto a quem mandou mensagem.
 */
function whatsapp_link_wa(string $telefoneBruto): string {
    $digitos = preg_replace('/\D/', '', $telefoneBruto);
    if ($digitos === '') return '#';
    // Se não vier com código do país, assume Brasil (55)
    if (strlen($digitos) <= 11) {
        $digitos = '55' . $digitos;
    }
    return 'https://wa.me/' . $digitos;
}

// Caminho base do site.
// Deixamos em branco de propósito: como header.php/footer.php usam caminhos
// RELATIVOS (ex: "css/style.css", "loteamentos.php"), o site funciona tanto
// rodando na raiz (http://localhost:8000/) quanto em subpasta
// (http://localhost/maninho-imoveis/) ou em hospedagem real, sem precisar
// trocar nada aqui.
define('BASE_URL', '');
