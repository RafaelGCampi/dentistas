## Sobre o projeto
    CRUD de dentistas com especialidades
## Como executar
    -composer install
    -npm install
    
    Criar SCHEMA
    -CREATE SCHEMA `processoseletivo2021_rafael_goncalvescampi`;

    -copy .env.example .env
    -php artisan key:generate
    -php artisan migrate

    Gerar especialidades no banco de dados
    -php artisan db:seed EspecialidadesSeed
    
    Iniciar projeto
    -php artisan serve
