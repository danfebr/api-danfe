<?php
error_reporting(E_STRICT);

require_once 'danfe.class.php';

$chave = $_POST['chave'];
$captcha = $_POST['captcha'];
$key = $_POST['key'];

$danfe = new Danfe();

if (!empty($chave) && !empty($captcha)) {
	$nfe = json_decode($danfe->chave_captcha($chave, $key, $captcha));
	if($nfe->status == FALSE) {
		if($nfe->error == "ERRO_RECEITA") {
			$data = array('status' => 0, 'msg' => $nfe->mensagem);
		} else {
			$data = array('status' => 0, 'msg' => $danfe->erro($nfe->error));
		}
    }else
        $data = array('status' => 1, 'xml' => $nfe->xml, 'pdf' => $nfe->pdf);
}
$key = json_decode($danfe->captcha())->key;
$imagem = json_decode($danfe->imagem($key));
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
		
        <form action="" method="POST">
            <img src="<?php echo $imagem->captcha; ?>"/>
			<p>Captcha:</p>
			<input type="text" name="captcha" value="<?php echo $captcha; ?>" /><br />
			<p>Chave de acesso da NFe:</p>
			<input type="text" name="chave" value="<?php echo $chave; ?>" /><br />
			<input type="hidden" name="key" value="<?php echo $key; ?>" /><br />
			<input type="submit" value="Enviar" />
		</form>
    </body>
</html>
