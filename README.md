# Api Laravel Backend
API JSON REST em *Laravel*

# Especificação DB Mysql
Base de desenvolvedores estrutura:

```
nome: varchar
sexo: char
idade: integer
hobby: varchar
datanascimento: date
```
# API endpoints

```
GET /developers
Codes 200
```
Retorna todos os desenvolvedores

````json
{
    "data": [
      {
        "id": 1,
        "nome": "Iohan",
        "idade": 28,
        "sexo": "M",
        "hobby": "Futebol",
        "data_nascimento": "1993-01-30"
      }
    ],
    "links": {
        "first": "http://localhost:8000/api/developers?page=1",
        "last": "http://localhost:8000/api/developers?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/developers?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/developers",
        "per_page": 100,
        "to": null,
        "total": 0
    }
}
````

```
GET api/developers?
Codes 200 / 404
```
Retorna os desenvolvedores de acordo com o termo passado via querystring e
paginação
````json
{
    "data": [
      {
        "id": 1,
        "nome": "Iohan",
        "idade": 28,
        "sexo": "M",
        "hobby": "Futebol",
        "data_nascimento": "1993-01-30"
      }
    ],
    "links": {
        "first": "http://localhost:8000/api/developers?page=1",
        "last": "http://localhost:8000/api/developers?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": null,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/developers?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/developers",
        "per_page": 100,
        "to": null,
        "total": 0
    }
}
````

```
GET api/developers/{id}
Codes 200 / 404
```
Retorna os dados de um desenvolvedor
````json
{
  "data": {
    "id": 1,
    "nome": "Iohan",
    "idade": 28,
    "sexo": "M",
    "hobby": "Futebol",
    "data_nascimento": "1993-01-30"
  }
}
````


```
POST api/developers
Codes 201 / 400
```
Adiciona um novo desenvolvedor
````json
{
  "data": {
    "id": 1,
    "nome": "Iohan",
    "idade": 28,
    "sexo": "M",
    "hobby": "Futebol",
    "data_nascimento": "1993-01-30"
  }
}
````

```
PUT api/developers/{id}
Codes 200 / 400
```
Atualiza os dados de um desenvolvedor
````json
{
  "data": {
    "id": 1,
    "nome": "Iohan",
    "idade": 28,
    "sexo": "M",
    "hobby": "Futebol",
    "data_nascimento": "1993-01-30"
  }
}
````

```
DELETE api/developers/{id}
Codes 204 / 400
```
Apaga o registro de um desenvolvedor


# Execução
Após clonar o repositório rodar com comando *docker-compose up* no diretório raiz do projeto, 
esperar o build da imagem e o up do container a aplicação rodará no seguinte endereço: *localhost:8000* 

