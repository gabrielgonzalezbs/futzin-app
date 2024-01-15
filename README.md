<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Futzin APP

Aplicativo de controle e manutenção de jogadores e partidas de futebol, desenvolvido utilizando a versão 10.10 do framework **LARAVEL** com o starter kit [**LARAVEL BREEZE**](https://laravel.com/docs/10.x/starter-kits#laravel-breeze). 

Link da aplicação: [Futzin APP](https://futzin-app-laravel-5bbc24befe8d.herokuapp.com)


## Banco de dados

Para armazenamento das informações do sistema, o bando de dados escolhido foi o **MySQL**, abaixo esta o link onde é possível visualizar o diagrama do banco de dados. 

Os dados de configuração estão listados na seção de **Instalação**.

[Diagrama do Banco de Dados](https://dbdiagram.io/d/Futzin-APP-65a0a200ac844320aec1b78f)


## Funcionalidades

- Temas dark e light
- Multiplataforma
- Recuperação de Senha
- Cadastro de jogares
- Cadastro de partidas e escolha dos jogadores que irão participar daquele jogo 
- Soteio de jogares e montagem das equipes.


## Instalação/Rodando localmente

Após ter realizado o clone ou o fork do projeto, será necessário instalar os pacotes do LARAVEL utilizando o comando `composer install` e os pacotes do tailwindcss com o comando `npm install`

```bash
  composer install
  npm install
```

Após concluir a instalação dos pacotes, realize a configuração do banco de dados no arquivo `.env`, que fica na raiz do projeto. Encontre o bloco de código destinado para a configuração do banco de dados e adicione a configuração que você deseja.


```
... 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=futzin_app
DB_USERNAME=root
DB_PASSWORD=exemplo_readme

...

```

Concluída a configuração do banco de dados, agora é necessário rodar as migrations do projeto e deixar a aplicação pronta para uso, para rodar as migrations basta executar o comando `php artisan migrate`.

 ```bash
 php artisan migrate 
 ```

Se você chegou até aqui, sua aplicação esta pronta para ser utilizada. Para executa-la rode o comando `php artisan serve`.

```bash
php artisan serve
```

Conforme mencionado anteriormente, este projeto utilizou o starter kit Breeze, essa implementação possuí um sistema de recuperação de senha que faz o envio de um email. **Esta configuração é opcional**, mas pode ser de grande valia ter essa funcionalidade em sua aplicação. Para realizar a configuração de um servidor de envio de email, vá até o arquivo `.env` na raiz do projeto e faça as alterçaões necessárias no bloco de configuração de email.

```
...

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=futzin@futzin.com
MAIL_PASSWORD=futzin
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@futzin.com"
MAIL_FROM_NAME="${APP_NAME}"

...

```
## Deploy

Para fazer o deploy desse projeto rode o comando `npm run build` para preparar os arquivos do VITE.

```bash
  npm run build
```

A versão de produção desta applicação esta hospedada no HEROKU, e possuí uma configuração de deploy automatico.

## Autor

- [@gabrielgonzalezbs](https://github.com/gabrielgonzalezbs)

