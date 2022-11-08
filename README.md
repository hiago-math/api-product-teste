# Configurando ambiente de dev

## Instalando Docker e Docker-compose 
````
# Instale o docker CE(17.12+) & docker-compose(1.2+)
sudo apt-get update
sudo apt-get install docker
sudo apt-get install docker-compose

# Valide se foi instalado usansdo os seguintes comandos no terminal:
docker -v
e
docker-compose -v

# Se retornou algo diferente das vesões siga o passo a seguir:

# Copie e cole no seu navegador o site a seguir e Siga as instruções:
  https://phoenixnap.com/kb/install-docker-compose-on-ubuntu-20-04
````

## Iniciando projeto 

````
sudo -> Linux e MAC
Windows -> abra o CMD no modo ADM
````

``` bash
# Adicionar permissões para o docker
sudo usermod -aG docker ${USER}
sudo su - ${USER}

#Adicionando as configurações do site escolhido, digite em seu terminal: 
cp .env.example .env

# Adicionar permissão de usuário para o contéudo
sudo chown -R $USER:$USER .

# Rodar o docker-compose
docker-compose up -d

# Rodar o composer
docker-compose exec app composer install

# Adiconar key artisan
docker-compose exec app php artisan key:generate

# Rodar as migrations
docker-compose exec app php artisan migrate

# Rodar secret JWT
docker-compose exec app php artisan jwt:secret     

# DataBase

--- Config Docker ---
MYSQL_DATABASE=product_api
MYSQL_USER=root
MYSQL_PASSWORD=123
MYSQL_PORT=3306
MYSQL_ROOT_PASSWORD=123 

--- Conectar Laravel com o container ---
DB_CONNECTION=mysql
DB_HOST=product_mysql # -> Nome do Container Docker
#DB_HOST=127.0.0.1 # -> host padrão
DB_PORT=3306
DB_DATABASE=product_api
DB_USERNAME=root
DB_PASSWORD=123
```
## Acesso da api

````
http://product.localhost/
````
