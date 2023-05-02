<form method="POST" action="#"  >
<table style="width:100%;" border="1" cellpadding="5" cellspacing="5" class="table table-bordered table-striped datatable"  >
<tr><td colspan="2"><h3>Visualizar boletos por periodo</h3></td></tr>

 
   <tr><td>Data inicio:<br />

    <input name="datainicio" type="date"  />
    </td><td>Data final:<br />

        <input name="datafim" type="date"  />

    </td></tr>
    <tr><td>Quantidade de boletos a visualizar:<br />
    <input name="quantidade" type="number"  />
    </td><td>Situação:<br />
<select name="situacao" style="width:100%; padding:5px;">
<option value="PAGO,VENCIDO,EMABERTO,EXPIRADO,CANCELADO">TODAS</option>
<option value="PAGO">PAGO</option>
<option value="VENCIDO">VENCIDO</option>
<option value="EMABERTO">EMABERTO</option>
<option value="EXPIRADO">EXPIRADO</option>
<option value="CANCELADO">CANCELADO</option>
</select>

 <tr><td>
     <input type="submit" name="Submit" class="btn btn-green pull-left"  value="Enviar"   />
   </td></tr> 
 
 </table>
 </form>


<?php 

if(isset($_POST['Submit']) && $_POST['Submit'] == 'Enviar'){

$datainicio = $_POST['datainicio'];
$datafim = $_POST['datafim'];
$situacao = $_POST['situacao'];
$quantidade = $_POST['quantidade'];

$chtokenVer = curl_init();

curl_setopt($chtokenVer, CURLOPT_URL,"https://cdpj.partners.bancointer.com.br/oauth/v2/token");
curl_setopt($chtokenVer, CURLOPT_SSLCERT, "DIRETORIO ONDE ESTA O CERTIFICADO GERADO NO APP DO BANCO INTER/certificado.crt");
curl_setopt($chtokenVer, CURLOPT_SSLKEY, "DIRETORIO ONDE ESTA A CHAVE GERADA NO APP DO BANCO INTER/chave.key");
curl_setopt($chtokenVer, CURLOPT_RETURNTRANSFER, true);
curl_setopt($chtokenVer, CURLOPT_MAXREDIRS, 10);
curl_setopt($chtokenVer, CURLOPT_TIMEOUT, 0);
curl_setopt($chtokenVer, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($chtokenVer, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($chtokenVer, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($chtokenVer, CURLOPT_POSTFIELDS, array('client_id' => 'INFORMAR O CLIENT_ID GERADO NO APP DO BANCO INTER', 'client_secret' => 'INFORMAR O CLIENT_SECRET GERADO NO APP DO BANCO INTER', 'scope' => 'boleto-cobranca.read boleto-cobranca.write', 'grant_type' => 'client_credentials'));
$server_response = curl_exec($chtokenVer);
$obj = json_decode($server_response);
$bearerToken=$obj->{'access_token'};

$auth='Authorization: Bearer ' . $bearerToken;



$queryString = http_build_query([
     'dataInicial' => $datainicio,
    'dataFinal' => $datafim,
    'situacao' => $situacao,
    'tipoOrdenacao' => 'ASC',
    'itensPorPagina' => $quantidade,
    'paginaAtual' => 1
]);

$chtokenVer = curl_init();
curl_setopt($chtokenVer, CURLOPT_URL, "https://cdpj.partners.bancointer.com.br/cobranca/v2/boletos?" . $queryString);
curl_setopt($chtokenVer, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($chtokenVer, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($chtokenVer, CURLOPT_SSLCERT, "DIRETORIO ONDE ESTA O CERTIFICADO GERADO NO APP DO BANCO INTER/certificado.crt");
curl_setopt($chtokenVer, CURLOPT_SSLKEY, "DIRETORIO ONDE ESTA A CHAVE GERADA NO APP DO BANCO INTER/chave.key");
curl_setopt($chtokenVer, CURLOPT_HTTPHEADER, array($auth));
curl_setopt($chtokenVer, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($chtokenVer);
curl_close($chtokenVer);

$dadosBoleto = json_decode($response, TRUE);


 
?>

<table style="width:100%;" border="1" cellpadding="5" cellspacing="5" >

  <thead>
<tr>
<th>Nome do beneficiario</th>
<th>Nome do cotista</th>
<th>Situação</th>
<th>Valor</th>
<th>Vencimento</th>
</tr>
</thead>
  <tbody>
 <?php 
foreach ($dadosBoleto["content"] as $valor){
    $steamid = $valor["pagador"];
   
	 
?>	  
	<tr>
    <td><?php echo $valor["nomeBeneficiario"] ?></td>
    <td><?php  echo $steamid["nome"]; ?></td>
    <td><?php  echo $valor["situacao"];?></td>
    <td><?php echo $valor["valorNominal"]; ?></td>
    <td><?php  echo date("d/m/Y", strtotime($valor["dataVencimento"]));?></td>
    
    </tr>  
	  
<?php }?>
  <tbody>
</table>

 
<?php }?>
