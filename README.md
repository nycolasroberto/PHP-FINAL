# Fórum Universitário

Sistema de fórum desenvolvido em PHP com arquitetura MVC para discussões acadêmicas.

## Funcionalidades

### 3 CRUDs Implementados:
1. **Usuários** - Cadastro, edição, listagem e exclusão de usuários
2. **Posts/Tópicos** - Criação, edição, visualização e exclusão de discussões
3. **Comentários** - Adição, visualização e exclusão de comentários

### Páginas de Navegação Aberta:
1. **Início** - Página principal com apresentação do fórum
2. **Sobre** - Informações sobre o projeto e como funciona
3. **Regulamento** - Regras e diretrizes de uso do fórum

### Sistema de Autenticação:
- Login com email e senha
- Cadastro de novos usuários
- Recuperação de senha (validando CPF e data de nascimento)
- Sistema de sessões e cookies
- Logout seguro

### Segurança:
- Proteção CSRF em todos os formulários
- Senhas criptografadas com hash
- Validação de dados de entrada
- Sessões seguras

### Arquitetura:
- **MVC** - Model, View, Controller
- **POO** - Classes para User, Post, Comment
- **PDO** - Conexão segura com MySQL
- **HTML5** - Tags semânticas
- **CSS3** - Design responsivo e moderno

## Instalação

1. **Configurar banco de dados:**
   - Crie um banco MySQL chamado `forum_universitario`
   - Execute o script `sql/database.sql` no phpMyAdmin

2. **Configurar conexão:**
   - Edite `config/database.php` com suas credenciais do MySQL

3. **Estrutura de arquivos:**
```
/
├── index.php (controlador principal)
├── config/
│   ├── database.php
│   └── csrf.php
├── models/
│   ├── User.php
│   ├── Post.php
│   └── Comment.php
├── controllers/
│   ├── UserController.php
│   ├── PostController.php
│   └── CommentController.php
├── views/
│   ├── includes/
│   │   ├── header.php
│   │   └── footer.php
│   ├── home.php
│   ├── about.php
│   ├── rules.php
│   ├── login.php
│   ├── register.php
│   ├── forgot-password.php
│   ├── forum.php
│   ├── post-detail.php
│   ├── create-post.php
│   ├── edit-post.php
│   ├── profile.php
│   ├── admin.php
│   └── 404.php
├── css/
│   └── style.css
├── js/
│   └── main.js
└── sql/
    └── database.sql
```

## Credenciais de Teste

**Administrador:**
- Email: admin@forum.edu.br
- Senha: admin123

## Tecnologias Utilizadas

- **PHP 8+** - Linguagem backend
- **MySQL** - Banco de dados
- **HTML5** - Estrutura semântica
- **CSS3** - Design responsivo
- **JavaScript** - Interatividade frontend
- **PDO** - Conexão com banco de dados
- **Sessions & Cookies** - Gerenciamento de estado
- **CSRF Protection** - Segurança

## Estruturas de Controle Utilizadas

- **Switch** - Roteamento de páginas no index.php
- **If/Else/ElseIf** - Validações e controle de fluxo
- **Foreach** - Listagem de posts, comentários e usuários
- **While** - Não utilizado diretamente (PDO fetchAll usado)
- **For** - Utilizado no JavaScript para loops

## Recursos de Segurança

1. **Tokens CSRF** em todos os formulários
2. **Validação de entrada** em todos os controllers
3. **Senhas hash** com password_hash()
4. **Sessões seguras** com regeneração de ID
5. **Prepared statements** contra SQL injection
6. **Escape de HTML** contra XSS

## Design e UX

- Design moderno com gradientes e sombras
- Layout responsivo para todos os dispositivos
- Animações CSS suaves
- Sistema de alertas e notificações
- Navegação intuitiva
- Formatação automática de CPF
- Validação de formulário em tempo real

## Funcionalidades Extras

- Painel administrativo
- Estatísticas de usuário
- Categorização de posts
- Sistema de busca por categoria
- Contador de posts e comentários
- Auto-hide de mensagens de sucesso/erro
- Confirmação antes de deletar itens