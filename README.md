<h1 align="center">
  AgendaSync
</h1>

<h4 align="center">Aplicação web para gerenciamento de agenda e contatos desenvolvida com <a href="https://laravel.com" target="_blank">Laravel</a>, <a href="https://vuejs.org/" target="_blank">Vue.js</a> e <a href="https://inertiajs.com/" target="_blank">Inertia.js</a>.</h4>
<div align="center">

https://github.com/user-attachments/assets/3b6538bb-241a-4a5f-b19d-ac8455ffa364
</div>

## Descrição

**AgendaSync** é uma aplicação web desenvolvida para facilitar o gerenciamento de contatos de forma simples e intuitiva. Focada em acessibilidade e usabilidade, a aplicação permite que os usuários organizem suas agendas pessoais ou profissionais de maneira eficiente. Oferecendo uma experiência consistente tanto em desktops quanto em dispositivos móveis.

## Funcionalidades

- **Cadastro e Gerenciamento de Contatos:** Adicione, edite e exclua contatos com facilidade. Cada usuário tem acesso exclusivo apenas aos seus próprios contatos, garantindo a privacidade e segurança das informações.
- **Integração com Google:** Acesso simplificado para usuários de contas Google, com segurança garantida.
- **Modo Escuro (Dark Mode):** Tema escuro para uma visualização confortável em ambientes com pouca luz.
- **Alertas Personalizados:** Notificações e alertas importantes diretamente na interface.
- **Interface Responsiva:** Design adaptável para uma experiência consistente em outros dispositivo.
- **Segurança:** Dados protegidos por autenticação segura, garantindo que apenas o usuário que criou um contato tenha acesso às suas informações. Outros usuários não têm acesso aos contatos de terceiros.

## Tecnologias Utilizadas

- **Frontend:**
  - Vue.js 3
  - Bootstrap 5
  - SweetAlert2

- **Backend:**
  - Laravel:

- **Banco de Dados:**
  - MySQL

- **Outras Tecnologias:**
  - Inertia.js

## Instalação

### Pré-requisitos

Antes de começar, certifique-se de ter instalado em sua máquina:

- [Node.js](https://nodejs.org/en/)
- [Composer](https://getcomposer.org/)

### Passos para Instalação

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/SeuUsuario/AgendaSync.git
   cd AgendaSync
   ```

2. **Instale as dependências do backend:**

   ```bash
   composer install
   ```

3. **Instale as dependências do frontend:**

   ```bash
   npm install
   ```

4. **Configure o arquivo .env:**

   Copie o arquivo `.env.example` para `.env` e ajuste as configurações conforme necessário:

   ```bash
   cp .env.example .env
   ```

5. **Gere uma nova chave de aplicação:**

   ```bash
   php artisan key:generate
   ```

6. **Configuração do banco de dados:**

   Configure as credenciais do banco de dados no arquivo `.env` e execute as migrações:

   ```bash
   php artisan migrate
   ```

7. **Inicie o servidor de desenvolvimento:**

   ```bash
   php artisan serve
   ```

8. **Acesse a aplicação:**
