# Тестовое задание на Yii2

##Задача
Реализовать REST сервис с использованием фреймворка yii2. Сервис должен хранить в БД 
и по консольной команде обновлять информацию по текущему курсу валют.
Данные по валютам брать с сайта ЦБ РФ.
Должны быть реализованы два метода:
* GET /currencies - возвращает список курсов валют с возможностью пагинации
* GET /currency/<id> - возваращает информацию по конкретной валюте

API должно быть прикрыто bearer авторизацией.

##Установка
Клонируем репозиторий, затем выполняем:
```bash
composer update
```
В /config/db.php настраиваем подключение в БД, затем:
```bash
php yii migrate/up
```
После этого необходимо загрузить информацию по валютам, для этого выполним:
```bash
php yii currency/update
```
Запустить встроенный сервер:
 ```bash
 php yii serve -p 8080
 ```
##Использование
При выполнении закпросов к API необходимо передавать заголовок:
```bash
Authorization: Bearer 100-token
```
Иначе получим 401 ошибку.

###Список валют:
```php
GET /currencies
GET /currencies?page=2
```
###Просмотр определённой валюты:
```php
GET /currency/<id>
```