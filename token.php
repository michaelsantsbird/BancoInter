<?php

/* Michael Sants */

$chtokenVer = curl_init();

curl_setopt($chtokenVer, CURLOPT_URL,"https://cdpj.partners.bancointer.com.br/oauth/v2/token");
curl_setopt($chtokenVer, CURLOPT_SSLCERT, "INFORMAR O DIRETORIO ONDE ESTA O CERTIFICA/certificado.cdr");
curl_setopt($chtokenVer, CURLOPT_SSLKEY, "INFORMAR O DIRETORIO ONDE ESTA A CHAVE/chave.key");
curl_setopt($chtokenVer, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chtokenVer, CURLOPT_MAXREDIRS, 10);
curl_setopt($chtokenVer, CURLOPT_TIMEOUT, 0);
curl_setopt($chtokenVer, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($chtokenVer, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($chtokenVer, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($chtokenVer, CURLOPT_POSTFIELDS, array('client_id' => 'Informar o client_id gerado no APP do Banco Inter', 'client_secret' => 'Informar o Client_secret gerado no APP do Banco Inter', 'scope' => 'boleto-cobranca.read boleto-cobranca.write', 'grant_type' => 'client_credentials'));
$server_response = curl_exec($chtokenVer);
$obj = json_decode($server_response);
$bearerToken=$obj->{'access_token'};
echo $bearerToken;

/* deverá aparecer o token gerado */
/* Note que ja separamos o JSON, com isso estamos pegando apenas o resultado que queremos, nesse caso é o access_token */
/* Nesse caso, o token esta programado para visualizar os boleto gerados, caso queira alterar para PIX ou outra modalidade, basta basta alterar o SCOPE para o padrao do BANCO INTER fornecido */

?>
