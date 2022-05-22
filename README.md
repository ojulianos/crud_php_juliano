# CRUD MVC PHP

Desenvolvi esse projeto para relembrar alguns paradigmas de programação.

Modo de uso:

Execute o composer dump-autoload

### Configuração de banco de dados
A configuração deve ser feita para o modo de desenvolvimento e modo de produção

config/development/database.php
config/production/database.php

### Configuração da Aplicação
As configurações de:

- {APP_TITTLE} Nome da Aplicação
- {DEFAULT_CONTROLLER} Controller Padrão
- {DEBUG} Modo de Produção/Debug

config/app.php

### Criando um controller.

Na pasta App\Controllers crie um novo controller com o nome {NomeDaPagina}Controller

Já estão disponiveis 3 modelos como base na pasta.

- O DefaultController que tem uma página simples
- O AddressesController que tem um crud simples
- O CustommerController que tem um crud mais complexo com o uso de dois models

### Criando um model

Na pasta App\Models cria um novo model de preferencia com o nome da tabela no banco de dados

- $table = 'addresses'; vai receber o nome da tabela
- $id = 'id'; vai receber o campo identificador da tabela
- $fields = ['zipcode']; vai receber um array com os campos que podem ser salvos na tabela
- $order_by = 'id DESC'; vai definir a ordem padrão dos resultados

Métodos disponiveis:

- getData(array) método recebe um array de parametros e condições para returnar os dados
- getOne(int) método recebe o id e retorna um resultado
- getCount(array) método recebe um array de parametros e condições para returnar o numero re resultados
- insertData(array) método recebe um array de parametros para adicionar um registro
- updateData(array, array) método recebe um array de parametros para atualizar o registro, e um array de condições
- deleteData(array) método recebe um array de condições para excluir um item

Parametros disponiveis:

```
[
    'select' => '',
    'where' => [],
    'order_by', => '',
    'start' => '',
    'end' => ''
]
```

### Criando view

As views devem ser criadas na pasta App\Views

Os templates padrão estão na pasta _templates