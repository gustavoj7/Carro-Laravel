# gustavo Motors

Aplicação em Laravel desenvolvida para simular um portal de venda de veículos, nos moldes de Carros.com.br ou Webmotors. O projeto conta com vitrine pública de veículos e um painel administrativo protegido por autenticação com CRUD completo de marcas, modelos, cores e veículos (incluindo galeria de fotos via links).

## Stack principal

- Laravel 12 + PHP 8.2
- Breeze (Blade + Tailwind) para autenticação e fluxo de sessões
- MySQL (configurável via `.env`) e Eloquent ORM
- Vite para assets e Tailwind CSS para estilização

## Requisitos atendidos

- ✅ Área pública com listagem de todos os veículos, filtros básicos e página de detalhes com galeria completa
- ✅ Área administrativa com autenticação, middleware de administrador e dashboard responsivo
- ✅ CRUD de marcas, modelos, cores e veículos (com mínimo de 3 fotos via URL)
- ✅ Template único com `@extends`, `@section` e `@yield`, além de componentes reutilizáveis
- ✅ Seeder com dados reais (marcas, modelos, veículos) e usuário administrador pronto para uso

## Requisitos e preparação do banco

1. Tenha instalado: **PHP 8.2+**, **Composer 2.x**, **Node 18+**, **NPM**, **MySQL** em execução.
2. Crie o banco (padrão):  
   ```sql
   CREATE DATABASE gustavo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Copie o `.env` e configure as credenciais:
   ```bash
   cp .env.example .env
   ```
   Ajuste `DB_HOST`, `DB_USERNAME` e `DB_PASSWORD` conforme seu MySQL.  
   > Se preferir SQLite, basta definir `DB_CONNECTION=sqlite` e apontar para um arquivo em `database/database.sqlite`.

## Passo a passo para rodar

```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed   # cria as tabelas e popula dados/usuário admin

# Ambiente de desenvolvimento (dois terminais separados)
php artisan serve
npm run dev
```

Para gerar os assets sem precisar do Vite em tempo real, use `npm run build` e depois apenas `php artisan serve`.  
Se quiser recriar tudo do zero (inclusive dados), rode `php artisan migrate:fresh --seed`.

## Acesso ao sistema

- **Área pública:** `http://localhost:8000`
- **Painel administrativo:** `http://localhost:8000/admin`
- **Usuário administrador criado pelo seeder:**  
  - Email: `admin@gustavo.test`  
  - Senha: `senha123`

## Scripts úteis

- `php artisan migrate --seed` – aplica migrations e roda o seeder inicial
- `php artisan migrate:fresh --seed` – recria o banco com dados iniciais
- `php artisan test` – executa a suíte de testes (quando adicionados)
- `npm run build` – gera os assets minificados para produção

## Estrutura principal

- `resources/views/layouts` – templates base da área pública e administrativa
- `app/Http/Controllers/Admin` – CRUDs protegidos por middleware `admin`
- `app/Models` – entidades principais (Marca, Modelo, Cor, Veículo e Fotos)
- `database/seeders/InitialDataSeeder.php` – dados de exemplo + usuário admin

## Próximos passos sugeridos

- Implementar upload real de imagens caso o armazenamento em links não seja suficiente
- Adicionar filtros avançados (ano, faixa de preço, quilometragem) na vitrine pública
- Criar testes de feature para os fluxos críticos do painel administrativo

Bom trabalho e boas vendas! 🚗


![alt text](<COROLLA 1.png>) ![alt text](<CHEVROLET TRACKER CINZA 1.png>) ![alt text](<HONDA HR AZUL 1.png>)