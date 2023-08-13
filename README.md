## With Docker

#### Commands to run a project:

```
docker compose up
```

The code will be available at <a href="http://localhost:3000">localhost:3000</a>

#### Commands to clean a docker image with its dependencies

- If you are in Linux machine, use permission to execute to run the script .sh

```
./docker-clean.sh
```
<hr>

## Without Docker (Check if you want to run it in your local environment instead of docker)

#### SQL files

- SQL files are placed in the `database/dump` folders. 

#### ENV file

- Change `.env` file configuration.

<hr>

## Pages

#### Only one account is available via .sql file users.sql:
> username: <strong>admin</strong><br>
> password: <strong>123</strong>


- <a href="http://localhost:3000">index.html</a> Local guest room for writing feedbacks and viewing feedbacks that accepted by the administrator.
- <a href="http://localhost:3000/admin/login.html">admin/login.html</a> Login for authorized user
- <a href="http://localhost:3000/admin">admin/index.html</a> Admin room to manage feedbacks
