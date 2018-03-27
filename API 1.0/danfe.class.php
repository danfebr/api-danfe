<?php

# DANFE.br.com - API PHP

class Danfe {

    private $danfe,
            $apikey,
            $errosDanfe;

    public function __construct() {
        $this->danfe = "https://danfe.br.com";
        $this->apikey = ""; // SUA API KEY
        $this->errosDanfe = array(
            'ERRO_APIKEY_INVALIDA' => 'A API Key é inválida, ela deve ter 32 caracteres, somente letras e números',
            'ERRO_APIKEY_INEXISTENTE' => 'A API Key não existe, verifique se você mudou a chave da sua API.',
            'ERRO_API_ACESSO' => 'Conta sem liberar o acesso da API. Verifique no menu (configurações > sistema).',
            'ERRO_CHAVE_INVALIDA' => 'Verifique a chave de acesso da NFe.',
            'ERRO_RECEITA' => 'Erro receita.', // variável adicional "mensagem"
            'ERRO_RECEITA_OBTER_DADOS' => 'Portal da NFe temporariamente offline.'
        );
    }

    public function nfe($chave) {
        return $this->curl($this->danfe . '/api/nfe/danfe.json?apikey=' . $this->apikey . '&chave=' . $chave);
    }
	
    public function erro($erro) {
        if (empty($this->errosDanfe[$erro])) {
            return $erro;
        } else {
            return $this->errosDanfe[$erro];
        }
    }

    private function curl($url, $fields = array()) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (count($fields) > 0) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
        return @curl_exec($ch);
    }

}
?>