# php-spam-bot-service
<h2>Как запустить сервис:<h2>

1.Скачиваем зависимости:

```composer install```

2.Запускаем миграцию:

```./vendor/bin/doctrine-migrations migrate```

3.Запускаем сервис: 

```php -S localhost:8000 public/index.php```
