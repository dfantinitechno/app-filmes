## Sobre a aplicação
- Foi utilizado o framework Laravel
- Banco de dados MySql
- TailwindCSS

## Iniciando a aplicação

- As configurações de conexão com o banco estão no arquivo .env
- É necessário rodar 2 comandos para executar a aplicação, `npm run dev` e `php artisan serve`
- Abra http://127.0.0.1:8000/ no navegador para iniciar a aplicação

## Uso da aplicação

- Realizar cadastro para acessar o sistema
- O usuário logado poderá:  

    criar posts pedindo recomendações de filmes/séries  

    interagir com posts de outros usuários  

    finalizar um post, para que não tenha mais interações  

    excluir um post, caso não tenha nenhuma interação  

    acessar feed "geral" com todos os posts de todos os usuários  

    acessar feed "seguindo" com os posts que estamos interagindo  

- no feed "geral" mostrará todos os posts, com as opções de interação
- no feed "seguindo", mostrará somente os posts que o usuário interagiu, juntamente com a soma dos votos de cada post