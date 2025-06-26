## Sistema FEB (Frontend e Backend)

Frontend: Vue.js e Bootstrap Vue
Backend: Laravel 10 e Mysql 8

Projeto simples,  autenticação com usuário e CRUD na tabela produto. Breve exibição de meus conhecimentos.

## Requisitos

    Git
    NPM
    Composer
    Docker e Docker Compose

## Instalação

Baixar o sistema
git clone https://github.com/rkdbamberg/sistema.git


Vamos começar pelo Frontend

Abrir terminal

cd sistema
cd frontend
npm install
npm run serve

Pronto 

Abra outro terminal 

cd backend
composer install
cp .env.example .env

Edite ".env" e adicione de APP_URL:

APP_PORT=8000

Ainda em ".env" e edite as linhas de banco de dados:

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=db_sistema
DB_USERNAME=ricardo
DB_PASSWORD=password

Salve as alterações de .env

Abra terminal na pasta backend

Execute os comandos:

php artisan key:generate
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
sail up -d

Abrir o Browser

http://localhost:8080

 ** endereço é indicado ao rodar "npm run serve" no frontend

Se tudo der certo, sisteme rodará.
 




