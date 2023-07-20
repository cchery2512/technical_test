### Before running the application you need

- Install Docker

## To run the application type this command in the console:

- docker-compose build && docker-compose up -d

## Important: the application port is 14000 => http://127.0.0.1:14000

### Run the APIS

- To facilitate the execution of the endpoints of this project I provide the link: https://drive.google.com/file/d/17KP-GFqpCfG1AVgUzHsySAZ85FpwTLsB/view?usp=sharing 
- That contains a POSTMAN collection where these endpoints are found with which they can help.

### Connection to the database outside of docker (with fixed ports)

## The credentials are:
- user: root
- password: password
- database: main
- host: localhost
- port: 3307

## Note:
- If you have problems with connection permissions, you can add this parameter in the connection URL: ?allowPublicKeyRetrieval=true&useSSL=false

- Once the container is created, wait a few seconds for the dockerized server to finish configuring... (migrations and seeders usually run after the container is created)