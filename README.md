Yii2 food модуль
=============

Запустите

```
composer require kahanov/food
```

Использование
-----

Подключите модуль в файле конфигурации common/config/main.php

```php
'modules' => [
    'food' => [
        'class' => 'kahanov\food\Module',
    ],
    ...
],
```

Подключите модуль в файле конфигурации backend/config/main.php

```php
'modules' => [
    'food' => [
        'class' => 'kahanov\food\Module',
        'controllerNamespace' => 'kahanov\food\backend\controllers',
        'viewPath' => '@vendor/kahanov/food/backend/views',
        'defaultRoute' => 'dish/index',
    ],
    ...
],
```

Подключите модуль в файле конфигурации frontend/config/main.php

```php
'modules' => [
    'food' => [
        'class' => 'kahanov\food\Module',
        'controllerNamespace' => 'kahanov\food\frontend\controllers',
        'viewPath' => '@vendor/kahanov/food/frontend/views',
    ],
    ...
],
```

Выполните миграцию

```php

./yii migrate --migrationPath=@vendor/kahanov/food/migrations

```

Маршруты модуля backend

http://site/backend/food/dish

http://site/backend/food/ingredient

Маршруты модуля frontend

http://site/food
