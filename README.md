Configuração do Banco de Dados
Crie um banco de dados vazio no seu servidor MySQL.
Execute o script SQL fornecido (dadosb3.sql) para criar a tabela.

Configuração da Aplicação Laravel
Navegue até a pasta laravel do projeto.
Execute o comando composer install para instalar as dependências do Laravel.
Abra o arquivo .env e atualize as configurações do banco de dados de acordo com a sua instalação.
Execute o comando php artisan serve para iniciar o servidor de desenvolvimento do Laravel.
A aplicação Laravel estará disponível em http://localhost:8000.

Configuração da Aplicação Vue.js
Navegue até a pasta vue/dadosb3-project do projeto.
Execute o comando npm install para instalar as dependências do Vue.js.
Execute o comando npm run serve para iniciar o servidor de desenvolvimento do Vue.js.
A aplicação Vue.js estará disponível em http://localhost:8080.

Comando Artisan
Para efetuar a importação de dados execute o comando: php artisan php artisan app:import-dados-b3-from-web

Acesso ao Projeto
Após configurar e executar ambas as aplicações, você poderá acessar o projeto no seu navegador. As seguintes URLs estarão disponíveis:

Laravel: http://localhost:8000
Vue.js: http://localhost:8080
Certifique-se de ter ambas as aplicações em execução simultaneamente para acessar todas as funcionalidades do projeto.

Considerações Finais
Este projeto combina uma aplicação Laravel e uma aplicação Vue.js para fornecer funcionalidades relacionadas aos dados da B3.

Observação: Certifique-se de que os pré-requisitos, como o PHP, Composer e Node.js, estejam devidamente instalados em sua máquina antes de prosseguir com as etapas acima.
