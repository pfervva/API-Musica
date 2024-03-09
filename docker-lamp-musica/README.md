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

## POST AÑADIR CANCION:

http://127.0.0.1/api-musica/endp/cancion

Tambien añadir el Header api-key:token

```json
{
            "id_usuario": "1",
            "nombre": "Malianteo",
            "artista": "JC Reyes, Ryan Castro y The Rudeboy",
            "imagen": "img en base64"
        } 
```
## Respuesta del login: 

```json
{
    "result": "ok insercion",
    "insert_id": 21,
    "file_img": "http://127.0.0.1/api-musica/public/img/65ecaf2c3e639.JPEG"
}
```

## LIST CANCIONES:

Tambien añadir el Header api-key:token

De body nada

GET PARA: http://127.0.0.1/api-musica/endp/cancion

## Respuesta del list: 

```json
{
    "result": "ok",
    "canciones": [
        {
            "id": "1",
            "id_usuario": "1",
            "nombre": "Leyla",
            "artista": "Camin, Pedro Calderon",
            "imagen": "http://127.0.0.1/api-musica/public/img/1.jpg"
        },
        {
            "id": "2",
            "id_usuario": "1",
            "nombre": "Casanova",
            "artista": "Abiada",
            "imagen": "http://127.0.0.1/api-musica/public/img/2.jpg"
        },
        {
            "id": "3",
            "id_usuario": "1",
            "nombre": "Nostalgia",
            "artista": "FlowGPT",
            "imagen": "http://127.0.0.1/api-musica/public/img/3.jpg"
        },
        {
            "id": "4",
            "id_usuario": "1",
            "nombre": "Playa Del Inglés",
            "artista": "Quevedo, Myke Towers",
            "imagen": "http://127.0.0.1/api-musica/public/img/4.jpg"
        },
        {
            "id": "5",
            "id_usuario": "1",
            "nombre": "Las Bratz",
            "artista": "Aissa, Saiko, JC Reyes",
            "imagen": "http://127.0.0.1/api-musica/public/img/5.jpg"
        },
        {
            "id": "6",
            "id_usuario": "1",
            "nombre": "Cayó La Noche",
            "artista": "La Pantera, Quevedo, Juseph",
            "imagen": "http://127.0.0.1/api-musica/public/img/6.jpg"
        },
        {
            "id": "7",
            "id_usuario": "1",
            "nombre": "Yandel 150",
            "artista": "Yandel, Feid",
            "imagen": "http://127.0.0.1/api-musica/public/img/7.jpg"
        },
        {
            "id": "21",
            "id_usuario": "1",
            "nombre": "Malianteo",
            "artista": "JC Reyes, Ryan Castro y The Rudeboy",
            "imagen": "http://127.0.0.1/api-musica/public/img/65ecaf2c3e639.JPEG"
        }
    ]
}
```
## PUT MODIFICAR CANCION:

http://127.0.0.1/api-musica/endp/cancion

Tambien añadir el Header api-key:token
En params pasamos id del que hay que modificar
y en el body los nuevos datos

```json
{
            "id_usuario": "1",
            "nombre": "Malianteo",
            "artista": "JC Reyes, Ryan Castro"
        }
```

## RESPUESTA MODIFICACION

```json
{
    "result": "ok actualizacion",
    "file_img": "http://127.0.0.1/api-musica/public/img/65ecaf2c3e639.JPEG"
}
```


## DELETE ELIMINAR CANCION:

http://127.0.0.1/api-musica/endp/cancion

En params pasamos id del que hay que modificar

## RESPUESTA DELETE
```json
{
    "result": "ok"
}
```