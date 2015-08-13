Symfony2 Restful Example
========================

* Create Database

```
app/console doctrine:database:create
```

* Create Database Schema
```
app/console doctrine:schema:create
```

* Create User
```
app/console fos:user:create
```

* Create Api Client
```
app/console api:user:oauth-client:create --redirect-uri="http://localhost:8000/" --grant-type="authorization_code" --grant-type="password" --grant-type="refresh_token" --grant-type="token" --grant-type="client_credentials"
```

Response
```
public id 2_3eqrtnpqgzqco4w8wowwo0c8os80gssccw8kswswc8wg4ww0oo, secret 2vczmz80rgowc88k00cc8c0gw4ss04o8wc0cc4g0kgcwcosc84
```

* Get Access Token
```
http://localhost:8000/oauth/v2/token?client_id=2_3eqrtnpqgzqco4w8wowwo0c8os80gssccw8kswswc8wg4ww0oo&client_secret=2vczmz80rgowc88k00cc8c0gw4ss04o8wc0cc4g0kgcwcosc84&grant_type=password&username=username&password=password
```

Response
```JSON
{
    "access_token": "ODRiMWEyODhiY2UxMmY2NTMyN2E3YjZiNWY1Njc2NjNkZTM2ZThhYjk2M2EyMTIzNDYxMDg1ZjE4MDQ1MmRiMQ",
    "expires_in": 3600,
    "refresh_token": "M2YxNjRjMDRiZmU1ZDM2OTlhNWI0N2RiYmM2MTgxNmQwZDlmNGU4MGViNzJmMDVhYmQ0YWE4NDE4N2JkYTg2MQ",
    "scope": null,
    "token_type": "bearer"
}
```

* Get Users
```
http://localhost:8000/users?access_token=ODRiMWEyODhiY2UxMmY2NTMyN2E3YjZiNWY1Njc2NjNkZTM2ZThhYjk2M2EyMTIzNDYxMDg1ZjE4MDQ1MmRiMQ
```

* Api Doc
```
http://localhost:8000/api/doc
```

