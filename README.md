# Onfly Bills
> Api de controle de despesas.

[![My Skills](https://skillicons.dev/icons?i=php,laravel,mysql,nginx,docker&perline=5)](https://skillicons.dev)

Gerencie as depesas dos seus usuários de forma rápida e prática.

![](header.png)

## Instalação

OS X, Linux & Windows:

```sh
docker-compose up -d --build app
```
Os serviços estarão expostos nas seguintes portas:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`

Estaram disponíveis 3 containers para gerenciar o Composer, o NPM e o Artisan sem a necessidade destes estarem instalados na sua máquina. Use os comandos a seguir como exemplo adequando-os à sua necessidade:

```sh
docker-compose run --rm composer update # Gerenciador do composer
docker-compose run --rm npm run dev # Gerenciador do npm
docker-compose run --rm artisan migrate # Gerenciador do artisan
```
## Configuração de desenvolvimento

Com a aplicação de pé após rodar o *docker build + up*, atualize os pacotes do *composer* para garantir que todos estão instalados corretamente e, em seguida, execute o *artisan migrate*:

```sh
docker-compose run --rm composer update # Atualize os pacotes
docker-compose run --rm artisan migrate # Execute as migrations
```
## Como usar

Se você utiliza o Insomnia como o seu API Client, basta importar a [Insominia Collection](./docs/Insomnia_2023-08-22.json). Caso utilize outro API Client, basta utilizar o [Http Archive](./docs/httpArch.har). Também está disponível um [Swagger](./docs/openapi.yml) documentando as rotas da api.

## Testes

Para executar todos os testes (Unit e Feature) basta executar o nosso container gerenciador do *artisan*:

```sh
docker-compose run --rm artisan test # Executar os testes
```

## Meta

Higor Rocha – [@Instagram](https://www.instagram.com/programadorhigor/) [@Linkedin](https://www.linkedin.com/in/higorsrocha/)

<!-- Markdown link & img dfn's -->
[npm-image]: https://img.shields.io/npm/v/datadog-metrics.svg?style=flat-square
[npm-url]: https://npmjs.org/package/datadog-metrics
[npm-downloads]: https://img.shields.io/npm/dm/datadog-metrics.svg?style=flat-square
[travis-image]: https://img.shields.io/travis/dbader/node-datadog-metrics/master.svg?style=flat-square
[travis-url]: https://travis-ci.org/dbader/node-datadog-metrics
[wiki]: https://github.com/yourname/yourproject/wiki
