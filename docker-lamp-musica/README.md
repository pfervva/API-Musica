## REGISTRO: 

http://127.0.0.1/api-musica/endp/registro
```json
{
  "email": "pfer@pfer.es",
  "password": "Pfer123",
  "nombre": "Pedro Fernandez",
  "disponible": "1"
},
```

===========================================

## LOGIN:

http://127.0.0.1/api-musica/endp/auth

```json
{
  "email": "pfer@pfer.es",
  "password": "Pfer123"
}
```
================ 
## Respuesta del login: 
```json
{
    "result": "ok",
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MTAwMDcwMDYsImRhdGEiOnsiaWQiOiIxMiIsImVtYWlsIjoicGZlckBwZmVyLmVzIn19.D2JNnBD75fsNWNxg6Wac4qySOKqW5z9583n2cTMR1qY"
}
```