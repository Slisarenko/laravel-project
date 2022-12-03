## Laravel API project example

- NGINX 1.19.0
- PHP 8.0
- Postgres 12.6

## Install
1.Cloning a project from the repository
* git clone https://gitlab.nixdev.co/slisarenko/laravel-api.git
* cd laravel-api
* git checkout -b develop
* git pull origin develop

2.Prepare .env files
* cp .env.example .env && cd docker && cp .env.example .env

```
In /docker/.env you'll find the next variables:
USER_NAME = id -u //in terminale
USER_UID  = id -g //in terminale
```

3.Docker up
* docker-compose up --build -d

4.Install Dependencies
* docker exec -it php bash
* composer install
* npm install
* npm run dev

5.PHP generate key
* php artisan key:generate

6.Migration and seed
* php artisan migrate
* php artisan db:seed
* exit

7.Add host to /etc/hosts
* sudo nano /etc/hosts
* Add : 127.0.0.1     api

8.At the end visit the web-site
*  api/

## React JS
You can find an application **[here](https://gitlab.nixdev.co/slisarenko/react-web)**

## About
- **[Swagger UI](https://github.com/swagger-api/swagger-ui)**
- **[API Tests](https://codeception.com/docs/10-APITesting)**
- Firebase Cloud Messaging [FCM](https://firebase.google.com/docs/cloud-messaging) \
There is a class FirebasePushService where you can find an example how to send push notifications using FCM \
  Firstly, you need to sync your mobile app with FB\
  Secondary, you need to create **[service account key](https://cloud.google.com/iam/docs/creating-managing-service-account-keys#creating_service_account_keys)**
  The last step is: you MUST put the file to *external-data* folder. Assign a value to a FIREBASE_CREDENTIALS variable
  like */var/www/external-data/google-services.json*
## How to run API tests
- composer test


