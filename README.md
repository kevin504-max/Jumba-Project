### Configuração do Banco de Dados
Crie um banco de dados vazio no seu servidor MySQL.
Execute o script SQL fornecido (dadosb3.sql) para criar a tabela.

### Configuração da Aplicação Laravel
Navegue até a pasta `laravel` do projeto.
Execute o comando `composer install` para instalar as dependências do Laravel.
Abra o arquivo `.env` e atualize as configurações do banco de dados de acordo com a sua instalação.
Execute o comando `php artisan serve` para iniciar o servidor de desenvolvimento do Laravel.
A aplicação Laravel estará disponível em `http://localhost:8000`.

### Configuração da Aplicação Vue.js
Navegue até a pasta `vue/dadosb3-project` do projeto.
Execute o comando `npm install` para instalar as dependências do Vue.js.
Execute o comando `npm run serve` para iniciar o servidor de desenvolvimento do Vue.js.
A aplicação Vue.js estará disponível em `http://localhost:8080`.

### Comando Artisan
Para efetuar a importação dos dados execute o comando: `php artisan app:import-dados-b3-from-web`

### Acesso ao Projeto
Após configurar e executar ambas as aplicações, você poderá acessar o projeto no seu navegador. As seguintes URLs estarão disponíveis:

```bash
Laravel: http://localhost:8000
Vue.js: http://localhost:8080
```

Certifique-se de ter ambas as aplicações em execução simultaneamente para acessar todas as funcionalidades do projeto.

### Considerações Finais
Aplicação desenvolvida para baixar e apresentar de modo qualitativo dados do site da B3, mais especificamente da parte de Posições em Aberto de Empréstimo de Ativos.

Observação: Certifique-se de que os pré-requisitos, como o PHP, Composer e Node.js, estejam devidamente instalados em sua máquina antes de prosseguir com as etapas acima.

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
### English Version

### Database Configuration
Create an empty database on your MySQL server.
Execute the provided SQL script (dadosb3.sql) to create the table.

### Laravel Application Configuration

Navigate to the `laravel` folder of the project.
Run the command `composer install` to install Laravel dependencies.
Open the `.env` file and update the database configuration according to your installation.
Run the command `php artisan serve` to start the Laravel development server.
The Laravel application will be available at `http://localhost:8000`.

### Vue.js Application Configuration

Navigate to the `vue/dadosb3-project` folder of the project.
Run the command `npm install` to install Vue.js dependencies.
Run the command `npm run serve` to start the Vue.js development server.
The Vue.js application will be available at `http://localhost:8080`.

### Artisan Command

To import the data, execute the command: `php artisan app:import-dados-b3-from-web`

### Project Access

After configuring and running both applications, you can access the project in your browser. The following URLs will be available:

```bash
Laravel: http://localhost:8000
Vue.js: http://localhost:8080
```

Make sure to have both applications running simultaneously to access all project functionalities.

### Final Considerations

This application was developed to download and present qualitatively data from the B3 website, specifically regarding Open Positions for Asset Loans.

Note: Make sure that prerequisites such as PHP, Composer, and Node.js are properly installed on your machine before proceeding with the above steps.
