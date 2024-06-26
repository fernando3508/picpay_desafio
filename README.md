<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Desafio Back-end 

Install
----------
```
git clone https://github.com/fernando3508/picpay_desafio.git
cd picpay_desafio
cp .env.example .env
docker-compose up -d
docker exec -it picpay_web composer install
docker exec -it picpay_web php artisan migrate
```

![Alt text](/screenshots/cap1.png?raw=true)

Endpoints
----------

## Novo Usuário

```
docker exec -it picpay_web curl -s -d '{"nome":"Fernando M. Martins", "email":"fernando@gmail.com", "cnpj":"48831199000126", "tipo":"lojista", "saldo":"10.50"}' -H "Content-Type: application/json" -H "Accept: application/json"  -X POST http://localhost/api/user | jq
```

```
docker exec -it picpay_web curl -s -d "nome=Michelle SobreNome&email=michelle@gmail.com&cpf=28462927013&tipo=usuario&saldo=1500.50" -H "Accept: application/json"  -X POST http://localhost/api/user | jq
```

![Alt text](/screenshots/cap2.png?raw=true)

## Listar Usuários

```
docker exec -it picpay_web curl -s -H "Accept: application/json" http://localhost/api/user | jq
```

![Alt text](/screenshots/cap3.png?raw=true)

### Filtros

#### Tipo

```
docker exec -it picpay_web curl -s -H "Accept: application/json" http://localhost/api/user?tipo=lojista | jq
```

![Alt text](/screenshots/cap4.png?raw=true)

#### Nome

```
docker exec -it picpay_web curl -s -H "Accept: application/json" http://localhost/api/user?nome=lojista | jq
```

#### CPF

```
docker exec -it picpay_web curl -s -H "Accept: application/json" http://localhost/api/user?cpf=28462927013 | jq
```

### Mais

```
docker exec -it picpay_web curl -s -H "Accept: application/json" 'http://localhost/api/user?email=michelle@gmail.com&tipo=usuario&cpf=28462927013' | jq
```

![Alt text](/screenshots/cap5.png?raw=true)

## Criar Transação

```
docker exec -it picpay_web curl -s -d '{"payer":2, "payee":1, "value":"1.51"}' -H "Content-Type: application/json" -H "Accept: application/json"  -X POST http://localhost/api/transaction | jq
```

![Alt text](/screenshots/cap6.png?raw=true)

## Deletar Transação

```
docker exec -it picpay_web curl -s -H "Accept: application/json" -X DELETE http://localhost/api/transaction/1 | jq
```

![Alt text](/screenshots/cap7.png?raw=true)

## Listar Transações

```
docker exec -it picpay_web curl -s -H "Accept: application/json" http://localhost/api/transaction | jq
```

![Alt text](/screenshots/cap8.png?raw=true)

## Endpoints Postman

```
http://localhost/api/user:8080
http://localhost/api/transaction:8080
```