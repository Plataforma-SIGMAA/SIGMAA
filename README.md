<h1 align="center">Projeto SIGMAA</h1>
<h2 align="center">Sistema Integrado de Gestão de Materiais e Atividades Acadêmicas</h2>
<br>
<p align="center">
  <img src="https://img.shields.io/static/v1?label=Laravel&message=API%20Backend&color=red&style=for-the-badge&logo=laravel"/>
  <img src="https://img.shields.io/static/v1?label=Next.js&message=Frontend&color=black&style=for-the-badge&logo=nextdotjs"/>
  <img src="https://img.shields.io/static/v1?label=React&message=Frontend&color=blue&style=for-the-badge&logo=react"/>
  <img src="https://img.shields.io/static/v1?label=CSS&message=Estilização&color=purple&style=for-the-badge&logo=css"/>

  <img src="https://img.shields.io/static/v1?label=MySQL&message=Database&color=blue&style=for-the-badge&logo=mysql"/>
  <img src="https://img.shields.io/static/v1?label=JWT&message=Authentication&color=darkgreen&style=for-the-badge&logo=jsonwebtokens"/>
  <img src="https://img.shields.io/static/v1?label=Laravel&message=Migrations&color=red&style=for-the-badge&logo=laravel"/>
  <br>

  <img src="http://img.shields.io/static/v1?label=License&message=MIT&color=green&style=for-the-badge"/>
  <img src="http://img.shields.io/static/v1?label=STATUS&message=EM%20DESENVOLVIMENTO&color=RED&style=for-the-badge"/>
</p>

<br>

> Status do Projeto: ⚠️ Em desenvolvimento

### Tópicos

🔹 [Descrição do projeto](#descrição-do-projeto)
🔹 [Funcionalidades](#funcionalidades)
🔹 [Layout da aplicação](#layout-da-aplicação)
🔹 [Pré-requisitos](#pré-requisitos)
🔹 [Como rodar a aplicação](#como-rodar-a-aplicação)
🔹 [Como rodar os testes](#como-rodar-os-testes-do-backend)
🔹 [Casos de uso](#casos-de-uso)
🔹 [JSON de usuários](#json)
🔹 [Linguagens, dependências e bibliotecas](#linguagens-dependências-e-bibliotecas-utilizadas-)
🔹 [Tarefas em aberto](#tarefas-em-aberto)
🔹 [Desenvolvedores](#desenvolvedores-octocat)
🔹 [Licença](#licença)

## Descrição do projeto

<p align="justify">
O SIGMAA é uma plataforma desenvolvida para atender a necessidade de gerenciamento e integração de informações acadêmicas. O sistema foi idealizado e está sendo desenvolvido na disciplina de Desenvolvimento de Sistemas do 3° ano do Curso Técnico em Informática para Internet do Instituto Federal de Ciência, Tecnologia e Educação do Rio Grande do Sul (IFRS) - <i>Campus</i> Bento Gonçalves.

Tecnicamente, ela foi arquitetada sobre o <i>framework</i> Laravel (PHP) para o back-end, o qual funciona como API RESTful, e Next.js (React) para o front-end, com JavaScript, HTML e CSS, proporcionando uma interface <i>web</i> moderna e responsiva para manipulação, exibição e análise de dados acadêmicos.

Assim, a proposta do SIGMAA é facilitar o acesso, manutenção e colaboração em dados acadêmicos institucionais, centralizando informações de alunos, turmas, disciplinas, notas, trabalhos, frequências e outros registros educacionais.

</p>

## Funcionalidades

✔️ Cadastro de Alunos, Professores, Turmas e Disciplinas

✔️ Sistema de login para usuários

✔️ Gerenciamento de Atividades, Notas e Frequências

✔️ Visualização de Dados de Disciplinas

✔️ Opções de Administrador

## Layout da Aplicação

> A aplicação ainda não possui deploy público.  
> Abaixo estão algumas capturas de tela do sistema em ambiente local:

### Tela de Login

<img src="api/public/storage/readme/login.png" width="40%" height="40%" alt="Tela de Login">

### Home - Acadêmico (Aluno ou Professor)

<img src="api/public/storage/readme/academico_prototipo.png" width="40%" height="40%" alt="Visão do Sistema de um Aluno ou Professor">

### Home - Administrador

<img src="api/public/storage/readme/admin_prototipo.png" width="40%" height="40%" alt="Visão do Sistema de um Administrador">

### Disciplina

<img src="api/public/storage/readme/disciplina_prototipo.png" width="40%" height="40%" alt="Tela de Disciplina">

### Participantes

<img src="api/public/storage/readme/participantes_prototipo.png" width="40%" height="40%" alt="Tela de Participantes">

## Pré-requisitos

⚠️ [PHP >= 8.2](https://www.php.net/downloads.php)  
⚠️ [XAMPP (MySQL)](https://www.apachefriends.org/pt_br/index.html)  
⚠️ [Composer](https://getcomposer.org/download/)  
⚠️ [Node.js >= 18](https://nodejs.org/en/download/)  
⚠️ [MySQL >= 8.0](https://dev.mysql.com/downloads/)  
⚠️ [Git](https://git-scm.com/downloads)

## Como rodar a aplicação

No terminal, clone o projeto:

```
git clone https://github.com/Plataforma-SIGMAA/SIGMAA
```

Instale as dependências do backend PHP:

```
cd api
composer install
```

Instale as dependências do frontend:

```
cd ..
cd app
npm i
```

Acesse a pasta "api".

Copie e cole o arquivo `.env.example`, o qual está na pasta "api", renomei-o para apenas `.env` e o preencha com as suas informações de ambiente (banco de dados, etc):

```
DB_CONNECTION=mysql
DB_HOST=(seu host)
DB_PORT=(sua porta)
DB_DATABASE=sigmaa
DB_USERNAME=(seu usuário)
DB_PASSWORD=(sua senha)


# Edite o resto conforme necessário
```

Acesse o terminal da pasta.

Gere as chaves iniciais para esta aplicação Laravel:

```
php artisan key:generate
php artisan jwt:secret
```

Execute as migrations junto aos seeders do banco de dados:

```
php artisan migrate --seed
```

Inicie o servidor backend local:

```
php artisan serve
```

Abra uma nova guia do terminal

Acesse o terminal da pasta "app" e inicie o servidor frontend local:

```
npm run dev
```

Após isso, o sistema deve funcionar. Abra a URL local gerada pelo Next que está no terminal para visualizá-lo.

## Como rodar os testes do Backend

Acesse `api/tests/Feature`

Siga a estrutura de modelo que está em AuthTest.php

Crie um arquivo na pasta e configure os testes necessários nessa estrutura

Rode com:

```
php artisan test tests/Feature/(Nome_do_arquivo_criado).php
```

Lembre-se de passar todos os campos necessários para o banco

## Casos de Uso

- O administrador gerencia alunos, professores, turmas e disciplinas.
- O professor gerencia notas, frequências e atividades.
- O aluno visualiza suas informações acadêmicas (disciplinas, participantes dela, suas notas e suas frequências).
- Os usuários (administradores, professores e alunos) fazem login.
-

## JSON

### Usuários:

| Nome          | Email                | Senha       |
| ------------- | -------------------- | ----------- |
| Administrador | admin@escola.com     | admin01     |
| Professor     | professor@escola.com | professor01 |
| Aluno         | aluno@escola.com     | aluno01     |

## Linguagens, dependências e bibliotecas utilizadas

- [PHP](https://www.php.net/)
- [JavaScript](https://developer.mozilla.org/pt-BR/docs/Web/JavaScript)
- [HTML5](https://developer.mozilla.org/pt-BR/docs/Web/HTML)
- [CSS3](https://developer.mozilla.org/pt-BR/docs/Web/CSS)
- [Laravel](https://laravel.com/)
- [JWT Auth](https://github.com/php-open-source-saver/jwt-auth)
- [Pest PHP](https://pestphp.com/)
- [Faker PHP](https://fakerphp.github.io/)
- [Next.js](https://nextjs.org/)
- [React](https://react.dev/)
- [Axios](https://axios-http.com/ptbr/docs/intro)
- [React Toastify](https://fkhadra.github.io/react-toastify/)
- [SweetAlert2](https://sweetalert2.github.io/)

## Tarefas em aberto

📝 Versão para Ensino Superior

📝 Repartição maior de módulos e cargos

📝 Abas de Projetos

📝 Seção para Extensão e Pesquisa/Inovação

📝 Emissão de Documentos (como boletim escolar)

📝 Cadastro de Horas-Extra e Notas de Estágios

📝 Diferentes formas de inserção de notas e frequência aos docentes

📝 Entre outras...

## Desenvolvedores :octocat:

<p>Ana Amália Pilotto Cenci:</p>

> Desenvolvedora e Arquiteta do Banco de Dados, e Fullstack

<p>Ariel Mattei Bisatto:</p>

> Analista e Desenvolvedor Fullstack

<p>Arthur Vitório Sbeghen:</p>

> Analista, Desenvolvedor Fullstack e Revisor

<p>Bruno Arend:</p>

> Desenvolvedor e Arquiteto do Banco de Dados, e Fullstack

<p>Enrico Dalmas Parolin:</p>

> Desenvolvedor Fullstack e Revisor

<p>Kauã Basso:</p>

> Analista, Designer e Desenvolvedor de UX/UI

<p>Rômulo Eduardo Girotto:</p>

> Arquiteto do Banco de Dados e Desenvolvedor Fullstack

<p>Sarah Tumelero da Silveira:</p>

> Designer e Desenvolvedora de UX/UI

## Licença

The [MIT License](https://github.com/Plataforma-SIGMAA/SIGMAA/blob/main/LICENSE) (MIT)

Copyright ©️ 2025 - SIGMAA

## Referência de Estrutura

Modelo de documentação baseado neste [template](https://gist.github.com/reginadiana/e044fe93ed81aa04a10361cb841c0409)
