# Site de comentários

English version [here](README-en.md).

## O projeto
Este é o projeto de um website produzido em PHP utilzando framework Laravel como camada back-end e frameowrks Bootstrap e jQuery para a camada de front-end.
Você pode utilizar todo este material como bem entender, para fins profissionais ou de estudo, não há licenças envolvidas porém peço se caso ocorra de ganhar algum dinheiro utilizando este conteúdo, que não se esqueça de mim... ;)

## Objetivo
O obejtivo deste projeto foi criar um website simples para inserção e exibição de comentários utilizando banco de dados não-relacional MongoDB, multi-idioma e com front-end responsivo e com possibilidade de mudança de estilos de forma dinâmica.
Este projeto é formado pelos seguintes recursos:
   1. **Laravel Framework** (Framework WEB PHP - *Versão **5.4.36***) [1]
   2. **Moloquent** (Plugin Laravel para integração MongoDB) [2]
   3. **Twitter Bootstrap** (Framework front-end - *Versão **3.3***) [3]
   4. **Jumbotron** (Template Bootstrap) [4]
   5. **jQuery** (Framework Javascript - *Versão **1.12.4***) [5]

## Pré-requisitos
- Servidor WEB Local;
- PHP versão igual à **5.6.30**;
- Módulo MongoDB para PHP (instalado e configurado);
- MongoDB versão igual à **3.4.3**, como **localhost** e com porta **27017**;
- Configuração de virtualhost **jobtest.local** apontando o document root para o diretório _"public"_ que se encontra dentro do diretório do projeto.

##  Instalação
- Clone este repositório ou faça o download do respositório e descompacte;
- Conceder permissões de leitura e gravação para todos os usuários (ou somente para o usuário que executa o serviço do servidor WEB) nos diretórios _"storage"_ e _"bootstrap/cache"_, encontrados na raiz do projeto, em em todos seus arquivos e subdiretórios;
- Criar banco de dados com nome _"jobtest"_ no **MongoDB**;
- Executar comando _"php artisan migrate --database=mongodb"_ (sem aspas) na raiz no projeto, mesmo nível de onde se encontra o diretório __"public"__, isto criará a estrutura de armazenamento no MongoDB. 

## Adicionar novo idioma
1. No arquivo _"app/config.php"_ adicionar a sigla do novo idioma (_sigla_ => _Nome do Idioma_) no array da chave:
    ```php
    "locales"
    ```
    **Exemplo:** Adicionando o idioma esperanto ao sistema, o valor final da chave será:  
    ```php
    "locales" => ["pt" => "Português", "en" => "English", "eo" => "Esperanto"]
    ```
2. Dentro do diretório _"resources/lang/"_ copiar algum arquivo de idioma _".json"_ já existente e renomeá-lo com o código do novo idioma, o mesmo inserido na chave anteriormente.  
    **Exemplo:** Para o idioma Esperanto, o nome do novo arquivo ficaria _"eo.json"_.
    
3. Editar todas as chaves existentes com os valores correpondentes das palavras e frases para o novo idioma.  
    **Exemplo:**
    ```json
    {
      "title": "String com o nome do título das páginas no novo idioma",
      "company": "Nome da empresa no novo idioma",
      "author": "Nome do autor",
      "project": "Nome do projeto...",
      ...
    }
 
## Referências
   1. **Laravel change language** - <https://mydnic.be/post/laravel-5-and-his-fcking-non-persistent-app-setlocale>
   2. **Laravel Ajax Form** - <http://itsolutionstuff.com/post/laravel-5-ajax-request-validation-exampleexample.html>
   3. **jQuery Color switcher** - <https://codepen.io/nevan/pen/dmklG>

[1]: http://www.laravel.com   "Laravel Framework - Framework WEB PHP"
[2]: https://moloquent.github.io/master/basic "An Eloquent model and Query builder with support for MongoDB"
[3]: http://getbootstrap.com "Bootstrap Front-end Framework"
[4]: http://getbootstrap.com/docs/3.3/examples/jumbotron/ "Jumbotron Template for Bootstrap"
[5]: http://jQuery.org   "jQuery  - Framework Javascript"
