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

Tem que usar docker

# Como Usar

## Usuarios

### Criar

Para criar úsuarios acessamos a rota: api/Corridas/Usuarios usando o método POST, e enviamos as informações no seguinte formato:<br>
{
"name": "teste da silva",
"email": "teste@gmail.com"
}
A aplicação retornará o status code 200 se os dados forem inseridos corretamente.
Importante: o e-mail é um dado único, isso quer dizer que apenas um úsuario tem um e-mail registrado, não havendo assim dois ou mais úsuarios com o mesmo e-mail.

### Listar

Para acessar a lista de úsuarios basta acessar a rota: api/Corridas/Usuarios usando o método GET,
A aplicação trará um JSON no seguinte formato, além do status code 200:

[
{
"id": 1,
"name": "Carlos Souza",
"email": "carlos@gmail.com",
"corridas_feitas": "0"
},
{
"id": 2,
"name": "Marcelo Silva",
"email": "silvamarcelo@gmail.com",
"corridas_feitas": "1"
}
]
