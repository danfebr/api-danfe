<?php
error_reporting(E_STRICT);

require_once 'danfe.class.php';

$danfe = new Danfe();

$xml = $_FILES['xml']['tmp_name'];

if (!empty($xml)) {
	$xmlCodigo = file_get_contents($xml);
	$nfe = json_decode($danfe->xml($xmlCodigo));
	if($nfe->status == FALSE) {
		$data = array('status' => 0, 'msg' => $danfe->erro($nfe->error));
	} else {
		$data = array('status' => 1, 'xml' => $nfe->xml, 'pdf' => $nfe->pdf);
	}
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Exemplo de uso da API do DANFE.br.com">
        <meta name="author" content="">
        <title>DANFE.br.com - API 2.0</title>
    </head>
	
    <body>
		<?php if($data['status'] == 0) { ?>
			<p><font color="red"><?php echo $data['msg']; ?></font></p>
		<?php } else { ?>
			<p>
				<a href="<?php echo $data['xml']; ?>" target="_blank">Download XML</a>
				<br />
				<a href="<?php echo $data['pdf']; ?>" target="_blank">Download PDF</a>
			</p>
		<?php } ?>
		
		<form action="" method="POST" enctype="multipart/form-data">
			XML da NFe:<br />
			<input type="file" name="xml" /><br />
			<input type="submit" value="Enviar" />
		</form>
    </body>
</html>