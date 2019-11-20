### PROJETO BACK-END - VERTEX DIGITAL - Aplicação WEB feita em linguagem PHP

Esta é uma API para armazenamento de contatos, uma agenda que contém dados simples: nome, telefone, email e CEP. O CEP é validado através de uma API pública chamada <a href="https://viacep.com.br/">ViaCEP</a>.

<b>1. Pré-requisitos:</b>

- <i>Composer</i>
- <i>MySQL</i>
- <i>PHP</i>

<b>2. Instalação:</b>

- Antes de tudo, deve-se instalar as dependências do projeto, utilizando o comando:
```
    composer install
```
- Em seguida, criar o banco de dados no MySQL com o comando CREATE DATABASE <i>nomedobanco</i> e atualizar os arquivos <i><b>.env</i></b> e <i><b>app/config/database.php</i></b>:
```
    (verificar se o host e a porta estão iguais no MySQL e nos arquivos do PHP)

    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=/*nome do banco de dados*/
    DB_USERNAME=/*inserir nome de usuario aqui*/
    DB_PASSWORD=/*inserir senha aqui*/
```
    e
```
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', '/*nome do banco de dados*/'),
    'username' => env('DB_USERNAME', '/*inserir nome de usuario aqui*/'),
    'password' => env('DB_PASSWORD', '/*inserir senha aqui*/'),
```
- Após isso, rodar os comandos abaixo para criar e popular as tabelas no banco de dados:
```
    php artisan migrate<br>
    php artisan db:seed (Este comando é opcional. Ele apenas irá popular a tabela de contatos para fim de verificação)
```
- Após as etapas acima serem realizadas, o programa está pronto para uso. Execute o comando abaixo para iniciar a API:
```
    php artisan serve
```
<b>3. Endpoints:</b>

A API possui três funcionalidades: criação de contatos, listagem e exclusão de contatos. Os endpoints da aplicação são descritos a seguir:

Requisição   | Caminho                          | Ações        | Nome da rota
-------------|----------------------------------|--------------|------------------
GET          | /contatos                        | index        | ContatoController@index
POST         | /contato/novo                    | store        | ContatoController@store
GET          | /contato/busca/id/{id}           | showId       | ContatoController@showId
GET          | /contato/busca/nome/{nome}       | showNome     | ContatoController@showNome
GET          | /contato/busca/email/{email}     | showEmail    | ContatoController@showEmail
DELETE       | /contato/apagar/{id}             | destroy      | ContatoController@destroy

<br>
<b>4. Funcionalidades:</b>
<br>
   <b><i>4.1. Listagem:</b></i>

A função index faz uma requisição GET à API e retorna em JSON todos os contatos cadastrados no banco de dados. Ela é executada na URL http://localhost:8000/api/contatos.

A aplicação possui filtros de pesquisa. Através da URL http://localhost:8000/api/contato/busca/id/{id}, será retornado um JSON específico e unico referente ao id pesquisado. Caso o usuário precise realizar uma busca pelo nome, deve ser feito na URL http://localhost:8000/api/contato/busca/nome/{nome}. O resultado será um ou mais JSON referentes ao nome pesquisado, ou vazio se não for encontrado nenhum cadastro referente a esse nome. Para buscas por email, deve-se realizar na URL http://localhost:8000/api/contato/busca/email/{email}. O funcionamento é parecido com a busca pelo nome, retornando (ou não) um ou mais JSON dados referentes à busca, em formato JSON.

   <b><i>4.2. Cadastro</b></i>

O cadastro de um novo contato é feito pela URL http://localhost:8000/api/contato/novo. Deve ser informado o nome, telefone, email e CEP da pessoa a ser cadastrada. O CEP é verificado em tempo real através da API ViaCEP. As informações deste CEP são armazenadas em um objeto e inseridas em uma tabela do banco de dados, que possui a finalidade de persistir os dados dos CEPs. Caso o CEP já exista nessa tabela, ele não é inserido novamente, ou seja, não há informações repetidas. Caso o CEP seja válido, o cadastro é realizado com sucesso; se não, uma mensagem é exibida informando que aquele CEP não é válido e interrompendo todo o processo.

   <b><i>4.3. Exclusão</b></i>

Caso o usuário queira deletar um contato, utiliza-se a URL http://localhost:8000/api/contato/apagar/{id}. Informa-se o id do usuário a ser apagado e pronto, ele é totalmente deletado da base de dados.
<br>
<br>
    
<b>ATENÇÃO</b>:

Para o funcionamento da API ViaCEP, a versão do PHP instalada deve ser maior ou igual a 5.3.0, e a versão do Laravel deve ser ~5.0. A que foi utilizada nesse projeto é a 5.8.18. Caso seja atualizada para uma versão acima, a API ViaCEP <b>NÃO</b> irá funcionar.

<br>
<br>

- [x] API em funcionamento
- [ ] Implementar testes
- [ ] (EM ABERTO) Adicionar novas funcionalidades

<br>
<br>

Autor: Leonardo de Figueiredo Meliande

   <IMG SRC="https://pa1.narvii.com/6445/2effbe46653f3c5604386e6802c9e7ea8de0f46a_hq.gif">  
