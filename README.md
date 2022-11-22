# php-spam-bot-service
<h2>Как запустить сервис:<h2>

1.Скачиваем зависимости:

```
composer install
```
2.Разворачиваем бд
  
3.Настраиваем env

4.Запускаем миграцию:

```
./vendor/bin/doctrine-migrations migrate
```

5.Запускаем сервис: 

```
php -S localhost:8000 public/index.php
```
