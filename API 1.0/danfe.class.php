<?php

# DANFE.br.com - API PHP

class Danfe {

    private $danfe,
            $apikey,
            $errosDanfe;

    public function __construct() {
        $this->danfe = "https://danfe.br.com";
        $this->apikey = "f1e7c6131c10a3ffcaad15e58edc9368"; // SUA API KEY
        $this->errosDanfe = array(
			// ERROS CHAVE
            'ERRO_APIKEY_INVALIDA' => 'A API Key é inválida, ela deve ter 32 caracteres, somente letras e números',
            'ERRO_APIKEY_INEXISTENTE' => 'A API Key não existe, verifique se você mudou a chave da sua API.',
            'ERRO_API_ACESSO' => 'Conta sem liberar o acesso da API. Verifique no menu (configurações > sistema).',
            'ERRO_KEY_INVALIDA' => 'A Key é inválida, ela deve ter 32 caracteres, somente letras e números.',
            'ERRO_KEY_INEXISTENTE' => 'A Key não existe, verifique se você gerou a key.',
            'ERRO_CHAVE_INVALIDA' => 'Verifique a chave de acesso da NFe.',
            // ERROS CAPTCHA
            'ERRO_CAPTCHA_INVALIDO' => 'O Captcha digitado não confere com a imagem.', 
            // ERROS RECEITA 
            'ERRO_RECEITA' => 'Erro receita.', // variável adicional "mensagem"
            'ERRO_RECEITA_OBTER_DADOS' => 'Portal da NFe temporariamente offline.',
			// ERROS XML
            'ERRO_XML_INVALIDO' => 'XML inválido.'
        );
    }

    public function captcha(){
       return $this->curl($this->danfe . '/api/nfe/captcha.json?apikey=' . $this->apikey); 
    }
    
    public function imagem($key){
       return $this->curl($this->danfe . '/api/nfe/imagem.json?apikey=' . $this->apikey . '&key=' . $key); 
    }

    // Essa função está desativada na API nesse momento.
    public function chave($chave) {
        return $this->curl($this->danfe . '/api/nfe/danfe.json?apikey=' . $this->apikey . '&chave=' . $chave);
    }

    public function chave_captcha($chave, $key, $captcha){
        return $this->curl($this->danfe . '/api/nfe/nfe_captcha.json?apikey=' . $this->apikey . '&chave=' 
                           . $chave . '&key=' . $key . '&captcha=' . $captcha);
    }
	
	public function xml($xml) {
        return $this->curl($this->danfe . '/api/nfe/danfe.json?apikey=' . $this->apikey, $xml);
    }
	
    public function erro($erro) {
        if (empty($this->errosDanfe[$erro])) {
            return $erro;
        } else {
            return $this->errosDanfe[$erro];
        }
    }

    private function curl($url, $post = "") {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (strlen($post) > 0) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
        return @curl_exec($ch);
    }

}
?>
