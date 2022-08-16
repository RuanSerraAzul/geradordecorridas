<h1 align="left">Gerador de corridas</h1>

<p align="left">Este projeto é uma REST API, que usa Laravel e SQLite, para realizar opeações de iniciar,listar, cancelar, encerrar e pagar corridas. Também conta com operações básicas de adicionar,listar e deletar úsuarios e/ou motoristas.</p>

# Tabela de conteúdos

<!--ts-->

-   [Sobre](#Sobre)
-   [Instalação](#instalacao)
-   [Como usar](#como-usar)
    -   [Usuarios](#usuarios)
    -   [Motoristas](#motoristas)
    -   [Corridas](#Corridas)
-   [Testes](#testes)

## Sobre

Este projeto é um code challenge para a vaga de emprego de Desenvolvedor PHP Junior na empresa <a href="https://www.vadetaxi.com.br/">Vá de Táxi</a>.<br>
Optei por usar o Laravel, pela sua forte documentação, o que facilita na sua resolução de problemas, além de gostar bastante da sua organização, do padrão de arquitetura MVC, das suas várias ferramentas que facilitam bastante a escrita do código, além da facilidade de trabalhar com testes.<br>
Como banco de dados usei o SQLite, pois uma das regras do code challenge era que a aplicação não poderia depender de infraestrutura externa, o que para mim foi ótimo, já que nunca havia trabalhado com SQLite, então tive aqui a oportunidade de aprender e me aproximar de uma nova tecnologia.<br>
Optei pelo padrão REST API pela facilidade de trabalhar com a transferência de dados feita com HTTP utilizando JSON para receber e enviar dados.<br>

## Instalação

### Requisitos

-PHP 7.3+
-Composer

### Como instalar

Baixe este repositório usando o git da seguinte forma:<br>
**git clone https://github.com/RuanSerraAzul/geradordecorridas.git**

Navegue até o diretório do projeto e use<br>
**composer install**

Copiamos o .env.example como nosso .env principal<br>
**cp .env.example .env**

Criamos o nosso banco de dados usando<br>
**touch database/sqlite**

Vamos ao nosso .env e colocamos o caminho até o DB na linha "DB_DATABASE", deve ficar parecido com isso:
**DB_DATABASE= home/CodeChallenge-VDT/database/database.sqlite**

E rodamos as migrations para deixar o DB pronto pra uso da seguinte forma:<br>
**php artisan migrate**

Precisamos de alguns dados ficticios apenas para usar os testes de criação e cancelamento corrida, esses dados já estão preparados e para adicionarmos ao db basta usar o comando:<br>
**php artisan db:seed**

Feito isso, basta iniciar um servidor usando: <br>
**php artisan serve**
E a aplicação deve estar rodando no http://localhost:8000

# Como Usar

## Usuarios

### Criar

Para criar úsuarios acessamos a rota: api/Corridas/Usuarios usando o método POST, e enviamos as informações no seguinte formato:<br>

```javascript
[
    {
        "name": "teste da silva",
        "email": "teste@gmail.com",
    },
];
```

A aplicação retornará o status code 200 se os dados forem inseridos corretamente.
Importante: o e-mail é um dado único, isso quer dizer que apenas um úsuario tem um e-mail registrado, não havendo assim dois ou mais úsuarios com o mesmo e-mail.

### Listar

Para acessar a lista de úsuarios basta acessar a rota: api/Corridas/Usuarios usando o método GET,
A aplicação trará um JSON no seguinte formato, além do status code 200:

```javascript
[
    {
        "id": 1,
        "name": "Carlos Souza",
        "email": "carlos@gmail.com",
        "corridas_feitas": "0",
    },
    {
        "id": 2,
        "name": "Marcelo Silva",
        "email": "silvamarcelo@gmail.com",
        "corridas_feitas": "1",
    },
];
```

### Deletar

Para deletar um úsuario acessamos a rota: api/Corridas/Usuarios usando o protocolo DELETE e informando no corpo da requisição qual o ID do úsuario a ser deletado:

```javascript
[
    {
        "id": 1,
    },
];
```

<br>

## Motoristas

O processo é idêntico.

### Criar

Para criar Motorista acessamos a rota: api/Corridas/Motoristas usando o método POST, e enviamos as informações no seguinte formato:<br>

```javascript
[
    {
        "name": "teste da silva",
        "carro": "Fiat Uno",
    },
];
```

A aplicação retornará o status code 200 se os dados forem inseridos corretamente.

## Listar

### Listar

Para acessar a lista de úsuarios basta acessar a rota: api/Corridas/Motoristas usando o método GET,
A aplicação trará um JSON no seguinte formato, além do status code 200:

```javascript
[
    {
        "id": 1,
        "name": "Luis Dreher",
        "carro": "Fiat Uno",
        "corridas_feitas": "0",
        "saldo": "0.0",
    },
    {
        "id": 3,
        "name": "Samara Alves",
        "carro": "Honda Civic",
        "corridas_feitas": "0",
        "saldo": "0.0",
    },
];
```

### Deletar

Para deletar um motorista acessamos a rota: api/Corridas/Motoristas usando o protocolo DELETE e informando no corpo da requisição qual o ID do motorista a ser deletado:

```javascript
[
    {
        "id": 1,
    },
];
```

## Corridas

### Listar

Para listar todas as corridas acessamos a rota: api/Corridas/Corridas usando protocolo GET, o resultado retornado terá o seguinte o formato, alem do status code 200:

```javascript
[
    {
        "id": 1,
        "idUser": "1",
        "idDriver": "1",
        "valor": "10,15",
        "status": "encerrada",
        "pagamento": "pix",
        "pagamento_status": "pendente",
    },
];
```

### Adicionar

Para adicionar corridas acessamos a rota: api/Corridas/Corridas usando o método POST, informando no corpo da requisição o id do usuario que solicitou a corrida, o id do motorista que irá fazer a corrida, o valor da corrida e o metodo de pagamento, tal qual o exemplo:

```javascript
[
    {
        "idUser": 1,
        "idDriver": 1,
        "valor": 10.95,
        "pagamento": "pix",
    },
];
```

Se todos os dados forem inseridos corretamente, a aplicação retornará o status code 200. <br>
Importante: tanto o idUser quanto o idDriver devem estar registrado no banco de dados, do contrário, a aplicação retornará um erro.

### Encerrar

Para executar a função de pagamento de uma corrida, antes precisamos encerra-la, faremos isso usando a rota: api/Corridas/PagarCorridas e usaremos o método POST, e no corpo da requisição basta informar o Id da corrida que será encerrada:

```javascript
[
    {
        "id": 1,
    },
];
```

Importante: apenas corrida com o status "em andamento" serão encerradas, visto que não podemos encerrar uma corrida já encerrada, ou mesmo uma que foi cancelada.

### Pagar

Após encerrarmos as corridas, podemos paga-las, ao usar a rota: /api/Corridas/PagarCorridas usando o método POST, e informando o ID da corrida que será paga, da seguinte forma:

```javascript
[
    {
        "id": 1,
    },
];
```

Se todos os dados forem inseridos de maneira correta, a aplicação retornará um status code 200.<br>
Importante: Apenas corridas encerradas e com o status de pagamento pendente podem ser pagas, visto que não podemos pagar uma corrida em andamento ou mesmo uma cancelada.<br>
Importante: Após a corrida ser paga, o valor da corrida será adicionada para o saldo do respectivo motorista que a fez.

### Cancelar

Podemos tamém cancelar corridas que ainda estão "em andamento" e não foram pagas ainda. Para isso acessamos a rota: /api/Corridas/CancelarCorridas e inserimos no corpo da requisição o ID da corrida que queremos cancelar, da seguinte forma:

```javascript
[
    {
        "id": 1,
    },
];
```

Se todos os dados foram inseridos corretamente, a aplicação retornará o status code 200.<br>
Importante: apenas corridas com o status "em andamento" e com o status de pagamento "pendente" podem ser canceladas.

## Testes

Os testes foram escritos usando PHPunit, são bem simples e fáceis de rodar, basta usar os comandos

_php artisan test --filter UsersTests_ para testar as operações com úsuarios <br>
_php artisan test --filter MotoristasTests_ para testar as operações com motoristas<br>
_php artisan test --filter CorridasTests_ para adicionar uma corrida do 0 (usando os dados que seedamos para o nosso banco de dados, nós vamos iniciar,encerrar e pagar a corrida. após esse teste também criaremos outra corrida para testar a funcão de cancelamento)<br>
