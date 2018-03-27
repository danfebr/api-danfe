<?php
error_reporting(E_STRICT);

require_once 'danfe.class.php';

$chave_ = $_POST['chave'];

$danfe = new Danfe();

if (!empty($chave_)) {
	$nfe = json_decode($danfe->nfe($chave_));
	if($nfe->status == FALSE) {
		if($nfe->error == "ERRO_RECEITA") {
			$data = array('status' => 0, 'msg' => $nfe->mensagem);
		} else {
			$data = array('status' => 0, 'msg' => $danfe->erro($nfe->error));
		}
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
        <title>DANFE.br.com - API 1.0</title>
    </head>

	<?php if($data['status'] == 0) { ?>
		<p><font color="red"><?php echo $data['msg']; ?></font></p>
	<?php } else { ?>
		<p>
			<a href="<?php echo $data['xml']; ?>" target="_blank">Download XML</a>
			<br />
			<a href="<?php echo $data['pdf']; ?>" target="_blank">Download PDF</a>
		</p>
	<?php } ?>
	
    <body>
		<form action="" method="POST">
			Chave de acesso da NFe:<br />
			<input type="text" name="chave" value="<?php echo $chave_; ?>" /><br />
			<input type="submit" value="Enviar" />
		</form>
    </body>
</html>