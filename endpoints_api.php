<?php
date_default_timezone_set('America/Sao_Paulo');
// Configuração

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$URL = $_ENV['API_URL'];

$API_TOKEN    = $_ENV['API_TOKEN']; 

$API_QUESTAO_TEMA = $URL."gerar-questoes-tema";
$API_QUESTAO_PDF  = $URL."gerar-questoes-pdf";


$API_ATIVIDADE_TEMA = $URL."gerar-atividade-tema";
$API_ATIVIDADE_PDF  = $URL."gerar-atividade-pdf";

$API_ROTEIRO_TEMA = $URL."gerar-roteiro-tema";
$API_ROTEIRO_PDF  = $URL."gerar-roteiro-pdf";

$API_DESCRICAO_IMAGEM  = $URL."descrever-imagem";

$API_TRANSLATE_TEXT = $URL."traduzir-texto";
$API_REWRITE_TEXT  = $URL."reescrever-texto";
$API_REVIEW_TEXT  = $URL."revisar-texto";
$API_EXPAND_TEXT  = $URL."expandir-texto";
$API_SUMMARIZE_TEXT  = $URL."resumir-texto";
$API_SUMMARIZE_PDF  = $URL."resumir-pdf";
$API_CREATE_TEXT  = $URL."criar-texto";

