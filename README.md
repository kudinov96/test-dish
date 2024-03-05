1) `docker-compose up -d --build`

В реальном проекте конечно бы добавлял таблицы через миграции, а наполнял данные через сидеры.
Но тут в угоду времени просто использовал предоставленный sql файл.

2) `docker-compose exec -T mysql sh -c 'mysql -u default -pdefault default < /var/www/default_202204011832.sql'`
2) `docker-compose exec -T php-fpm sh -c 'php artisan app:dish {code}'`, где code - строка с типами ингредиентов

Вывел сначала массивом для удобства проверки, потом запрошенный json по условиям задания.
