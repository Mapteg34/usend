# README #

Проект представляет собой прохождения тестового задания для компании usend

# Постановка задачи #

#### Условия

Есть приложение, которое показывает рекламные объявления.
Информация об объявлении хранится в базе и отдается через кеширующий демон.

В системе есть две PHP-функции для получения данных объявления. Они достались в наследство из старого кода, их нельзя переписать и надо использовать как есть:

* Получение данных об объявлении из базы
```
    function getAdRecord($id)
    {
        // пример ответа
        return [
            'id'       => $id,
            'name'     => 'AdName_FromMySQL',
            'text'     => 'AdText_FromMySQL',
            'keywords' => 'Some Keywords',
            'price'    => 10, // 10$
        ];
    }
```
* Получение данных об объявлении из кеширующего демона
```
    function get_deamon_ad_info($id)
    {
        // пример ответа: строка разделенная табуляцией
        return "{$id}\t235678\t12348\tAdName_FromDaemon\tAdText_FromDaemon\t11";
    }
```
где колонки:
0. id - объявления
1. id - кампании
2. id - пользователя
3. название объявления
4. текст объявления
5. стоимость объявления в $

#### Надо

Спроектировать и реализовать бизнес-логику работы с объявлением (без фреймворков)

1. Получить объявление из базы или от демона
2. Реализовать работу с валютами (у нас таблица фиксированных курсов к доллару)
3. Писать в лог факт обращения к источнику данных (база или демон)
Надо сохранить время запроса, название источника данных (точное название PHP-фукнции) и ID объявления:
"[time] getAdRecord(ID=1)"
или
"[time] get_deamon_ad_info(ID=1)"
Мы используем какой-то гипотетический логгер из внешней библиотеки, который ничего не знает о нашем коде, и дописывать мы его тоже не можем:
$logger = new FileLogger('/path/to/file');
$logger->log('log message');
Необходимо иметь возможность централизованно включить/отключить логгирование во всех частях приложения.
4. В качестве бонуса можно написать модульные тесты на phpunit

#### Результат

В качестве результата для проверки работы системы, необходимо создать страницу просмотра объявления, где вывести название объявления, текст и его стоимость в рублях.
НЕ надо прикручивать MVC. Простой скрипт, который показывает как работает созданная вами система.

для запроса /?id=1&from=Mysql
ответ:
```
    <h1>AdName_FromMySQL</h1>
    <p>AdText_FromMySQL</p>
    <p>стоимость: Х руб</p>
```

для запроса /?id=1&from=Daemon
ответ:
```
    <h1>AdName_FromDaemon</h1>
    <p>AdText_FromDaemon</p>
    <p>стоимость: Х руб</p>
```

Если какая-то часть задания вам не понятна или требует уточнения - сделайте так как вы это поняли и оставьте комментарий.
Интересует более системное решение, нежели сделанное в лоб.

### How do I get set up? ###

Для разворачивания проекта необходимо:
1. `git clone`
2. `create .env`
3. `composer install`
4. `docker-compose up -d`
5. `see in browser`

Для запуска тестов:
```./vendor/bin/phpunit```

Включение/отключение логгирования через переменную окружения `LOG_ENABLED`

### Готовые ссылки ###

* https://usend.malahov-artem.ru/?id=123&from=mysql
* https://usend.malahov-artem.ru/?id=321&from=daemon
