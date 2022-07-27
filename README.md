
# Teste PHP - testello (Douglas Paiani)

Ambiente: Docker / PHP 8.1.0 / Laravel 9 / MySQL / phpmyAdmin / Composer (auto-instalado com o Docker)

A aplicação importa os dados do CSV para banco de dados em fila (Laravel Queue). São separdos em jobs, cada job faz o disparo de 1000 linhas, permitindo que o envio seja assícrono e sem timeout.

Utilizei o framework Laravel para criar as rotas e programar a fila, salvei em banco MySQL, disponibilizei o phpmyadmin num container que pode ser acessado por: http://localhost:8080 (server: mysql | user: root | pass: root)

O projeto está rodando na porta 80: http://localhost / http://localhost:80

## Subindo Docker
Executar "docker-compose up" na raiz do projeto via terminal para subir os 3 containers (laravel | mysql | phpmyadmin)

## Executando Migrations
Será necessário executar as migrations para montar banco de dados com a estrutura necessária para rodar a aplicação. Abra o terminal CLI do container LARAVEL e digite os seguintes comandos na ordem informada:


```bash
# cd laravel
```

```bash
# php artisan migrate
```
## Importando CSV
Para importar o arquivo CSV para o banco de dados acesse: http://localhost e insira o arquivo no input file e clique no botão azul.

A próxima tela terá instruções para rodar a lista de jobs, visto que o supervisor não está rodando para manter os processos em andamento full-time.

Para rodar a lista manualmente acesse o terminal CLI do container laravel e digite os seguintes comandos:

```bash
# cd laravel
```

```bash
# php artisan queue:work
```

Após rodar a lista os dados serão salvos no banco de dados (database), na tabela DADOS.

Desenvolvido em um MacOs M1 Monterey 12.4

## Meu portfólio

 - [douglaspaiani.com.br](https://douglaspaiani.com.br)
 - [Sistema Salário Maternidade](https://maternidadeonline.com.br)
