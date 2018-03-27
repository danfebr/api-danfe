# API para gerar DANFE / XML pela chave de acesso da NFe

O DANFE..br.com, disponibiliza uma API para emitir o DANFE e o XML da NFe, utilizando a chave de acesso da nota fiscal eletrônica. Com a nossa API você não tem dificuldades, e também não paga nada por isso, basta <a href="https://danfe.br.com/app/cadastro" target="_blank" rel="noopener">criar uma conta</a> em nosso sistema para ter acesso a esse recurso.

Depois que você criar a sua conta em nosso sistema, <a href="https://danfe.br.com/app/login">efetue o login</a>, agora vamos liberar o acesso da API em sua conta, acesse a opção do menu <a href="https://danfe.br.com/app/sistema">configurações &gt; sistema</a>, dentro das configurações do sistema ative a opção "<em>Permitir o uso da API em minha conta?</em>".

<img class="size-medium wp-image-23" src="http://blog.danfe.br.com/wp-content/uploads/2018/03/configuracoes-sistema-uso-api-300x103.png" alt="configurações &gt; sistema" width="300" height="103" />

Agora vamos pegar a sua API Key, ela garante que todas as notas fiscais eletrônicas caiam diretamente na sua conta, assim se você precisar enviar por e-mail, ou perder a chave de acesso, você tem tudo armazenado em nosso sistema, e pode recuperar a sua NFe em poucos minutos, e muitas outras funções além dessas.
Para ter acesso a sua API Key acesse o menu <a href="https://danfe.br.com/app/apikey">configurações &gt; api key</a>, basta copiar a sua api key.

<img class="size-medium wp-image-24" src="http://blog.danfe.br.com/wp-content/uploads/2018/03/configuracoes-api-key-300x183.png" alt="configurações &gt; api key" width="300" height="183" />

Pronto, o DANFE está configurado para gerar o XML e o PDF da nota fiscal eletrônica. agora ficou fácil é só colocar o DANFE.br.com para trabalhar...
<h2>- API DANFE</h2>
<h3>Endereço da API</h3>
<table>
<thead>
<tr>
<th>URL</th>
<th>Formatos</th>
</tr>
</thead>
<tbody>
<tr>
<td>http://danfe.br.com/api/nfe/danfe.json</td>
<td>.json, .jsonp, .xml, .csv, .php e .html</td>
</tr>
</tbody>
</table>

<div class="code-block">
<h3>modelo de uso:</h3>
<strong>Método HTTP GET:</strong> apikey e chave
http://danfe.br.com/api/nfe/danfe.json?apikey=API_KEY&amp;chave=CHAVE_DE_ACESSO
</div>

<h3>Erros da API (status = false)</h3>
<table>
<thead>
<tr>
<th>Erro</th>
<th>Descrição</th>
</tr>
</thead>
<tbody>
<tr>
<td>ERRO_APIKEY_INVALIDA</td>
<td>A API Key é inválida, ela deve ter 32 caracteres, somente letras e números.</td>
</tr>
<tr>
<td>ERRO_APIKEY_INEXISTENTE</td>
<td>A API Key não existe, verifique se você mudou a chave da sua API.</td>
</tr>
<tr>
<td>ERRO_API_ACESSO</td>
<td>Conta sem liberar o acesso da API. Verifique no menu (configurações &gt; sistema).</td>
</tr>
<tr>
<td>ERRO_CHAVE_INVALIDA</td>
<td>Verifique a chave de acesso da NFe.</td>
</tr>
<tr>
<td>ERRO_RECEITA</td>
<td>Variável adicional "mensagem" com erro fornecido pelo portal da NFe.</td>
</tr>
<tr>
<td>ERRO_RECEITA_OBTER_DADOS</td>
<td>Portal da NFe temporariamente offline.</td>
</tr>
</tbody>
</table>
<h3>Sucesso da API (status = true)</h3>
<table>
<thead>
<tr>
<th>Variável</th>
<th>Descrição</th>
</tr>
</thead>
<tbody>
<tr>
<td>xml</td>
<td>Endereço com XML da NFe</td>
</tr>
<tr>
<td>pdf</td>
<td>Endereço com PDF da NFe</td>
</tr>
</tbody>
</table>
